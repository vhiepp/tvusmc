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
                                'job_users.created_at as time_register'
                            )
                            ->orderBy('users.class', 'asc')
                            ->get();
            return $users;
        } catch (\Throwable $th) {
            //throw $th;
            return [];
        }

    }

}