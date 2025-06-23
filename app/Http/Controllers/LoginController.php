<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\AllowedEmail;
use App\Models\Survey;


class LoginController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('login');
    }

    // Proses autentikasi pengguna
    public function authenticate(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cek apakah validasi berhasil
        if ($validator->passes()) {

            $email = $request->email;
            $allowedDomain = '@pom.go.id';

            $emailAllowed = AllowedEmail::where('email', $email)->exists();
            $domainAllowed = str_ends_with($email, $allowedDomain);

            if (!$emailAllowed && !$domainAllowed) {
                return redirect()->route('account.login')
                    ->with('error', 'Email ini tidak diizinkan untuk login.')
                    ->withInput();
            }

            // Cek apakah email terdaftar
            $user = User::where('email', $request->email)->first();

            if ($user) {
                // Jika email ada → cek password
                if (Hash::check($request->password, $user->password)) {
                    Auth::login($user);
                    return redirect()->route('account.dashboard');
                } else {
                    // Password salah
                    return redirect()->route('account.login')
                        ->with('error', 'Password yang Anda masukkan salah.')
                        ->withInput();
                }
            } else {
                // Jika email tidak ditemukan
                return redirect()->route('account.login')
                    ->with('error', 'Email tidak ditemukan.')
                    ->withInput();
            }
        } else {
            // Jika validasi gagal
            return redirect()->route('account.login')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function register(){
       
        return view('register');
    }

    public function processRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:24|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 50 karakter.',
    
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
    
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.max' => 'Password maksimal 24 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

            $email = $request->email;
            $allowedDomain = '@lokapom.com';

            $emailAllowed = AllowedEmail::where('email', $email)->exists();
            $domainAllowed = str_ends_with($email, $allowedDomain);

            if (!$emailAllowed && !$domainAllowed) {
                return redirect()->route('account.register')
                    ->withInput()
                    ->withErrors(['email' => 'Email ini tidak diizinkan untuk registrasi.']);
            }

    
        if($validator->passes()){
            $user = new User();
            $user->name = $request->name; 
            $user->email = $request->email; 
            $user->password = Hash::make($request->password);
            $user->role = 'petugas';
            $user->save();
    
            return redirect()->route('account.login')->with(['success' => 'Registrasi berhasil! Silakan login.']);
        } else{
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }
    }

    // Tampilkan form ganti password
    public function showChangePasswordForm()
    {
        return view('change-password');
    }

    // Proses perubahan password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('account.login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Verifikasi password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('account.dashboard')->with('success', 'Password berhasil diganti.');
    }

    public function showLoginForm()
    {
        $surveyData = [
            'Sangat Baik' => Survey::whereBetween('survey', [88.31, 100.00])->count(),
            'Baik' => Survey::whereBetween('survey', [76.61, 88.30])->count(),
            'Kurang Baik' => Survey::whereBetween('survey', [65.00, 76.60])->count(),
            'Tidak Baik' => Survey::whereBetween('survey', [25.00, 64.99])->count(),
        ];

        return view('login', compact('surveyData'));
    }

    
    
    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }   
}

