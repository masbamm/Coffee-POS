<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->where('role', '!=', 'admin')->paginate(10);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:users',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'role' => 'required',
            'status' => 'required'
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'status' => $request->status
            ]);

            return redirect(route('user.index'))
                ->with(['success' => '<strong>' . $user->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        //query select berdasarkan id
        $user = User::findOrFail($id);

        $user->delete();
        return redirect()->back()->with(['success' => '<strong>' . $user->name . '</strong> Telah Dihapus!']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required',
            'status' => 'required'
        ]);

        try {
            $user = User::findOrFail($id);
            $password = $request->password;
            if ($password == '') {
                $password = $user->password;
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($password),
                'role' => $request->role,
                'status' => $request->status
            ]);

            return redirect(route('user.index'))
                ->with(['success' => '<strong>' . $user->name . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
}