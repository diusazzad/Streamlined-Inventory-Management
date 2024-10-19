<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:edit articles')->only('testmiddleware');
        $this->middleware('role:admin|writer')->only('testmiddleware');
    }
    public function index()
    {
        return view('home');
    }

    public function testmiddleware()
    {
        return 'Middleware Method Allowed';
    }
}
