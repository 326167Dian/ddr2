<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $profile = Auth::user(); // ambil user yang sedang login
        return view('frontend.account.profile', compact('profile'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $profile = Auth::user();
        return view('frontend.account.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'no_tlp' => 'nullable',
            'alamat' => 'nullable',
            'profesi' => 'nullable',
            'suku' => 'nullable|in:Limo Panjang,Simabur,Limo Singkek,Piliang',
            'foto' => 'nullable|image|max:2048',
            'password' => 'nullable|min:6',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('profiles', 'public');
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);

        return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
