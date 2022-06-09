<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{

    function index(){
        return Inertia::render('Dashboard', [
            //         'canLogin' => Route::has('login'),
            //         'canRegister' => Route::has('register'),
            //         'laravelVersion' => Application::VERSION,
            //         'phpVersion' => PHP_VERSION,
        ]);
    }
}
