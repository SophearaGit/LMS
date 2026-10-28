<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $counts = [
            'all'        => User::count(),
            'student'    => User::where('role', 'student')->count(),
            'instructor' => User::where('role', 'instructor')->count(),
            'disabled'   => User::where('account_status', 'disabled')->count(),
        ];

        $filter = $request->input('filter', 'all');
        if (! array_key_exists($filter, $counts)) {
            $filter = 'all';
        }
        $sort = $request->input('sort', 'newest');
        if (! in_array($sort, ['newest', 'oldest', 'name'], true)) {
            $sort = 'newest';
        }
        $search = trim((string) $request->input('search', ''));

        $users = User::query()
            ->withCount(['courses', 'enrollments'])
            ->when(in_array($filter, ['student', 'instructor'], true), fn ($q) => $q->where('role', $filter))
            ->when($filter === 'disabled', fn ($q) => $q->where('account_status', 'disabled'))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($sort === 'newest', fn ($q) => $q->latest())
            ->when($sort === 'oldest', fn ($q) => $q->oldest())
            ->when($sort === 'name', fn ($q) => $q->orderBy('name'))
            ->paginate(15)
            ->withQueryString();

        return view('admin.pages.users.index', [
            'pageTitle' => 'CAITD | Admin Users',
            'users'     => $users,
            'counts'    => $counts,
            'filter'    => $filter,
            'sort'      => $sort,
            'search'    => $search,
        ]);
    }

    public function instructors(Request $request)
    {
        $base = fn () => User::where('role', 'instructor');
        $counts = [
            'all'      => $base()->count(),
            'active'   => $base()->where('account_status', '!=', 'disabled')->count(),
            'disabled' => $base()->where('account_status', 'disabled')->count(),
        ];

        [$filter, $sort, $search] = $this->listOptions($request, array_keys($counts), ['newest', 'oldest', 'name', 'courses', 'students']);

        $instructors = $this->instructorsQuery($filter, $search)
            ->tap(fn ($q) => $this->applySort($q, $sort, ['courses' => 'courses_count', 'students' => 'students_count']))
            ->paginate(12)
            ->withQueryString();

        return view('admin.pages.users.instructors', [
            'pageTitle'   => 'CAITD | Admin Instructors',
            'instructors' => $instructors,
            'counts'      => $counts,
            'filter'      => $filter,
            'sort'        => $sort,
            'search'      => $search,
        ]);
    }

    /** Reads and sanitises the filter / sort / search query parameters. */
    private function listOptions(Request $request, array $filters, array $sorts): array
    {
        $filter = $request->input('filter', 'all');
        $sort = $request->input('sort', 'newest');

        return [
            in_array($filter, $filters, true) ? $filter : 'all',
            in_array($sort, $sorts, true) ? $sort : 'newest',
            trim((string) $request->input('search', '')),
        ];
    }

    private function applySearch($query, string $search): void
    {
        if ($search === '') {
            return;
        }
        $query->where(function ($sub) use ($search) {
            $sub->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        });
    }

    /** $countSorts maps a sort key to a withCount column, sorted highest first. */
    private function applySort($query, string $sort, array $countSorts = []): void
    {
        match (true) {
            $sort === 'oldest'                  => $query->oldest(),
            $sort === 'name'                    => $query->orderBy('name'),
            isset($countSorts[$sort])           => $query->orderByDesc($countSorts[$sort])->orderBy('name'),
            default                             => $query->latest(),
        };
    }


    public function students(Request $request)
    {
        $base = fn () => User::where('role', 'student');
        $counts = [
            'all'      => $base()->count(),
            'learning' => $base()->has('enrollments')->count(),
            'new'      => $base()->where('created_at', '>=', now()->subDays(30))->count(),
            'applying' => $base()->where('approval_status', 'pending')->count(),
        ];

        [$filter, $sort, $search] = $this->listOptions($request, array_keys($counts), ['newest', 'oldest', 'name', 'enrolments']);

        $students = $this->studentsQuery($filter, $search)
            ->tap(fn ($q) => $this->applySort($q, $sort, ['enrolments' => 'enrollments_count']))
            ->paginate(15)
            ->withQueryString();

        return view('admin.pages.users.students', [
            'pageTitle' => 'CAITD | Admin Students',
            'students'  => $students,
            'counts'    => $counts,
            'filter'    => $filter,
            'sort'      => $sort,
            'search'    => $search,
        ]);
    }


    /* ───────────────────────── Shared list queries ───────────────────────── */

    private function instructorsQuery(string $filter, string $search)
    {
        return User::where('role', 'instructor')
            ->withCount([
                'courses',
                'courses as live_courses_count' => fn ($q) => $q->where('is_approved', 'approved'),
                'students',
            ])
            ->when($filter === 'active', fn ($q) => $q->where('account_status', '!=', 'disabled'))
            ->when($filter === 'disabled', fn ($q) => $q->where('account_status', 'disabled'))
            ->tap(fn ($q) => $this->applySearch($q, $search));
    }

    private function studentsQuery(string $filter, string $search)
    {
        return User::where('role', 'student')
            ->withCount('enrollments')
            ->when($filter === 'learning', fn ($q) => $q->has('enrollments'))
            ->when($filter === 'new', fn ($q) => $q->where('created_at', '>=', now()->subDays(30)))
            ->when($filter === 'applying', fn ($q) => $q->where('approval_status', 'pending'))
            ->tap(fn ($q) => $this->applySearch($q, $search));
    }

    /* ───────────────────────── Exports ─────────────────────────
     * Each export honours ?filter= and ?search= so the admin can export
     * exactly what they are looking at; without them it exports everyone.
     */

    private const INSTRUCTOR_FILTERS = ['all' => 'All instructors', 'active' => 'Active', 'disabled' => 'Disabled'];
    private const STUDENT_FILTERS = [
        'all' => 'All students', 'learning' => 'Enrolled in a course',
        'new' => 'Joined last 30 days', 'applying' => 'Applied to teach',
    ];

    private function instructorExport(Request $request): array
    {
        [$filter, , $search] = $this->listOptions($request, array_keys(self::INSTRUCTOR_FILTERS), ['newest']);
        $people = $this->instructorsQuery($filter, $search)->orderBy('name')->get();

        $rows = $people->values()->map(fn ($u, $i) => [
            $i + 1,
            $u->name,
            $u->email,
            $u->headline ?: '—',
            $u->account_status === 'disabled' ? 'Disabled' : 'Active',
            (int) $u->live_courses_count,
            (int) $u->courses_count,
            (int) $u->students_count,
            optional($u->created_at)->format('Y-m-d') ?? '—',
        ])->all();

        $disabled = $people->where('account_status', 'disabled')->count();

        return [
            'title'     => 'Instructors',
            'scope'     => $this->scopeLabel(self::INSTRUCTOR_FILTERS[$filter], $search),
            'summary'   => [
                'Instructors'  => $people->count(),
                'Active'       => $people->count() - $disabled,
                'Disabled'     => $disabled,
                'Live courses' => (int) $people->sum('live_courses_count'),
                'Enrolments'   => (int) $people->sum('students_count'),
            ],
            'headers'   => ['#', 'Name', 'Email', 'Headline', 'Status', 'Live courses', 'All courses', 'Enrolments', 'Joined'],
            'numeric'   => [1, 6, 7, 8],
            'rows'      => $rows,
            'file'      => $this->exportFileName('instructors', $filter, $search),
            'landscape' => true,
        ];
    }

    private function studentExport(Request $request): array
    {
        [$filter, , $search] = $this->listOptions($request, array_keys(self::STUDENT_FILTERS), ['newest']);
        $people = $this->studentsQuery($filter, $search)->orderBy('name')->get();

        $rows = $people->values()->map(fn ($u, $i) => [
            $i + 1,
            $u->name,
            $u->email,
            (int) $u->enrollments_count,
            $u->approval_status === 'pending' ? 'Yes' : '—',
            optional($u->created_at)->format('Y-m-d') ?? '—',
        ])->all();

        return [
            'title'     => 'Students',
            'scope'     => $this->scopeLabel(self::STUDENT_FILTERS[$filter], $search),
            'summary'   => [
                'Students'          => $people->count(),
                'Enrolled'          => $people->where('enrollments_count', '>', 0)->count(),
                'Course enrolments' => (int) $people->sum('enrollments_count'),
                'Applied to teach'  => $people->where('approval_status', 'pending')->count(),
            ],
            'headers'   => ['#', 'Name', 'Email', 'Courses enrolled', 'Applied to teach', 'Joined'],
            'numeric'   => [1, 4],
            'rows'      => $rows,
            'file'      => $this->exportFileName('students', $filter, $search),
            'landscape' => false,
        ];
    }

    public function exportExcel(Request $request)
    {
        return $this->excelDownload($this->instructorExport($request));
    }

    public function exportPdf(Request $request)
    {
        return $this->pdfDownload($this->instructorExport($request));
    }

    public function exportStudentsExcel(Request $request)
    {
        return $this->excelDownload($this->studentExport($request));
    }

    public function exportStudentsPdf(Request $request)
    {
        return $this->pdfDownload($this->studentExport($request));
    }

    private function scopeLabel(string $filterLabel, string $search): string
    {
        return $search === '' ? $filterLabel : $filterLabel . ' · matching “' . $search . '”';
    }

    private function exportFileName(string $what, string $filter, string $search): string
    {
        return collect(['caitd', $what, $filter !== 'all' ? $filter : null, $search !== '' ? 'search' : null, now()->format('Y-m-d')])
            ->filter()->implode('-');
    }

    private function excelDownload(array $x)
    {
        $site = config('settings.site_name') ?: 'CAITD';
        $cols = count($x['headers']);
        $last = Coordinate::stringFromColumnIndex($cols);
        $headerRow = 5;
        $firstData = $headerRow + 1;
        $lastRow = $headerRow + max(1, count($x['rows']));

        $book = new Spreadsheet();
        $book->getProperties()->setCreator($site)->setTitle("{$site} — {$x['title']}");
        $sheet = $book->getActiveSheet();
        $sheet->setTitle(Str::limit($x['title'], 31, ''));

        // Title, context line and summary
        $sheet->setCellValue('A1', "{$x['title']} report");
        $sheet->mergeCells("A1:{$last}1");
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16)->getColor()->setRGB('1F2937');
        $sheet->getRowDimension(1)->setRowHeight(26);

        $sheet->setCellValue('A2', "{$site} · {$x['scope']} · Generated " . now()->format('d M Y, H:i'));
        $sheet->mergeCells("A2:{$last}2");
        $sheet->getStyle('A2')->getFont()->setItalic(true)->getColor()->setRGB('6B7280');

        $sheet->setCellValue('A3', collect($x['summary'])->map(fn ($v, $k) => "{$k}: {$v}")->implode('     '));
        $sheet->mergeCells("A3:{$last}3");
        $sheet->getStyle('A3')->getFont()->setBold(true)->getColor()->setRGB('1F5FAE');

        // Header row
        $sheet->fromArray($x['headers'], null, "A{$headerRow}");
        $sheet->getStyle("A{$headerRow}:{$last}{$headerRow}")->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1F5FAE']],
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension($headerRow)->setRowHeight(22);

        // Data rows (zebra striped, light borders)
        if ($x['rows']) {
            $sheet->fromArray($x['rows'], null, "A{$firstData}", true);
            for ($r = $firstData + 1; $r <= $lastRow; $r += 2) {
                $sheet->getStyle("A{$r}:{$last}{$r}")->getFill()
                    ->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F5F8FC');
            }
        } else {
            $sheet->setCellValue("A{$firstData}", 'No records match this export.');
            $sheet->mergeCells("A{$firstData}:{$last}{$firstData}");
        }
        $sheet->getStyle("A{$firstData}:{$last}{$lastRow}")->applyFromArray([
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'E5E7EB']]],
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
        ]);
        foreach ($x['numeric'] as $c) {
            $L = Coordinate::stringFromColumnIndex($c);
            $sheet->getStyle("{$L}{$headerRow}:{$L}{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Usability: frozen header, filter buttons on every column, readable widths
        $sheet->freezePane("A{$firstData}");
        if ($x['rows']) {
            $sheet->setAutoFilter("A{$headerRow}:{$last}{$lastRow}");
        }
        for ($c = 2; $c <= $cols; $c++) {
            $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($c))->setAutoSize(true);
        }
        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getPageSetup()
            ->setOrientation($x['landscape'] ? 'landscape' : 'portrait')
            ->setFitToWidth(1)->setFitToHeight(0);
        $sheet->setSelectedCell('A1');

        $writer = new Xlsx($book);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $x['file'] . '.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    private function pdfDownload(array $x)
    {
        $x['site'] = config('settings.site_name') ?: 'CAITD';

        return Pdf::loadView('admin.pages.users.people-pdf', $x)
            ->setPaper('a4', $x['landscape'] ? 'landscape' : 'portrait')
            ->download($x['file'] . '.pdf');
    }
}
