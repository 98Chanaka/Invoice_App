<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }


    public function index(Request $request)
    {

        error_log(Hash::make("1111"));


        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Fetch user by username from the "logins" table
        $user = Login::where('username', $request->username)->first();

        if ($user) {
            error_log("User found: " . $request->username);
        } else {
            error_log("User not found: " . $request->username);
            return back()->with('error', 'Invalid credentials. Please try again.');
        }

        // Check if the user exists and the password matches
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            error_log("Login successful for user: " . $request->username);
            return view('stock');
        } else {
            error_log("Invalid password for user: " . $request->username);
            return back()->with('error', 'Invalid credentials. Please try again.');
        }
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
