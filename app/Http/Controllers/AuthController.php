<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function login()
    {
        $previousURL = url()->previous();
        $baseURL = url()->to("/");

        if($previousURL != $baseURL . "/login"){
            session()->put('url.intended', $previousURL);
        }
        return view("auth.login");
    }

    // public function loginform(Request $request)
        // {
        //     $credentials = $request->validate([
        //         'email' => ['required', 'email'],
        //         'password' => ['required'],
        //     ]);

        //     // if (Auth::attempt($credentials)) {
        //     //     return redirect()->route('index');
        //     // }

        //     if (Auth::attempt($credentials)) {
        //         $user = Auth::user();

        //         if ($user->role === 'employer') {
        //             return redirect()->route('dashboard');
        //         } else {
        //             return redirect('/');
        //         }
        //     }

    // }

    public function loginform(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'employer') {
                return redirect()->route('payment');
            } elseif ($user->role === 'admin') {
                return redirect()->route('userList');
            } else {
                return redirect()->intended("/");
            }
        }
        return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
    }


    public function register()
    {
        return view('auth.register');
    }

    // public function registerform(Request $request)
        // {
        //     $request->validate([
        //         'name'=>"required",
        //         'email'=>"required",
        //         'password'=>"required",
        //         'role'=>"required",
        //     ]);
        //     User::create([
        //         'name'=>$request->name,
        //         'email'=>$request->email,
        //         'password'=>$request->password,
        //         'role'=>$request->role,
        //     ]);
        //     return redirect()->route('login');
    // }

    public function registerform(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);

        // $active = $request->input('role') === 'employer' ? 0 : 1;
        $active = $request->role === 'employer' ? 0 : 1;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'active' => $active,
        ]);

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function registerUpdate(Request $request, $id)
    {
        $request->validate([
            'image'=>"required|image|mimes:png,jpg,jpeg",
        ]);
        $user = Auth::user();
        if($user->image) {
            Storage::delete('public/images/'. $user->image);
        }
        $image = $request->image;
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->storeAs('public/images/', $imageName);

        $user = User::findOrfail($id);

        $user->update([
            "image" => $imageName,
        ]);

        return redirect()->route('profile')->with("success", "Photo has uploded successfully!");
    }
}