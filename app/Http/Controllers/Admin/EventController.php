<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use App\Http\Services\EventService;
use App\Models\Event;
use App\Models\Job;
use App\Models\JobUser;
use App\Helpers\UploadHelper;
use Illuminate\Support\Str;


class EventController extends Controller
{
    protected $categoryService;
    protected $eventService;

    public function __construct(CategoryService $categoryService, EventService $eventService) {
        $this->categoryService = $categoryService;
        $this->eventService = $eventService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.events.list', [
            'title' => 'Sự kiện',
            'page' => 'events',
            'eventsComing' => $this->eventService->getEventsIsComing(),
            'eventsHappening' => $this->eventService->getEventsIsHappening(),
            'eventsOver' => $this->eventService->getEventsOver(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.events.create', [
            'title' => 'Tạo sự kiện mới',
            'page' => 'events',
            'categories' => $this->categoryService->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        try {

            $timeStart = \App\Helpers\Date::fomatDateInput($request->input('time-start'));
            $timeEnd = \App\Helpers\Date::fomatDateInput($request->input('time-end'));

            if(strtotime($timeStart) >= strtotime($timeEnd)) {
                return \redirect()->back()->with('error', 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc!')->withInput();
            } 

            if ($request->input('thumb')) {
            
                $thumb = $request->input('thumb');
            
            }

            $slug = Str::of($request->input('name'))->slug('-');

            $event = Event::create([
                'name' => $request->input('name'),
                'slug' => $slug,
                'content' => $request->input('content'),
                'time_start' => $timeStart,
                'time_end' => $timeEnd,
                'address' => $request->input('address'),
                'thumb' => $thumb,
                'user_id' => auth()->user()['id'],
                'category_id' => $request->input('categories'),
                // 'active' => $request->input('post-now') ? 1 : 0,
                'active' => 1,
            ]);

            return redirect()->route('admin.events.preview', ['slug' => $event['slug']->value()])->with('success', 'Tạo sự kiện thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Tạo sự kiện thất bại!')->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $event = $this->eventService->getBySlug($request->slug);
        $jobs = $this->eventService->getJobByEventId($event['id']);
        // dd($jobs);
        return view('admin.pages.events.preview', [
            'title' => 'Sự kiện',
            'page' => 'events',
            'event' => $event,
            'jobs' => $jobs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $event = $this->eventService->getBySlug($request->slug);
        
        return view('admin.pages.events.edit', [
            'title' => 'Chỉnh sửa sự kiện',
            'page' => 'events',
            'event' => $event,
            'categories' => $this->categoryService->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {

            $timeStart = \App\Helpers\Date::fomatDateInput($request->input('time-start'));
            $timeEnd = \App\Helpers\Date::fomatDateInput($request->input('time-end'));

            if(strtotime($timeStart) >= strtotime($timeEnd)) {
                return \redirect()->back()->with('error', 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc!')->withInput();
            }

            if ($request->input('thumb')) {
            
                $thumb = $request->input('thumb');
            
            }

            $slug = Str::of($request->input('name'))->slug('-');

            $event = Event::where('slug', $request->input('slug'))->update([
                'name' => $request->input('name'),
                'slug' => $slug,
                'content' => $request->input('content'),
                'time_start' => $timeStart,
                'time_end' => $timeEnd,
                'address' => $request->input('address'),
                'thumb' => $thumb,
                'user_id' => auth()->user()['id'],
                'category_id' => $request->input('categories'),
                // 'active' => $request->input('post-now') ? 1 : 0,
                'active' => 1,
            ]);

            return redirect()->route('admin.events.preview', ['slug' => $slug->value()])->with('success', 'Chỉnh sửa sự kiện thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Chỉnh sửa sự kiện thất bại!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        
        try {
            
            $eventId = Event::where('slug', $request->input('slug'))->get()[0]['id'];
    
            JobUser::join('jobs', 'jobs.id', '=', 'job_users.job_id')
                    ->where('jobs.event_id', $eventId)
                    ->delete();
    
            Job::where('event_id', $eventId)->delete();
    
            Event::where('slug', $request->input('slug'))->delete();

        } catch (\Throwable $th) {
            return \redirect()->back()->with('error', 'Xóa sự kiện thất bại!');
        }

        return \redirect()->route('admin.events')->with('success', 'Xóa sự kiện thành công!');
    }
}
