<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Homepage'
        ];
        return view('front.pages.index', $data);
    }
}
