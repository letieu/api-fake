<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function githubLogin()
    {
        return Socialite::driver('github')->redirect();
    }


    public function githubCallback()
    {
        $gitUser = Socialite::driver('github')->user();
        $user = User::where('github_id',$gitUser->getNickname())->first();

        if ( !$user) {
            $user = new User();
            $user->github_id = $gitUser->getNickname();
            $user->access_token = $gitUser->token;
            $user->save();

        }

        session(['user'=>$user ]);
        return redirect()->route('api.index');
    }

    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        session(['user' => '']);

        return redirect()->route('login.form');
    }
}
