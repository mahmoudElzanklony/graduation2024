<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Messages;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login()
    {
        $data = ['email'=>request('email'),'password'=>request('password')];
        if(auth()->attempt($data)){
            $user = User::query()->where('email',$data['email'])->first();
            $user['token'] = $user->createToken($data['email'])->plainTextToken;
            return Messages::success('Login successfully',$user);
        }else{
            return Messages::error('email or password is not correct');
        }
    }
}
