<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Services\EventService;
use App\Http\Services\BlogService;
use App\Http\Services\JobService;

class DashBoardController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService, EventService $eventService, BlogService $blogService, JobService $jobService)
    {
        $this->userService = $userService;
        $this->eventService = $eventService;
        $this->blogService = $blogService;
        $this->jobService = $jobService;
    }

    public function index() {

        return view('admin.pages.dashboard', [
            'title' => 'Quản trị',
            'page' => 'dashboard',
            'totalUser' => $this->userService->totalUser(),
            'totalEvent' => $this->eventService->totalEvent(),
            'totalBlog' => $this->blogService->totalBlog(),
            'jobInMonth' => $this->jobService->jobInMonth(),
            'userJoinJobInMonth' => $this->userService->totalUserJoinJobInMonth(),
            'listUserJoinJobInMonth' => $this->userService->userJoinJobInMonth(),
        ]);
    }

}