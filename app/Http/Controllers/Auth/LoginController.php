<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect the user based on their role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Cek role pengguna dan arahkan sesuai dengan role
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard'); // Arahkan ke dashboard admin
        } elseif ($user->role == 'pemesan') {
            return redirect()->route('pemesan.dashboard'); // Arahkan ke dashboard pemesan
        }

        // Jika tidak ada role yang ditemukan, arahkan ke halaman utama
        return redirect('/');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}