<?php

namespace App\Http\Services;

use App\Models\User;

class UserService {
    
    public function get() {

        try {
        
            return User::get()->toArray();

        } catch (\Throwable $th) {
            //throw $th;
        }

        return false;
    }

    public function countNewUsersInMonth($month = null) {

        $year = date('Y');
        $month = date('m');

        $count = User::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count('id');

        return $count;

    }

}