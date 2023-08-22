<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use App\Http\Services\BlogService;
use App\Models\Blog;
use App\Helpers\UploadHelper;
use Illuminate\Support\Str;
use Famdirksen\LaravelGoogleIndexing\LaravelGoogleIndexing;

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
        // dd(route('client.blogs', ['slug' => '123']));

        $request->validate([
            'title' => 'required',
            'categories' => 'required',
            'content' => 'required',
            'thumb' => 'required',
            'time-post' => 'required',
        ]);

        $slug = Str::of($request->title)->slug('-');

        try {
            $timePost = \App\Helpers\Date::fomatDateInput($request->input('time-post'));

            $data = [
                'title' => $request->title,
                'category_id' => $request->categories,
                'user_id' => auth()->user()['id'],
                'content' => $request->content,
                'thumb' => $request->thumb,
                'slug' => $slug,
                'created_at' => $timePost,
                'active' => ($request->input('post-now')) ? 1 : 0,
            ];

            $blog = Blog::create($data);
            try {
                //code...
                if (env('APP_ENV') == 'production' && $request->input('post-now')) {
                    LaravelGoogleIndexing::create()->update(route('client.blogs', ['slug' => $slug->toString()]));
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
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

                try {
                    //code...
                    if (env('APP_ENV') == 'production' && $request->active == 1) {
                        LaravelGoogleIndexing::create()->update(route('client.blogs', ['slug' => $request->slug]));
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
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
            'time-post' => 'required',
        ]);


        try {

            $timePost = \App\Helpers\Date::fomatDateInput($request->input('time-post'));
            $slug = Str::of($request->title)->slug('-');
            $data = [
                'title' => $request->title,
                'category_id' => $request->categories,
                'content' => $request->content,
                'slug' => $slug,
                'created_at' => $timePost,
                'active' => ($request->input('post-now')) ? 1 : 0,
            ];

            if ($request->input('thumb')) {

                $data['thumb'] = $request->input('thumb');

            }

            Blog::where('slug', $request->slug)->update($data);
            try {
                //code...
                if (env('APP_ENV') == 'production' && $request->input('post-now') && $request->slug != $slug->toString()) {
                    LaravelGoogleIndexing::create()->delete(route('client.blogs', ['slug' => $request->slug]));
                    LaravelGoogleIndexing::create()->update(route('client.blogs', ['slug' => $slug->toString()]));
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

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

            try {
                //code...
                if (env('APP_ENV') == 'production') {
                    LaravelGoogleIndexing::create()->delete(route('client.blogs', ['slug' => $request->input('slug')]));
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

        } catch (\Throwable $th) {
            return \redirect()->back()->with('error', 'Xóa bài viết thất bại!');
        }

        return \redirect()->route('admin.blogs')->with('success', 'Xóa bài viết thành công!');
    }
}