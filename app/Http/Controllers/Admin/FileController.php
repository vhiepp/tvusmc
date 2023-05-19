<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Services\FileService;

class FileController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService) {
        $this->fileService = $fileService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.files.list', [
            'page' => 'file',
            'title' => 'Quản lý file',
            'files' => $this->fileService->getFile(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.files.create', [
            'title' => 'Upload file',
            'page' => 'file',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $file = $request->file('file');

            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();

            if ($request->input('file_name')) {
    
                $fileName = $request->input('file_name') . '.' . $fileExtension;
    
            }

            $fileName = str()->replace('/', '-', $fileName);
            $fileName = str()->replace('\\', '-', $fileName);
            $fileName = str()->replace('+', '-', $fileName);

            $fileName = str()->replaceLast('.' . $fileExtension, ' [' . date('s') . ']' . '.' . $fileExtension, $fileName);

            $filePath = 'files/' . date('d-m-Y', strtotime(\App\Helpers\Date::getNow())) . '/' . $fileName;
    
            // Upload using a stream...
            Storage::cloud()->put($filePath, fopen($file, 'r+'));

            \App\Models\File::create([
                'file_name' => $fileName,
                'path' => $filePath,
                'type' => $request->input('type'),
                'extension' => $fileExtension,
                'user_id' => auth()->user()['id'],
                'created_at' => \App\Helpers\Date::getNow(),
            ]);
            
            return redirect()->back()->with('success', 'Upload file thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Upload file thất bại')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $file = \App\Models\File::where('id', $request->input('id'))->first();

            $path = $file['path'];
            
            Storage::cloud()->delete($path);

            $file->delete();
            
            return redirect()->back()->with('success', 'Xóa file thành công');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xóa file thất bại');
        }
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
            return redirect()->back()->with('error', 'Tải file thất bại');
        }
    }
}
