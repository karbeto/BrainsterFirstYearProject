<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('app.login');
    }
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                session()->put('email', $request->email);
                session()->put('id', $request->id);
                return redirect()->route("view-events");
            }
        } else {
            Log::critical('User failed to login ' . $request->email);
            return redirect()->route('login');
        }

       
    }
    public function indexRegister()
    {
        return view('app.register');
    }
    public function register(RegisterUser $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->company = $request->company;
        $user->color = "purple";
        $user->save();



        session()->flash('msg', 'User created');

        return redirect()->route('login');
    }
}
