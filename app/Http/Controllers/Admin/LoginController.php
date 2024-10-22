<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return inertia('Admin/LoginForm');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ]);

        $userRole = Role::where('name', 'user')->pluck('id')->first();
        $user = User::where('email', $request->input('email'))->first();

        if ($user && $user->role_id !== $userRole) {
            if (Auth::attempt($request->only('email', 'password'))) {
                if (Auth::user()->isAdmin()) {
                    return to_route('admin.dashboard');
                }
                return to_route('admin.orders.index');
            } else {
                return back()->withErrors([
                    'password' => 'The provided password is incorrect.',
                ]);
            }
        } else {
            return redirect()->back()->withErrors([
                'email' => $user ? 'The email provided does not belong to an admin account.' : 'No account found with the provided email.',
            ]);
        }
    }
}
