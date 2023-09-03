<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntroduceController extends Controller
{
    public function show() {
        return view('client.pages.introduces.view', [
            'title' => 'Giới thiệu | TVU Social Media Club'
        ]);
    }
}
