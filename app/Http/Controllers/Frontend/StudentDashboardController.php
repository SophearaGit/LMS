<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $date = [
            'pageTitle' => 'EdoCore | Student-Dashboard'
        ];
        return view('front.pages.student.index', $date);
    }
}

