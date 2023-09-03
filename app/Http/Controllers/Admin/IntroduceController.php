<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IntroduceController extends Controller
{
    public function show() {
        return view('admin.pages.introduces.preview', [
            'title' => 'Giới thiệu',
            'page' => 'introduces'
        ]);
    }

    public function edit() {
        return view('admin.pages.introduces.edit', [
            'title' => 'Sửa giới thiệu',
            'page' => 'introduces'
        ]);
    }

    public function update(Request $request) {
        try {
            $introduceView = resource_path('views/introduce.blade.php');
            file_put_contents($introduceView, $request->input('content'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sửa giới thiệu clb thất bại!');
        }
        return redirect()->route('admin.introduces')->with('success', 'Sửa giới thiệu clb thành công!');
    }
}