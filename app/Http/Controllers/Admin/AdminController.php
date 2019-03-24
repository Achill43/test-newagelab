<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;

class AdminController extends Controller
{
    //Dashboard page
    public function dashboard(){
        return view('dashboard');
    }
}
