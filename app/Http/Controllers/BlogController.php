<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BlogService;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService) {
        $this->blogService = $blogService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        $blog = $this->blogService->getBySlug($slug);
        return view('client.pages.blogs.view', [
            'title' => $blog['title'],
            'blog' => $blog,
            'blogs' => $this->blogService->get(['comparison' => '>', 'number' => 0], 5),
        ]);
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
    public function destroy(string $id)
    {
        //
    }
}
