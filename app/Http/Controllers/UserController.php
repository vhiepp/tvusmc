<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('client.pages.profile.view', [
            'title' => 'Thông tin cá nhân',
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
    public function edit()
    {
        return view('client.pages.profile.edit', [
            'title' => 'Cập nhật thông tin cá nhân',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {

            $birthday = \App\Helpers\Date::fomatDateInput($request->input('birthday'));

            $data = [
                'sur_name' => $request->input('sur_name'),
                'given_name' => $request->input('given_name'),
                'name' => $request->input('sur_name') . ' ' . $request->input('given_name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'birthday' => $birthday,
                'sex' => $request->input('sex'),
                'mssv' => $request->input('mssv'),
                'class' => $request->input('class'),
            ];

            // if ($request->input('email')) {
            //     $data['email'] = $request->input('email');
            // }

            if ($request->file('avatar')) {
                $data['avatar'] = \App\Helpers\UploadHelper::imgToBase64($request->file('avatar'), ['w' => 180, 'h' => 180]);
            }
            
            User::where('id', auth()->user()['id'])
                 ->update($data);

            return \redirect()->route('profile.view');
        } catch (\Throwable $th) {
            return \redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
