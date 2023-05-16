<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobUser;
use App\Models\Event;
use App\Models\EventJob;
use App\Http\Services\JobService;

class JobController extends Controller
{
    protected $jobService;

    public function __construct(JobService $jobService) {
        $this->jobService = $jobService;
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

    public function storeForEvent($event, Request $request)
    {
        
        
        try {

            $timeStart = \App\Helpers\Date::fomatDateInput($request->input('time-start'));
            $timeEnd = \App\Helpers\Date::fomatDateInput($request->input('time-end'));

            $eventId = Event::where('slug', $event)->get()[0]['id'];
    
            $job = Job::create([
                'name' => $request->input('name'),
                'time_start' => $timeStart,
                'time_end' => $timeEnd,
                'quantity' => $request->input('quantity'),
                'address' => $request->input('address'),
                'description' => $request->input('description'),
                'user_id' => auth()->user()['id'],
                'event_id' => $eventId,
                'active' => 1,
            ]);

            return redirect()->back()->with('success', 'Thêm công việc thành công!');
            
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm công việc thất bại!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return view('admin.pages.jobs.preview', [
            'title' => 'Công việc',
            'job' => $this->jobService->getJobById($request->id),
            'users' => $this->jobService->getUsersByJobId($request->id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.pages.jobs.edit', [
            'title' => 'Chỉnh sửa công việc',
            'job' => $this->jobService->getJobById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $timeStart = \App\Helpers\Date::fomatDateInput($request->input('time-start'));
            $timeEnd = \App\Helpers\Date::fomatDateInput($request->input('time-end'));
            
            Job::where('id', $id)
                ->update([
                    'name' => $request->input('name'),
                    'quantity' => $request->input('quantity'),
                    'address' => $request->input('address'),
                    'description' => $request->input('description'),
                    'time_start' => $timeStart,
                    'time_end' => $timeEnd,
                ]);
            
            return redirect()->route('admin.jobs.preview', ['id' => $id])->with('success', 'Chỉnh sửa công việc thành công');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Chỉnh sửa công việc thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroyUser(Request $request) {
        
        JobUser::where('job_id', $request->input('job_id'))
                ->where('user_id', $request->input('user_id'))
                ->delete();
        return redirect()->back()->with('success', 'Đã xóa user khỏi công việc này');

    }
    
    public function destroy($id)
    {
        JobUser::where('job_id', $id)->delete();

        Job::where('id', $id)->delete();
        
        return \redirect()->back()->with('success', 'Xóa công việc thành công!');
    }
}
