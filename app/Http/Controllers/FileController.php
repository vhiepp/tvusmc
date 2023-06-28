<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobUser;
use App\Helpers\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function downloadListJobUser(Request $request) {

        $users = JobUser::where('job_users.job_id', $request->input('job_id'))
                        ->where('job_users.active', 1)
                        ->join('users', 'users.id', '=', 'job_users.user_id')
                        ->select(
                            'users.name as name',
                            'users.mssv as mssv',
                            'users.class as class',
                            'job_users.proof as proof'
                        )
                        ->orderBy('users.class', 'asc')
                        ->orderBy('users.mssv', 'asc')
                        ->get();
                
        $data = [];
        if (!$request->input('proof')) {
            foreach ($users as $index => $user) {
                array_push($data, [
                    'index' => $index + 1,
                    'name' => str()->title($user['name']),
                    'mssv' => $user['mssv'],
                    'class' => str()->upper($user['class']),
                ]);
            }
        } else {
            $i = 0;
            foreach ($users as $index => $user) {
                if ($user['proof'] != null) {
                    $i += 1;
                    array_push($data, [
                        'index' => $i,
                        'name' => str()->title($user['name']),
                        'mssv' => $user['mssv'],
                        'class' => str()->upper($user['class']),
                    ]);
                }
            }
        }
        
        if ($request->input('file') == 'word') {

            $title = str()->replace(['/', '\\', '&'], '-', $request->input('title'));

            $link = File::exWord('001', $data, [
                'title' => $title,
                'date_time' => $request->input('date_time'),
                'address' => $request->input('address'),
            ], 'index');

            $filename = '[DS] ' . $title . '.docx';
            
            return response()->download($link, $filename);
        }

        if ($request->input('file') == 'pdf') {

            $title = str()->replace(['/', '\\', '&'], '-', $request->input('title'));

            $link = File::exPdf('001', $data, [
                'title' => $title,
                'date_time' => $request->input('date_time'),
                'address' => $request->input('address'),
            ], 'index');
            
            $filename = '[DS] ' . $title . '.pdf';
            
            return response()->download($link, $filename);
        }

        return \redirect()->back();

    }

    public function uploadProofForJob(Request $request) {

        $file = \App\Helpers\UploadHelper::imgToBase64($request->file('file'), null, true);

        JobUser::where('job_id', $request->input('job_id'))
                ->where('user_id', auth()->user()['id'])
                ->update([
                    'proof' => $file['path'],
                ]);

        $data = [
            'img' => $file['path'],
            'w' => $file['w'],
            'h' => $file['h']
        ];

        return \response($data);

    }

    public function index() {
        return view('client.pages.files.list', [
            'title' => 'Văn bản, danh sách',
        ]);
    }

    public function getDanhSach() {

        $files = \App\Models\File::where('type', '0')
                                ->latest()
                                ->paginate(6);
        foreach ($files as $index => $file) {
            $files[$index]['short_title'] = str()->of($file['file_name'])->limit(60);
            $files[$index]['post_at'] = date('d/m/Y', strtotime($file['created_at']));
            $files[$index]['download'] = route('client.files.download', ['path' => $file['path']]);
        }

        return response($files, 200);
    }

    public function getVanBan() {

        $files = \App\Models\File::where('type', '1')
                                ->latest()
                                ->paginate(6);
        foreach ($files as $index => $file) {
            $files[$index]['short_title'] = str()->of($file['file_name'])->limit(60);
            $files[$index]['post_at'] = date('d/m/Y', strtotime($file['created_at']));
            $files[$index]['download'] = route('client.files.download', ['path' => $file['path']]);
        }

        return response($files, 200);
    }

    public function getAll() {

        $files = \App\Models\File::latest()
                                ->paginate(6);
        foreach ($files as $index => $file) {
            $files[$index]['short_title'] = str()->of($file['file_name'])->limit(60);
            $files[$index]['post_at'] = date('d/m/Y', strtotime($file['created_at']));
            $files[$index]['download'] = route('client.files.download', ['path' => $file['path']]);
        }

        return response($files, 200);
    }

    public function download(Request $request) {

        try {
            
            $filename = $request->input('path');
    
            $file = Storage::cloud()->getAdapter()->getMetadata($filename);
    
            $rawData = Storage::cloud()->get($filename);
    
            $fileExtraMetadata = $file->extraMetadata();
    
            $filename = $fileExtraMetadata['filename'] . '.' . $fileExtraMetadata['extension'];
    
            return response($rawData, 200)
                ->header('ContentType', $file->mimeType())
                ->header('Content-Disposition', "attachment; filename=$filename");
            
        } catch (\Throwable $th) {
            return response([
                'error' => true,
            ]);
        }
    }
}
