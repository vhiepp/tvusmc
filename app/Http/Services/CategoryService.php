<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService {
    
    public function get() {

        try {

            $categories = Category::latest()->get();
        
            return $categories;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return false;
    }

}