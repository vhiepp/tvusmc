<?php

namespace App\Http\Services;

use App\Models\User;

class UserService {

    public function getUsers($page = 10) {

        $users = User::where('active', 1)
                    ->where('role', '0')
                    ->orderBy('class', 'asc')
                    ->paginate($page);
        return $users;
        try {


        } catch (\Throwable $th) {
            //throw $th;
        }

        return false;
    }

    public function getUsersAdmin() {

        $users = User::where('active', 1)
                    ->where('role', '!=', '0')
                    ->orderBy('class', 'asc')
                    ->get();
        return $users;
        try {


        } catch (\Throwable $th) {
            //throw $th;
        }

        return false;
    }
    
    public function get() {

        try {
        
            return User::get()->toArray();

        } catch (\Throwable $th) {
            //throw $th;
        }

        return [];
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