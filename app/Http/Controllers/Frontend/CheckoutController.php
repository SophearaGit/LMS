<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Checkout',
        ];
        return view('front.pages.checkout', $data);
    }
}
