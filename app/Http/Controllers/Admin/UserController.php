<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Models\User;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.users.list', [
            'title' => 'Thành viên',
            'page' => 'users',
            'users' => $this->userService->getUsers(8),
            'usersAdmin' => $this->userService->getUsersAdmin(),
        ]);
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
    public function update(Request $request)
    {
        try {
                
            $data = [];
            $data['sur_name'] = $request->input('sur_name');
            $data['given_name'] = $request->input('given_name');
            $data['name'] = $request->input('sur_name') . ' ' . $request->input('given_name');
            $data['phone'] = $request->input('phone');
            $data['address'] = $request->input('address');
            $data['birthday'] = \App\Helpers\Date::fomatDateInput($request->input('birthday'));
            $data['class'] = $request->input('class');
            $data['sex'] = $request->input('sex');
            $data['mssv'] = $request->input('mssv');
            
            User::where('id', $request->input('id'))
                 ->update($data);

            return \redirect()->back()->with('success', 'Cập nhật thông tin thành công');
        } catch (\Throwable $th) {
            return \redirect()->back()->with('error', 'Có lỗi xảy ra!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            //code...
            User::where('id', $id)->update([
                'active' => 0
            ]);
    
            return redirect()->back()->with('success', 'Xóa user thành công!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Có lỗi xảy ra!');
        }
    }
}
