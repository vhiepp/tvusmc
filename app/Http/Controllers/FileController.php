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
                        )
                        ->get();
        
    
        
        $data = [];
        foreach ($users as $index => $user) {
            array_push($data, [
                'index' => $index + 1,
                'name' => $user['name'],
                'mssv' => $user['mssv'],
                'class' => $user['class'],
            ]);
        }
        if ($request->input('file') == 'word') {

            $link = File::exWord('001', $data, [
                'title' => 'DS ' . $request->input('title'),
                'date_time' => $request->input('date_time'),
                'address' => $request->input('address'),
            ], 'index');
            return response()->download($link, 'DS ' . $request->input('title') . ' ngày ' . date('d-m-Y') . '.docx');
        }

        if ($request->input('file') == 'pdf') {

            $link = File::exPdf('001', $data, [
                'title' => 'DS ' . $request->input('title'),
                'date_time' => $request->input('date_time'),
                'address' => $request->input('address'),
            ], 'index');
            return response()->download($link, 'DS ' . $request->input('title') . ' ngày ' . date('d-m-Y') . '.pdf');
        }

        return \redirect()->back();

    }
}
