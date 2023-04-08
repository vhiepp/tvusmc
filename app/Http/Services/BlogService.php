<?php

namespace App\Http\Services;

use App\Models\Blog;

class BlogService {
    
    public function get() {

        try {

            $blog = Blog::latest()->get();
        
            return $blog;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return false;
    }

    

}