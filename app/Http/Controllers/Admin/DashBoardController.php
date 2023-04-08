<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\UserService;

class DashBoardController extends Controller
{

    protected $userService;

    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index() {

        return view('admin.pages.dashboard', [
            'title' => 'Quản trị',
            'page' => 'dashboard',
            'newUserInMonth' => $this->userService->countNewUsersInMonth(date('m')),
        ]);

    }


}
