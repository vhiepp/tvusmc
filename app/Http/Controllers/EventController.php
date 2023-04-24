<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\EventService;

class EventController extends Controller
{

    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function get($role) {
        $results = $this->eventService->getAll();

        $timeNow = \App\Helpers\Date::getNow();

        $data = [];

        
        foreach ($results as $index => $result) {

            if (strtotime($result['time_start']) > strtotime($timeNow)) {
                $status = 'info';
            } elseif (strtotime($result['time_start']) <= strtotime($timeNow) && strtotime($timeNow) <= strtotime($result['time_end'])) {
                $status = 'success';
            } else {
                $status = 'important';
            }

            array_push($data, [
                'title' => $result['name'],
                'allDay' => false,
                'start' => [
                    'y' => date('Y', strtotime($result['time_start'])),
                    'm' => date('m', strtotime($result['time_start'])),
                    'd' => date('d', strtotime($result['time_start'])),
                    'h' => date('H', strtotime($result['time_start'])),
                    'i' => date('i', strtotime($result['time_start']))
                ],
                'end' => [
                    'y' => date('Y', strtotime($result['time_end'])),
                    'm' => date('m', strtotime($result['time_end'])),
                    'd' => date('d', strtotime($result['time_end'])),
                    'h' => date('H', strtotime($result['time_end'])),
                    'i' => date('i', strtotime($result['time_end']))
                ],
                'status' => $status,
                'url' => $role == 'admin' ? route('admin.events.preview', ['slug' => $result['slug']]) : $result['slug'],

            ]);
            
        }

        return response()->json($data);
    }
}
