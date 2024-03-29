<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {{
        $user = Auth::user();
        return view('profile.profile', compact('user'), [
            'title' => 'Profil',
        ]);
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();
        return view('profile.editProfile', [
            'user' => $user,
            'title' => 'Profil',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email:dns',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'phone' => ['required', 'regex:/^(62)[0-9]{11}/'],
        ];

        if ($request->username != Auth::user()->username) {
            $rules['username'] = 'required|unique:users';
        }

        $validatedData = $request->validate($rules);

        User::where('id', Auth::user()->id)->update($validatedData);

        return redirect('profile/' . Auth::user()->username)->with('successUpdate', 'Data diri berhasil diperbarui');
    }

    public function updateImage(Request $request, User $user)
    {
        $rule = [
            'image' => 'image|file|max:1024',
        ];

        $validatedData = $request->validate($rule);

        if ($request->file('image')) {
            if ($request->oldImage) {
                $destination = public_path('img/' . $request->oldImage);
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            $validatedData['image'] = $request->file('image')->store('profile-images', 'public_uploads');
        }

        User::where('id', Auth::user()->id)->update($validatedData);

        return redirect('profile/' . Auth::user()->username)->with('successUpdate', 'Foto profil berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
