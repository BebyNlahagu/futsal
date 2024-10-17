<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileKasirController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('kasir.profil',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'img' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        $user = Auth::user();
        $imagePath = $user->img;

        if ($request->hasFile('img')) {
            if ($user->img && Storage::exists('public/images/' . $user->img)) {
                Storage::delete('public/images/' . $user->img);
            }
            $imagePath = $request->file('img')->store('images', 'public');
            Log::info('Image uploaded path: ' . $imagePath);
        }

        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'img' => $imagePath,

        ]);

        Alert::success('success', 'Profil Berhasil Di Update');
        return redirect()->back();
    }
}
