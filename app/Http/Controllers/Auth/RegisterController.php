<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tempat_lahir' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'numeric'],
            'img' => ['required', 'image'],
        ]);
    }

    protected function create(array $data)
    {
        $imagePath = $data['img']->store('public/images');

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tempat_lahir' => $data['tempat_lahir'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
            'img' => $imagePath,
            'role' => 0,
        ]);
    }

    protected function registered(Request $request, $user)
    {
        // Atur pengalihan berdasarkan role setelah registrasi
        if ($user->role == 1) {
            return redirect()->route('admin.index');
        } elseif ($user->role == 2) {
            return redirect()->route('casir.index');
        } elseif ($user->role == 0) {
            return redirect()->route('user.index');
        }

        return redirect()->route('halaman.index');
    }
}
