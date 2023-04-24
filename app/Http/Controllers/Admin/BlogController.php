<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use App\Http\Services\BlogService;
use App\Models\Blog;
use App\Helpers\UploadHelper;
use Illuminate\Support\Str;
class BlogController extends Controller
{

    protected $categoryService;
    protected $blogService;

    public function __construct(CategoryService $categoryService, BlogService $blogService) {
        $this->categoryService = $categoryService;
        $this->blogService = $blogService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.blogs.list', [
            'title' => 'Blogs',
            'page' => 'blogs',
            'blogs' => $this->blogService->get(['comparison' => '>', 'number' => 0]),
            'pendingBlogs' => $this->blogService->get(['comparison' => '=', 'number' => 0]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.blogs.create', [
            'title' => 'Viết bài',
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
            'thumb' => 'required'
        ]);
        
        $slug = Str::of($request->title)->slug('-');        
        
        try {
            
            $data = [
                'title' => $request->title,
                'category_id' => $request->categories,
                'user_id' => auth()->user()['id'],
                'content' => $request->content,
                'thumb' => $request->thumb,
                'slug' => $slug,
                'active' => ($request->input('post-now')) ? 1 : 0,
            ];

            Blog::create($data);

            return redirect()->route('admin.blogs')->with('success', 'Tạo bài viết thành công!');

        } catch (\Throwable $th) {
            //throw $th;
            return \redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra!');
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if (isset($request->slug)) {

            $blog = $this->blogService->getBySlug($request->slug);


            return view('admin.pages.blogs.preview', [
                'title' => 'Preview',
                'page' => 'blogs',
                'blog' => $blog,
            ]);

        }

        return redirect()->back();
    }

    public function active(Request $request) {
        try {
            
            if ($request->active >= 0 && $request->active <= 2 && $request->slug) {
                Blog::where('slug', $request->slug)->update([
                    'active' => $request->active,
                ]);
            } 

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra!!');
        }
        return redirect()->back()->with('success', 'Duyệt bài viết thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if (isset($request->slug)) {

            $blog = $this->blogService->getBySlug($request->slug);


            return view('admin.pages.blogs.edit', [
                'title' => 'Chỉnh sửa',
                'page' => 'blogs',
                'blog' => $blog,
                'categories' => $this->categoryService->get(),
            ]);

        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'categories' => 'required',
            'content' => 'required',
        ]);
        
        
        try {
            
            $data = [
                'title' => $request->title,
                'category_id' => $request->categories,
                'content' => $request->content,
                'slug' => Str::of($request->title)->slug('-'),
                'active' => ($request->input('post-now')) ? 1 : 0,
            ];
    
            if ($request->input('thumb')) {
            
                $data['thumb'] = $request->input('thumb');
                
            }
    
            
            Blog::where('slug', $request->slug)->update($data);
    
            return redirect()->route('admin.blogs.preview', ['slug' => $data['slug']->value() ])->with('success', 'Chỉnh sửa bài viết thành công!');

        } catch (\Throwable $th) {
            //throw $th;
            return \redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {      
        try {
            
            Blog::where('slug', $request->input('slug'))->delete();

        } catch (\Throwable $th) {
            return \redirect()->back()->with('error', 'Xóa bài viết thất bại!');
        }

        return \redirect()->route('admin.blogs')->with('success', 'Xóa bài viết thành công!');
    }
}
