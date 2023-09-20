<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index() {
        return view('client.pages.login');
    }

    public function microsoftLogin() {
        $microsoft = new \myPHPnotes\Microsoft\Auth (
            env('MICROSOFT_TENANT'),
            env('MICROSOFT_CLIENT_ID'),
            env('MICROSOFT_SECRET_ID'),
            env('APP_URL').env('MICROSOFT_CALLBACK_URL'),
            ["User.Read"]
        );

        return redirect($microsoft->getAuthUrl());
    }

    public function callbackMicrosoftLogin(Request $request) {
        $auth = new \myPHPnotes\Microsoft\Auth(
            \myPHPnotes\Microsoft\Handlers\Session::get("tenant_id"),
            \myPHPnotes\Microsoft\Handlers\Session::get("client_id"),
            \myPHPnotes\Microsoft\Handlers\Session::get("client_secret"),
            \myPHPnotes\Microsoft\Handlers\Session::get("redirect_uri"),
            \myPHPnotes\Microsoft\Handlers\Session::get("scopes")
        );

        $tokens = $auth->getToken($request->input('code'), $request->input('state'));
        $accessToken = $tokens->access_token;
        $auth->setAccessToken($accessToken);

        $userProvider = new \myPHPnotes\Microsoft\Models\User;

        $email = explode("@", $userProvider->data->getUserPrincipalName());

        // if ($email[1] != 'st.tvu.edu.vn') {
        //     return redirect()->route('client.login')
        //                      ->with('status', 'Chỉ sinh viên Trường đại học Trà Vinh mới được đăng nhập với Microsoft.');
        // }

        if ($email[1] == 'st.tvu.edu.vn') {
            $mssv = $email[0];
        }


        $provider = 'microsoft';

        $user = User::where('provider', $provider)->where('provider_id', $userProvider->data->getId())->first();

        if (!$user) {
            $user = new User();
            $user->name = $userProvider->data->getDisplayName();
            $user->sur_name = $userProvider->data->getSurname();
            $user->given_name = $userProvider->data->getGivenName();
            $user->email = $userProvider->data->getUserPrincipalName();
            $user->password = \Hash::make(rand());
            $user->phone = $userProvider->data->getMobilePhone();
            $user->class = $userProvider->data->getJobTitle();
            $user->role = 0;
            $user->mssv = $mssv;
            $user->active = 1;
            $user->avatar = "/assets/img/avt/default.jpg";
            $user->provider = $provider;
            $user->provider_id = $userProvider->data->getId();
            $user->save();
        }
        if ($user->active == 0) return redirect()->route('auth.login')->with('error_code', 'Bạn không có quyền đăng nhập vào trang này!');

        
        auth()->loginUsingId($user->id, true);

        return redirect()->route('client.home');
    }

    public function googleLogin() {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogleLogin() {
        $userProvider = Socialite::driver('google')->user()->user;

        $provider = 'google';
        $user = User::where('provider', $provider)->where('provider_id', $userProvider['id'])->first();

        if (!$user) {
            $user = new User();
            $user->name = $userProvider['family_name'] . ' ' . $userProvider['given_name'];
            $user->sur_name = $userProvider['family_name'];
            $user->given_name = $userProvider['given_name'];
            $user->email = $userProvider['email'];
            $user->password = \Hash::make(rand());
            $user->role = 0;
            $user->active = 1;
            $user->provider = $provider;
            $user->provider_id = $userProvider['id'];
            $user->avatar = $userProvider['picture'];

            $user->save();
        }
        if ($user->active == 0) return redirect()->route('auth.login')->with('error_code', 'Bạn không có quyền đăng nhập vào trang này!');
        
        

        auth()->loginUsingId($user->id, true);

        return redirect()->route('client.home');

    }

    public function logout() {
        if (auth()->check()) {
            auth()->logout();
        }
        return redirect()->back();
    }
}