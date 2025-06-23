<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function createPetugas()
    {
        return view('admin.create-petugas');
    }

    public function storePetugas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

            // Validasi domain email
        $allowedDomain = '@pom.go.id';
        if (!str_ends_with($request->email, $allowedDomain)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Email harus menggunakan domain @pom.go.id.']);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas', // Khusus petugas
        ]);

        return redirect()->route('admin.create.petugas')->with('success', 'Petugas berhasil ditambahkan!');
    }
}
