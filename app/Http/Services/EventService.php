<?php

namespace App\Http\Services;

use App\Models\Event;

class EventService {
    
    public function get($a = ['comparison' => '>=', 'number' => 0]) {

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
                            ->paginate(10);
        
            return $events;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return false;
    }

    public static function getEventsIsHappening() {
        try {

            $events = Event::where('events.active', 1)
                            ->orderByDesc('events.time_start')
                            ->join('users', 'events.user_id', '=', 'users.id')
                            ->join('categories', 'events.category_id', '=', 'categories.id')
                            ->select(
                                'events.*',
                                'users.name as user_name',
                                'users.class as user_class',
                                'categories.name as category_name'
                            )
                            ->paginate(10);
        
            return $events;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return false;
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
                            ->get($page);
        
            return $events;

        } catch (\Throwable $th) {
            //throw $th;
        }

        return false;
    }

}