<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutSuccessController extends Controller
{
    public function index()
    {
        return view('pages.checkout.success');
    }
}
