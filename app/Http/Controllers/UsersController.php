<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function index()
    {
        $data = User::query()->orderBy('id','DESC')->get();
        return UserResource::collection($data);
    }
}
