<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\userFormRequest;
use App\Models\User;
use App\Services\Messages;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register(userFormRequest $request)
    {
        $data = $request->validated();
        $user = User::query()->create($data);
        $user->createToken($data['email'])->plainTextToken;
        return Messages::success(message: 'Register process done successfully');
    }
}
