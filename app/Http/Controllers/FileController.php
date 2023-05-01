<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobUser;
use App\Helpers\File;

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

            $link = File::exWord('001', $data, [
                'title' => 'Danh Sách ' . $request->input('title'),
                'date_time' => $request->input('date_time'),
                'address' => $request->input('address'),
            ], 'index');
            return response()->download($link, '[DS] ' . $request->input('title') . ' ngày ' . date('d-m-Y') . '.docx');
        }

        if ($request->input('file') == 'pdf') {

            $link = File::exPdf('001', $data, [
                'title' => 'Danh Sách ' . $request->input('title'),
                'date_time' => $request->input('date_time'),
                'address' => $request->input('address'),
            ], 'index');
            return response()->download($link, '[DS] ' . $request->input('title') . ' ngày ' . date('d-m-Y') . '.pdf');
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
}
