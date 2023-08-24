<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userStorePage()
    {
        $user = \request()->user();

        $result = [

        ];

    }
}
