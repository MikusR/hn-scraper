<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AppController extends Controller
{
    public function main(): View
    {
        return view('app');
    }
}
