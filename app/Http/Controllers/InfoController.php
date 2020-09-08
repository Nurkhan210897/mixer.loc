<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function contacts()
    {
        return view('contacts');
    }

    public function about()
    {
        return view('about');
    }

    public function delivery()
    {
        return view('delivery');
    }

    public function payment()
    {
        return view('payment');
    }

    public function requisites()
    {
        return view('requisites');
    }

    public function services()
    {
        return view('services');
    }

    public function cooperation()
    {
        return view('cooperation');
    }
}
