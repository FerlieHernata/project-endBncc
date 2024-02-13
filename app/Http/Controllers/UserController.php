<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user',['user' => $users]);
    }
    public function add()
    {
        $users = User::all();
        return view('user-add',['users' => $users]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|ends_with:@gmail.com|min:3|max:255',
            'password' => 'required|min:6|max:12',
            'phone' => ['required', 'regex:/^08\d{9,}$/'],
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
            'password' => bcrypt($request->password),
        ]);
        return redirect('user')->with('status','User Added Successfully');
    }
    public function edit($slug)
    {
        $users = User::where('slug',$slug)->first();
        return view('user-edit',['user' => $users]);
    }
    public function update(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->first();

        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|unique:users,name,' . $user->id . '|max:255',
            'email' => 'email|ends_with:@gmail.com|min:3|max:255',
            'phone' => ['regex:/^08\d{9,}$/'],
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

        // Update data
        $user->update($request->all());

        return redirect('user')->with('status', 'User Data Updated Successfully');
    }
    public function delete($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();
        return redirect('user')->with('status', 'User Deleted Successfuly');
    }
    public function deleted()
    {
        $user = User::onlyTrashed()->get();
        return view('user-deleted',['deleted' => $user]);
    }
    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug',$slug)->first();
        $user->restore();
        return redirect('user')->with('status','User Has Been Restored');
    }
}
