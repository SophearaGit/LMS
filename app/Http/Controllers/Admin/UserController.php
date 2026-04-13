<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Admin Users',
            'users' => User::all(),
        ];

        return view('admin.pages.users.index', $data);
    }

    public function instructors()
    {
        $data = [
            'pageTitle' => 'CAITD | Admin Instructors',
            'instructors' => User::where('role', 'instructor')->get(),
        ];

        return view('admin.pages.users.instructors', $data);
    }

    public function exportExcel()
    {
        $instructors = User::where('role', 'instructor')
            ->orderBy('name')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Title
        $sheet->mergeCells('A1:C1');
        $sheet->setCellValue('A1', 'Instructor Report');

        // Info
        $sheet->setCellValue('A2', 'Generated At:');
        $sheet->setCellValue('B2', now());

        $sheet->setCellValue('A3', 'Total Instructors:');
        $sheet->setCellValue('B3', $instructors->count());

        // Table Header
        $sheet->setCellValue('A5', 'Name');
        $sheet->setCellValue('B5', 'Email');
        $sheet->setCellValue('C5', 'Role');

        // Style Header
        $sheet->getStyle('A5:C5')->getFont()->setBold(true);

        // Fill Data
        $row = 6;
        foreach ($instructors as $instructor) {
            $sheet->setCellValue('A' . $row, $instructor->name);
            $sheet->setCellValue('B' . $row, $instructor->email);
            $sheet->setCellValue('C' . $row, ucfirst($instructor->role));
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'C') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fileName = 'instructors.xlsx';

        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }

    public function exportPdf()
    {
        $instructors = User::where('role', 'instructor')->orderBy('name')->get();
        $total = $instructors->count();

        $pdf = Pdf::loadView('admin.pages.users.instructors-pdf', compact('instructors', 'total'));

        return $pdf->download('instructors-report.pdf');
    }

    public function students()
    {
        $data = [
            'pageTitle' => 'CAITD | Admin Students',
            'students' => User::where('role', 'student')->get(),
        ];

        return view('admin.pages.users.students', $data);
    }

    public function exportStudentsExcel()
    {
        $students = User::where('role', 'student')
            ->orderBy('name')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Title
        $sheet->mergeCells('A1:C1');
        $sheet->setCellValue('A1', 'Student Report');

        // Info
        $sheet->setCellValue('A2', 'Generated At:');
        $sheet->setCellValue('B2', now());

        $sheet->setCellValue('A3', 'Total Students:');
        $sheet->setCellValue('B3', $students->count());

        // Table Header
        $sheet->setCellValue('A5', 'Name');
        $sheet->setCellValue('B5', 'Email');
        $sheet->setCellValue('C5', 'Role');

        $sheet->getStyle('A5:C5')->getFont()->setBold(true);

        // Data
        $row = 6;
        foreach ($students as $student) {
            $sheet->setCellValue('A' . $row, $student->name);
            $sheet->setCellValue('B' . $row, $student->email);
            $sheet->setCellValue('C' . $row, ucfirst($student->role));
            $row++;
        }

        foreach (range('A', 'C') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fileName = 'students.xlsx';
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }

    public function exportStudentsPdf()
    {
        $students = User::where('role', 'student')
            ->orderBy('name')
            ->get();

        $total = $students->count();

        $pdf = Pdf::loadView('admin.pages.users.students-pdf', compact('students', 'total'));

        return $pdf->download('students-report.pdf');
    }

}
