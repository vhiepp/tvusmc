<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::where('active', 'active')->orderBy('created_at', 'desc')->paginate(8);

        return view('admin.pages.documents.list', [
            'title' => 'Danh sách, Văn bản',
            'page' => 'documents',
            'documents' => $documents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.documents.create', [
            'title' => 'Upload văn bản',
            'page' => 'documents'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $document = Document::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'active' => 'active',
            'created_at' => \App\Helpers\Date::fomatDateInput($request->input('time-post'))
        ]);

        $fileList = json_decode($request->input('files'));
        foreach ($fileList as $file) {
            $fileDocument = $document->files()->create([
                'filename' => $file->fileName,
                'file_url' => $file->url
            ]);
        }
        return redirect()->route('admin.documents');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $document = Document::where('slug', $request->slug)->first();

        return view('admin.pages.documents.preview', [
            'title' => 'Preview',
            'page' => 'documents',
            'document' => $document
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if (isset($request->slug)) {

            $document = Document::where('slug', $request->slug)->first();

            return view('admin.pages.documents.edit', [
                'title' => 'Chỉnh sửa văn bản',
                'page' => 'documents',
                'document' => $document
            ]);

        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $document = Document::where('slug', $request->input('slug'))->first();

            $document->files()->delete();
            $fileList = json_decode($request->input('files'));
            foreach ($fileList as $file) {
                $fileDocument = $document->files()->create([
                    'filename' => $file->fileName,
                    'file_url' => $file->url
                ]);
            }

            $document->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'created_at' => \App\Helpers\Date::fomatDateInput($request->input('time-post'))
            ]);
        } catch (\Throwable $th) {
            return \redirect()->back()->with('error', 'Cập nhật văn bản thất bại!');
        }
        return redirect()->route('admin.documents.preview', ['slug' => $request->input('slug')])->with('success', 'Cập nhật văn bản thành công!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            Document::where('slug', $request->input('slug'))->delete();
        } catch (\Throwable $th) {
            return \redirect()->back()->with('error', 'Xóa văn bản thất bại!');
        }

        return \redirect()->route('admin.documents')->with('success', 'Xóa văn bản thành công!');
    }
}