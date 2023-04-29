<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobUser;
use App\Models\Event;
use App\Models\EventJob;

class JobController extends Controller
{
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

    public function storeForEvent($event, Request $request)
    {
        
        
        try {

            $eventId = Event::where('slug', $event)->get()[0]['id'];
    
            $job = Job::create([
                'name' => str()->title($request->input('name')),
                'time_start' => $request->input('time-start'),
                'time_end' => $request->input('time-end'),
                'time_end' => $request->input('time-end'),
                'quantity' => $request->input('quantity'),
                'address' => $request->input('address'),
                'description' => $request->input('description'),
                'user_id' => auth()->user()['id'],
                'event_id' => $eventId,
                'active' => 1,
            ]);

            return redirect()->back()->with('success', 'Thêm công việc thành công!');
            
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm công việc thất bại!');
        }
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
    public function destroy($id)
    {
        JobUser::where('job_id', $id)->delete();

        Job::where('id', $id)->delete();
        
        return \redirect()->back()->with('success', 'Xóa công việc thành công!');
    }
}
