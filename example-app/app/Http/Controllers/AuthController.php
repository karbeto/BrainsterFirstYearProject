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
                session()->put('id', $user->id);
                return redirect()->route('view-events');
            } else {
                Log::critical('User failed to login due to incorrect password: ' . $request->email);
                return redirect()->route('auth.login')->withErrors(['password' => 'Invalid password']);
            }
        } else {
            Log::critical('User failed to login with email: ' . $request->email);
            return redirect()->route('auth.indexLogin')->withErrors(['email' => 'Email not found']);
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

        return redirect()->route('auth.login');
    }
}
