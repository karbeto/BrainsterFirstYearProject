<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'company' => 'required|string|max:255',
        ]);

        $user = Users::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'company' => $validatedData['company'],
        ]);
    }
    public function createEvent()
    {

        return view('app.create-event');
    }
}
