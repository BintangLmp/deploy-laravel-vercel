<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class GuestController extends Controller
{
    public function home()
    {
        return view('home');
    }
}
