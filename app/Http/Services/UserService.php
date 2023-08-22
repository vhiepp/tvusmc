<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\JobUser;

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

    public function totalUser() {
        return User::all()->count();
    }

    public function totalUserJoinJobInMonth() {
        $year = date('Y');
        $month = date('m');

        $count = JobUser::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->distinct('user_id')
                    ->count('id');

        return $count;
    }

    public function userJoinJobInMonth() {
        $year = date('Y');
        $month = date('m');

        $users = JobUser::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->select('user_id')
                    ->groupBy('user_id')
                    ->get();

        foreach ($users as $index => $user) {
            $users[$index]['user'] = $users[$index]->user;
            $users[$index]['count'] = JobUser::whereYear('created_at', $year)
                                            ->whereMonth('created_at', $month)
                                            ->where('user_id', $users[$index]['user_id'])
                                            ->count();
        }

        $users = collect($users->toArray())->sortByDesc('count');
        return $users->toArray();
    }

}
