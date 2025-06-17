<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Composer;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $totalUsers = User::count();
        $totalComposers = Composer::count();
        $totalSongs = Song::count();

        return view('admin.dashboard', compact('totalUsers', 'totalComposers', 'totalSongs'));
    }
}
