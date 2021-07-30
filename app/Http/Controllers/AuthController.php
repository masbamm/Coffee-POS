<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            //Login Success
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $rules = [
            'username'              => 'required|string',
            'password'              => 'required|string'
        ];

        $messages = [
            'username.required'        => 'Username wajib diisi',
            'username.email'           => 'Username tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'name'     => $request->input('username'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            if (auth()->user()->role == 'admin') {
                //Login Success
                return redirect()->route('dashboard');
            } else if (auth()->user()->role == 'dapur' || auth()->user()->role == 'barista') {
                return redirect()->route('bahan.index');
            } else {
                return redirect()->route('order.index');
            }
        } else { // false

            //Login Fail
            Session::flash('error', 'Username atau password salah');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function lupa_password()
    {
        return view('auth.lupa_password');
    }

    public function ganti_password($id)
    {
        $user = User::findOrFail($id);

        return view('auth.ganti_password', ['user' => $user->id]);
    }

    public function konfir_lupa_password(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        $hitung = User::where('email', $email)->count();

        if ($hitung > 0) {
            if ($user->role == "admin") {
                return redirect(route('ganti_password', ['id' => $user->id]));
            } else if ($user->role != "admin") {
                Session::flash('error', 'Hanya admin yang diperbolehkan ganti password');
                return redirect()->back();
            } else {
                Session::flash('error', 'Email tidak ada dalam database');
                return redirect()->back();
            }
        } else {
            Session::flash('error', 'Email tidak ada dalam database');
            return redirect()->back();
        }
    }

    public function konfir_ganti_password(Request $request, $id)
    {
        $rules = [
            'password'              => 'required|confirmed'
        ];

        $messages = [
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        try {
            $user = User::findOrFail($id);
            $user->update([
                $user->password = bcrypt($request->password)
            ]);
            Session::flash('success', 'Password berhasil diganti Silahkan login');
            return redirect()->route('login');
        } catch (\Exception $e) {
            Session::flash('errors', ['' => 'Gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->back();
        }
    }

    // public function showFormRegister()
    // {
    //     return view('register');
    // }

    // public function register(Request $request)
    // {
    //     $rules = [
    //         'name'                  => 'required|min:3|max:35',
    //         'email'                 => 'required|email|unique:users,email',
    //         'password'              => 'required|confirmed'
    //     ];

    //     $messages = [
    //         'name.required'         => 'Nama Lengkap wajib diisi',
    //         'name.min'              => 'Nama lengkap minimal 3 karakter',
    //         'name.max'              => 'Nama lengkap maksimal 35 karakter',
    //         'email.required'        => 'Email wajib diisi',
    //         'email.email'           => 'Email tidak valid',
    //         'email.unique'          => 'Email sudah terdaftar',
    //         'password.required'     => 'Password wajib diisi',
    //         'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
    //     ];

    //     $validator = Validator::make($request->all(), $rules, $messages);

    //     if($validator->fails()){
    //         return redirect()->back()->withErrors($validator)->withInput($request->all);
    //     }

    //     $user = new User;
    //     $user->name = ucwords(strtolower($request->name));
    //     $user->email = strtolower($request->email);
    //     $user->password = Hash::make($request->password);
    //     $user->email_verified_at = \Carbon\Carbon::now();
    //     $simpan = $user->save();

    //     if($simpan){
    //         Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
    //         return redirect()->route('login');
    //     } else {
    //         Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
    //         return redirect()->route('register');
    //     }
    // }




}