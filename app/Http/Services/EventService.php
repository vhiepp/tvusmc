<?php

namespace App\Http\Services;

use App\Models\Event;
use App\Models\EventJob;
use App\Models\JobUser;
use App\Models\Job;
use DB;
class EventService {

    public function get($a = ['comparison' => '>', 'number' => 0]) {

        try {

            $events = Event::where('events.active', $a['comparison'], $a['number'])
                            ->latest()
                            ->join('users', 'events.user_id', '=', 'users.id')
                            ->join('categories', 'events.category_id', '=', 'categories.id')
                            ->select(
                                'events.*',
                                'users.name as user_name',
                                'users.class as user_class',
                                'categories.name as category_name'
                            )
                            ->get();

            return $events;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return [];
    }

    public static function getEventsOver($page = 10) {
        try {

            $timeNow = \App\Helpers\Date::getNow();

            $events = Event::where('events.active', 1)
                            ->orderByDesc('events.time_start')
                            ->join('users', 'events.user_id', '=', 'users.id')
                            ->join('categories', 'events.category_id', '=', 'categories.id')
                            ->where('time_end', '<', $timeNow)
                            ->select(
                                'events.*',
                                'users.name as user_name',
                                'users.class as user_class',
                                'categories.name as category_name'
                            )
                            ->paginate($page)
                            ->fragment('su-kien-da-ket-thuc');

            return $events;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return [];
    }

    public static function getEventsIsHappening() {
        try {

            $timeNow = \App\Helpers\Date::getNow();

            $events = Event::where('events.active', 1)
                            ->orderByDesc('events.time_start')
                            ->join('users', 'events.user_id', '=', 'users.id')
                            ->join('categories', 'events.category_id', '=', 'categories.id')
                            ->where('time_start', '<', $timeNow)
                            ->where('time_end', '>', $timeNow)
                            ->select(
                                'events.*',
                                'users.name as user_name',
                                'users.class as user_class',
                                'categories.name as category_name'
                            )
                            ->get();

            return $events;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return [];
    }

    public static function getEventsIsComing() {
        try {

            $timeNow = \App\Helpers\Date::getNow();

            $events = Event::where('events.active', 1)
                            ->orderByDesc('events.time_start')
                            ->join('users', 'events.user_id', '=', 'users.id')
                            ->join('categories', 'events.category_id', '=', 'categories.id')
                            ->where('time_start', '>', $timeNow)
                            ->select(
                                'events.*',
                                'users.name as user_name',
                                'users.class as user_class',
                                'categories.name as category_name'
                            )
                            ->get();

            return $events;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return [];
    }

    public static function getEventsIsLastEnd($page = 10) {
        try {

            $events = Event::where('events.active', 1)
                            ->orderByDesc('events.time_end')
                            ->join('users', 'events.user_id', '=', 'users.id')
                            ->join('categories', 'events.category_id', '=', 'categories.id')
                            ->select(
                                'events.*',
                                'events.name as title',
                                'users.name as user_name',
                                'users.class as user_class',
                                'users.avatar as user_avatar',
                                'categories.name as category_name'
                            )
                            ->limit($page)
                            ->get();

            return $events;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return [];
    }

    public function getAll() {
        try {

            $events = Event::where('events.active', '>', 0)->get();

            return $events;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return [];
    }

    public function getBySlug($slug) {
        try {
            $event = Event::where('events.slug', $slug)
                            ->join('users', 'events.user_id', '=', 'users.id')
                            ->join('categories', 'events.category_id', '=', 'categories.id')
                            ->select(
                                'events.*',
                                'events.name as title',
                                'users.name as user_name',
                                'users.class as user_class',
                                'users.avatar as user_avatar',
                                'categories.name as category_name'
                            )
                            ->get()[0];
            return $event;
        } catch (\Throwable $th) {
            //throw $th;
        }

        return [];
    }

    public function getJobByEventId($eventId) {
        $jobs = Job::where('event_id', $eventId)->get();

        foreach ($jobs as $index => $job) {
            $jobusers = JobUser::where('job_id', $job['id'])->count();

            $jobs[$index]['user_count'] = $jobusers;

            $jobs[$index]['user_sub'] = false;

            if (auth()->check()) {

                $result = JobUser::where('job_id', $job['id'])
                                  ->where('user_id', auth()->user()['id'])
                                  ->get();

                if (count($result) > 0) {
                    $jobs[$index]['user_sub'] = true;


                    $jobs[$index]['proof'] = $result[0]['proof'];

                    if ($jobs[$index]['proof']) {
                        $imgsize = getimagesize($jobs[$index]['proof']);
                        $width = $imgsize[0];
                        $height = $imgsize[1];
                        $jobs[$index]['proof_w'] = $width;
                        $jobs[$index]['proof_h'] = $height;
                    }
                }
            }
        }

        return $jobs;
    }

    public function totalEvent() {
        return Event::all()->count();
    }
}