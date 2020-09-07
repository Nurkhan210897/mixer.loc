<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function run()
    {
        Artisan::call('storage:link');
        Artisan::call('migrate');
    }
}
