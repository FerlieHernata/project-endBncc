<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('login');
    }
    public function register(Request $request)
    {
        return view('register');
    }
    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($credentials)){
            // $request->session()->regenerate();
            if(Auth::user()->role_id == 1){
                return redirect('dashboard');
            }
            if(Auth::user()->role_id == 2){
                return redirect('home');
            }
        }
        // Cek apakah login valid/benar
        Session::flash('status','failed');
        Session::flash('message','Login Invalid');
        return redirect('/login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('login');
    }
    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|ends_with:@gmail.com|min:3|max:255',
            'password' => 'required|min:6|max:12',
            'phone' => ['required', 'regex:/^08\d{9,}$/'], // Nomor telepon harus diawali dengan "08" dan memiliki setidaknya 11 digit setelahnya
            'address' => 'required|string|between:10,100',
            'postcode' => 'required|string|between:5,5',
        ]);
        // Pemeriksaan tambahan untuk email
        $email = $request->email;
        if (substr($email, -10) !== '@gmail.com') {
            Session::flash('error', 'The email must end with @gmail.com');
            return redirect()->back()->withInput();
        }

        // Pemeriksaan tambahan untuk nomor telepon
        if (!preg_match('/^08/', $request->phone)) {
            Session::flash('error', 'The phone number must start with "08".');
            return redirect()->back()->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->postcode,
            'password' => bcrypt($request->password),
        ]);
        return redirect('login')->with('success', 'Registration successful! Welcome, ' . $user->name);
    }
}
