<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Event;
use Illuminate\Support\Str;
use App\Http\Services\CategoryService;

class CategoryController extends Controller
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
        return view('admin.pages.categories.list', [
            'title' => 'Danh mục',
            'page' => 'categories',
            'categories' => $this->categoryService->get(5),
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
        $request->validate([
            'name' => 'required',
        ]);

        $slug = Str::of($request->name)->slug('-');

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $slug,
        ];

        try {
            Category::create($data);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Tên danh mục đã tồn tại!');
        }

        return redirect()->back()->with('success', 'Thêm danh mục thành công.');
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
            Blog::join('categories', 'categories.id', '=', 'blogs.category_id')
                ->where('categories.slug', $request->input('slug'))
                ->delete();
    
            Event::join('categories', 'categories.id', '=', 'events.category_id')
                ->where('categories.slug', $request->input('slug'))
                ->delete();
    
            Category::where('slug', $request->input('slug'))
                    ->delete();
            

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xóa danh mục thất bại!!');
        }
        return redirect()->back()->with('success', 'Xóa danh mục thành công!!');
    }
}
