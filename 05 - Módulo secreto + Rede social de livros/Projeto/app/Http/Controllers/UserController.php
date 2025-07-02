<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterUserRequest;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        dd($request->validated());
    }
}
