<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
class StudentCertificateIssuedController extends Controller
{
    public function issued()
    {
        $certificates = Certificate::with([
            'user',
            'course',
            'course.instructor',
        ])->latest()->paginate(20);
        return view('admin.pages.certificates.issued-certificates', [
            'pageTitle' => 'Issued Certificates - C.A.I.T',
            'certificates' => $certificates,
        ]);
    }
}
