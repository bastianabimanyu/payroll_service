<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserloginController extends Controller
{
    public function index() {
        $users = User::latest()->get();
        return view("admin.userlogin", compact('users'));
    }
}
