<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index_admin()
    {
        $stats = [
            'total' => Pendaftaran::count(),
            'pending' => Pendaftaran::where('status', 'pending')->count(),
            'diterima' => Pendaftaran::where('status', 'diterima')->count(),
            'ditolak' => Pendaftaran::where('status', 'ditolak')->count()
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function index_user()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        return view('user.dashboard', compact('pendaftaran'));
    }
}
