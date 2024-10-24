<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        Rating::create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        Alert::success('Berhasil','Rating Dan Komentar Berhasil Di Tambahkan');
        return redirect()->back();
    }
}
