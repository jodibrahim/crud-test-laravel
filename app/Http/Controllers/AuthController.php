<?php

namespace App\Http\Controllers;

use App\Models\UserNew as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:tbl_user|max:50',
            'password' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/|confirmed',
            'nohp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        DB::table('tbl_user')->insert([
            'nama' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'nohp' => $input['nohp'],
            'alamat' => 'Jalan Sesama',
            'akses' => '0'
        ]);

        return redirect('/');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->akses == '0') {
                return redirect()->route('home');
            } else if (auth()->user()->akses == '1') {
                return redirect()->route('public.home');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
