<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService {
    
    public function get($page = 10) {

        try {

            $categories = Category::latest()->paginate($page);
        
            return $categories;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return [];
    }

}