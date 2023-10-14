<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WebRegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register',
        ]);
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:6|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|max:255',
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = bcrypt($validatedData['password']);
        // dd($validatedData);
        User::create($validatedData);

        // $request->session()->flash('successRegist', 'Registration Successfull! Please Login');

        return redirect('/login')->with('successRegist', 'Registration Successfull! Please Login');
    }
}
