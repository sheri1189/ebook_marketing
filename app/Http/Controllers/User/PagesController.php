<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function home()
    {
        $plans = Plan::where('billing_period', 'month')->latest()->get();
        return view('User.Pages.home', compact("plans"));
    }
    public function onlineTutor()
    {
        return view('User.Pages.chatbot');
    }
    public function register()
    {
        return view('User.Pages.register');
    }
    public function login()
    {
        return view('User.Pages.login');
    }
    public function  getAllUsers()
    {
        $allusers = User::where('is_admin', 0)->latest()->get();
        return view('Admin.Pages.users', compact("allusers"));
    }
    public  function changeStatus($id)
    {
        $user = User::findorFail($id);
        if ($user->is_active == 1) {
            $user->is_active = 0;
            $getMessage = "Your Account is In-active From the Admin.Now You Cannot Login!";
        } else {
            $user->is_active = 1;
            $getMessage = "Your Account is Active From the Admin.Now You Can Login!";
        }
        $user->update();
        // Mail::to($user->email)->send(new StatusTemplate($user->first_name . " " . $user->last_name, $getMessage, "User Status", User::where('is_admin', 1)->first()->email));
        return response()->json([
            "message" => 200,
            "data" => $user,
        ]);
    }
    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
        return response()->json([
            "message" => 200,
        ]);
    }
    public function logout()
    {
        return redirect('/');
    }
    public function forget()
    {
        return view('User.Pages.forget');
    }
    public function profile()
    {
        return view('Admin.Pages.profile');
    }
    public function editProfile()
    {
        return view('Admin.Pages.profile_edit');
    }
    public function updateProfile(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $message = "";
        if ($request->hasFile("picture")) {
            $image = $request->file('picture');
            $extension = $image->getClientOriginalExtension();
            $imageName = rand(10000, 90000) . "." . $extension;
            $image->move('./images/', $imageName);
            $message = 200;
        }
        if ($message == 200) {
            $picture = "./images/" . $imageName;
        } else {
            $picture = $user->picture;
        }
        User::where('id', $id)->update([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "contact_no" => $request->contact_no,
            "country" => $request->country,
            "state" => $request->state,
            "city" => $request->city,
            "picture" => $picture,
            "zip_code" => $request->zip_code,
            "address" => $request->address,
        ]);
        $afterUpdate = User::where('id', $id)->first();
        $data = [
            'name' => ucfirst($afterUpdate->first_name) . " " . ucfirst($afterUpdate->last_name),
            'first_name' => ucfirst($afterUpdate->first_name),
            'last_name' => ucfirst($afterUpdate->last_name),
            'email' => $afterUpdate->email,
            'picture' => $afterUpdate->picture,
            'contact_no' => $afterUpdate->contact_no,
            'country' => $afterUpdate->country,
            'state' => $afterUpdate->state,
            'city' => $afterUpdate->city,
            'zip_code' => $afterUpdate->zip_code,
            'address' => $afterUpdate->address,
        ];

        return response()->json([
            "message" => 200,
            "data" => $data,
        ]);
    }
    public function emailUpdate(Request $request, $id)
    {
        $request->validate([
            "email" => "unique:users,email,$id",
        ]);
        User::where('id', $id)->update([
            "email" => $request->email,
        ]);
        $afterEmailUpdate = User::where('id', $id)->first();
        $data = [
            'email' => $afterEmailUpdate->email,
        ];
        return response()->json([
            "message" => 200,
            "data" => $data,
        ]);
    }
    public function passwordUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ],
            [
                'password.confirmed' => 'Your Password is not Matched with the Confirm Password',
                'password.required' => 'Password Field is required',
                'password_confirmation.required' => 'Comfirmation Password is required within the Password',
            ]
        );
        User::where('id', $id)->update([
            "plain_password" => $request->password,
            "password" => bcrypt($request->password),
        ]);
        return response()->json([
            "message" => 200,
            "password" => User::where('id', $id)->first()->plain_password ?? "",
        ]);
    }
}
