<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use App\Models\Blog;
use App\Helpers\UploadHelper;
use Illuminate\Support\Str;
class BlogController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.blogs.list', [
            'title' => 'Blogs',
            'page' => 'blogs',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.blogs.create', [
            'title' => 'Viết blogs',
            'page' => 'blogs',
            'categories' => $this->categoryService->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'categories' => 'required',
            'content' => 'required',
        ]);
        
        if ($request->file('thumb')) {
            
            $thumb = UploadHelper::imgToBase64($request->file('thumb'));
        
        }
        
        
        try {
            
            $data = [
                'title' => $request->title,
                'category_id' => $request->categories,
                'user_id' => auth()->user()['id'],
                'content' => $request->content,
                'thumb' => $thumb,
                'slug' => Str::of($request->title)->slug('-'),
                'active' => ($request->input('post-now')) ? 1 : 0,
            ];

            Blog::create($data);

            return redirect()->route('admin.blogs');

        } catch (\Throwable $th) {
            //throw $th;
            return \redirect()->back()->withInput();
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
    public function destroy(string $id)
    {
        //
    }
}
