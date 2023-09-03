<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('client.pages.documents.list', [
            'title' => 'Danh sách, Văn bản',
        ]);
    }

    public function get(Request $request) {
        $paginate = $request->input('paginate') ? $request->input('paginate') : 6;
        $document = Document::where('active', 'active')->orderBy('created_at', 'desc')->paginate($paginate);
        return response($document);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $document = Document::where('slug', $slug)->first();
        return view('client.pages.documents.view', [
            'title' => $document->title,
            'document' => $document
        ]);
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
    public function destroy(string $id)
    {
        //
    }
}