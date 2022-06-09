<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    function index(){
        return Inertia::render('Product/Products', [
            //         'canLogin' => Route::has('login'),
            //         'canRegister' => Route::has('register'),
            //         'laravelVersion' => Application::VERSION,
            //         'phpVersion' => PHP_VERSION,
        ]);
    }

}
