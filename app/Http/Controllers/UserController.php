<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorizationRequest;
use App\Http\Requests\RegistratinRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function auth_post(AuthorizationRequest $request)
    {
        if(Auth::attempt($request->validated()))
        {
            $request->session()->regenerate();
            return redirect('/credits');
        }
        return back();
    }

    public function reg_post(RegistratinRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect('/auth');
    }

    public function getAuthStatus()
    {
        if(Auth::check()) $authAmin = Auth::user()->isAdmin ? true : false;
            else $authAmin = false;

        $data =
            [
                'auth' => Auth::check(),
                'admin' => $authAmin
            ];

        return $data;
    }

    public function logOut()
    {
        if(empty(Auth::user())) return redirect('/auth');

        Auth::logout();

        return redirect('/');
    }
}
