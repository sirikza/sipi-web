<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebProfileController extends Controller
{
    public function index()
    {
        return view('welcome'); // Kita akan gunakan file welcome.blade.php yang sudah ada
    }
}
