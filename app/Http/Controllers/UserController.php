<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $dataUser = User::all();
        $no = 0;
        return view('user.index', compact('dataUser', 'no'));
    }
}
