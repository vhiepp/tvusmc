<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobUser;

class JobController extends Controller
{
    
    public function userSub(Request $request) {
        
        $result = JobUser::create([
            'active' => 1,
            'user_id' => auth()->user()['id'],
            'time_sub' => \App\Helpers\Date::getNow(),
            'job_id' => $request->input('id'),
        ]);

        return \redirect()->back();
    }


}
