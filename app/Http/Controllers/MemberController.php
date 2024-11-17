<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Member;
use App\Models\Paket;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $member = Member::with('user','paket','jadwal');
        $paket = Paket::all();
        $jadwal = Jadwal::all();
        return view('user.member',compact('member','paket','jadwal'));
    }

    public function store(Request $request, $id)
    {

    }
}
