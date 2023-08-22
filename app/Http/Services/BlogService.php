<?php

namespace App\Http\Services;

use App\Models\Blog;

class BlogService {

    public function get($a = ['comparison' => '>=', 'number' => 0], $page = 10) {

        try {

            $blogs = Blog::where('blogs.active', $a['comparison'], $a['number'])
                    ->latest()
                    ->join('users', 'blogs.user_id', '=', 'users.id')
                    ->join('categories', 'blogs.category_id', '=', 'categories.id')
                    ->select(
                        'blogs.*',
                        'users.name as user_name',
                        'users.class as user_class',
                        'categories.name as category_name'
                    )
                    ->paginate($page);

            return $blogs;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return [];
    }

    public function getListApi($a = ['comparison' => '>=', 'number' => 0], $page = 10) {

        try {

            $blogs = Blog::where('blogs.active', $a['comparison'], $a['number'])
                    ->latest()
                    ->select(
                        'blogs.title',
                        'blogs.thumb',
                        'blogs.created_at',
                        'blogs.slug'
                    )
                    ->paginate($page);

            return $blogs;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return [];
    }

    public static function getBySlug($slug) {
        try {

            $result = Blog::where('blogs.slug', $slug)
                        ->join('users', 'blogs.user_id', '=', 'users.id')
                        ->join('categories', 'blogs.category_id', '=', 'categories.id')
                        ->select(
                            'blogs.*',
                            'users.name as user_name',
                            'users.class as user_class',
                            'users.avatar as user_avatar',
                            'categories.name as category_name'
                        )
                        ->first();
            return $result;

        } catch (\Throwable $th) {
            return [];
        }
    }

    public function totalBlog() {
        return Blog::all()->count();
    }

}