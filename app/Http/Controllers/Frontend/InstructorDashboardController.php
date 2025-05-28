<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InstructorDashboardController extends Controller
{

    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Instructor-Dashboard'
        ];
        return view('front.pages.instructor.index', $data);
    }

}
