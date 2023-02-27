<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class UserSignupController extends Controller
{
    public function show()
    {
        return view('auth.signup');
    }

    public function store(SignUpRequest $request)
    {
        $newUser = new User($request->validated());
        $newUser->username = $request->input('display_name') . '_' . random_int(1, 100);
        $newUser->folder_id = Str::uuid();
        $newUser->save();
        event(new Registered($newUser));

        Auth::login($newUser, true);

        return to_route('verification.notice');
    }
}
