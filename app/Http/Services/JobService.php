<?php

namespace App\Http\Services;

use App\Models\Job;
use App\Models\User;
use App\Models\JobUser;

class JobService {

    public static function getJobById($id) {
        try {
            $job = Job::where('jobs.id', $id)
                        ->join('events', 'events.id', '=', 'jobs.event_id')
                        ->select(
                            'jobs.*',
                            'events.name as event_name'
                        )
                        ->get()[0];
            return $job;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public static function getUsersByJobId($jobId) {
        try {
            //code...
            $users = JobUser::where('job_id', $jobId)
                            ->where('job_users.active', 1)
                            ->join('users', 'users.id', '=', 'job_users.user_id')
                            ->select(
                                'users.*',
                                'job_users.time_sub as time_register',
                                'job_users.proof as proof',
                            )
                            ->orderBy('users.class', 'asc')
                            ->orderBy('users.mssv', 'asc')
                            ->get();
            return $users;
        } catch (\Throwable $th) {
            //throw $th;
            return [];
        }

    }

    public static function jobInMonth() {
        $year = date('Y');
        $month = date('m');

        $count = Job::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count('id');

        return $count;
    }
}
