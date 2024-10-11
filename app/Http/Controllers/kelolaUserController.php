<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;

class kelolaUserController extends Controller
{
    public function index()
    {
        $kuser = User::orderBy('id', 'asc')->get();
        return view('admin.user.kelolaUser', compact('kuser'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'tamu',
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('kelola-users.index')
        ->with('success', 'Data Pengguna Berhasil DiTambahkan');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:15',
        ]);

        // Cek apakah email sudah digunakan oleh user lain
        $existingUsersUpdate = User::where('email', $request->email)
            ->where('id', '!=', $id)
            ->first();

        if ($existingUsersUpdate) {
            return redirect()->route('kelola-users.index')
                ->with('error', 'Email Tersebut Sudah Tersedia.');
        }

        // Update user
        $kelolaUser = User::find($id);
        $kelolaUser->update([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()->route('kelola-users.index')
            ->with('success', 'Data Pengguna Berhasil Diubah');
    }
}
