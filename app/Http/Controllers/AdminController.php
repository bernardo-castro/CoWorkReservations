<?php

namespace App\Http\Controllers;

use App\Models\Space;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function manageSpaces()
    {
        $spaces = Space::all();
        return view('admin.manageSpaces', compact('spaces'));
    }

}
