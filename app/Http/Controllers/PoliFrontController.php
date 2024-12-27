<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;

class PoliFrontController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        return view('welcome', compact('polis'));
    }
}
