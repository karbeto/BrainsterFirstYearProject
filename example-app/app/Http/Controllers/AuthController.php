<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use app\Models\Users;
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
        $user = Users::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                session()->put('email', $request->email);
            }
        } else {
            Log::critical('User failed to login ' . $request->email);
        }

        return redirect()->route('dashboard');
    }
    public function indexRegister()
    {
        return view('app.register');
    }
    public function register(RegisterUser $request)
    {

        Users::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'company' => $request->company]);

        session()->flash('msg', 'User created');

        return redirect()->route('auth.indexLogin');
    }
}
