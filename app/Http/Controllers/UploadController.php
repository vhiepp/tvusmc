<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request) {
        $folder = "uploads_files/" . date('Y/m/d');
        $fileName = date('H-i') . '-' . $request->file('upload')->getClientOriginalName();
        $url = $request->file('upload')->move($folder, $fileName);

        $path = '/' . $folder . '/' . $fileName;

        if ($request->input('res_filename')) {
            return response([
                "fileName" => $fileName,
                "fileUrl" => '/' . $folder . '/' . $fileName
            ]);
        }

        return response([
                    "fileName" => $fileName,
                    "uploaded" => 1,
                    "url" => $path
                ]);
    }

    public function delete(Request $request) {
        $fileUrl = public_path($request->input('fileUrl'));
        unlink($fileUrl);
        return response('OK');
    }
}