<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function loginCheck(Request $request)
    {
        $request->validate([
            "email" => 'required|email',
            'password' => 'required',
        ]);
        $input = $request->only('email', 'password');
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            if (Auth::check()) {
                return response()->json([
                    "message" => 200,
                ]);
            } else {
                return response()->json([
                    "message" => 300,
                ]);
            }
        } else {
            return response()->json([
                "message" => 300,
            ]);
        }
    }
    public function registationSubmit(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ], [
            "first_name.required" => "First Name is Required",
            "last_name.required" => "Last Name is Required",
        ]);
        User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "email_verified_at" => date('Y-m-d'),
            "emailToken" => null,
            "password" => bcrypt($request->password),
            "plain_password" => $request->password,
            "contact_no" => +9230000000000,
            "country" => "No Country",
            "state" => "No State",
            "city" => "No City",
            "zip_code" => "No Code",
            "is_admin" => 0,
            "enter_from" => 'Email',
            "is_active" => 1,
            "picture" => "admin/assets/images/users/dummy.jpg",
        ]);
        return response()->json([
            "message" => 200,
        ]);
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('home');
        }
    }
}
