<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use App\Http\Services\EventService;
use App\Models\Event;
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
            'events' => $this->eventService->get(['comparison' => '>', 'number' => 0]),
            'eventsHappening' => $this->eventService->getEventsIsHappening()
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

            if(strtotime($request->input('time-start')) >= strtotime($request->input('time-end'))) {
                return \redirect()->back()->with('error', 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc!')->withInput();
            }
            

            Event::create([
                'name' => $request->input('name'),
                'slug' => Str::of($request->input('name'))->slug('-'),
                'content' => $request->input('content'),
                'time_start' => $request->input('time-start'),
                'time_end' => $request->input('time-end'),
                'user_id' => auth()->user()['id'],
                'category_id' => $request->input('categories'),
                'active' => $request->input('post-now') ? 1 : 0,
            ]);
        } catch (\Throwable $th) {
            return \redirect()->back()->with('error', 'Tạo sự kiện thất bại!');
        }

        return \redirect()->route('admin.events')->with('success', 'Tạo sự kiện thành công!');
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
}
