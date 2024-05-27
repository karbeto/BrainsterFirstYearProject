<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(){
        return view("app.login");
    }
    public function register(){
        return view("app.register");
    }
    public function create()
    {
        echo "This is create mthod";
    }
    public function createEvent()
    {

        return view('app.create-event');
    }
}
