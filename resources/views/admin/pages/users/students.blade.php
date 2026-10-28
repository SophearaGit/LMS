@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Students')
@push('stylesheets')
    @include('admin.pages.users.partials.people-styles')
@endpush
@section('content')
    @php
        $filters = [
            'all'      => ['All students',          'ti-school',          'azure'],
            'learning' => ['Enrolled in a course',  'ti-book',            'green'],
            'new'      => ['Joined last 30 days',   'ti-sparkles',        'teal'],
            'applying' => ['Applied to teach',      'ti-hourglass-high',  'yellow'],
        ];
        $sorts = ['newest' => 'Newest first', 'oldest' => 'Oldest first', 'name' => 'Name A–Z', 'enrolments' => 'Most enrolments'];
        $linkFor = fn ($over) => route('admin.users.students', array_filter(array_merge(
            ['filter' => $filter === 'all' ? null : $filter, 'sort' => $sort === 'newest' ? null : $sort, 'search' => $search ?: null],
            is_array($over) ? $over : ['filter' => $over === 'all' ? null : $over])));

        $rowData = function ($u) {
            $hasOwnImage = $u->image && $u->image !== '/default-images/avatar/student_girl.png'
                && is_file(public_path(ltrim($u->image, '/')));
            return [
                'avatar'   => $hasOwnImage ? asset($u->image) : asset('default-images/avatar/both.jpg'),
                'applying' => $u->approval_status === 'pending',
                'isNew'    => $u->created_at && $u->created_at->gte(now()->subDays(30)),
                'courses'  => $u->enrollments_count . ' ' . \Illuminate\Support\Str::plural('course', $u->enrollments_count),
            ];
        };
    @endphp

    <div class="container-xl mt-4 mb-5">
        {{-- Page header --}}
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
            <div>
                <div class="text-secondary text-uppercase fw-semibold small mb-1">People</div>
                <h2 class="page-title mb-1">Students</h2>
                <div class="text-secondary">Everyone learning on CAITD, how many courses they’re in, and who wants to teach.</div>
            </div>
            @include('admin.pages.users.partials.export-menu', [
                'noun' => 'students',
                'excelRoute' => route('admin.users.students.excel'),
                'pdfRoute' => route('admin.users.students.exportPdf'),
                'viewCount' => $students->total(),
                'allCount' => $counts['all'],
                'filterLabel' => $filters[$filter][0],
            ])
        </div>

        @include('admin.pages.users.partials.filter-cards')

        <div class="card">
            {{-- Toolbar --}}
            <div class="card-header flex-wrap gap-3">
                <div>
                    <h3 class="card-title mb-0">{{ $filters[$filter][0] }}</h3>
                    <div class="text-secondary small mt-1">
                        @if ($students->total())
                            Showing {{ $students->firstItem() }}–{{ $students->lastItem() }} of {{ $students->total() }}
                        @else
                            No results
                        @endif
                    </div>
                </div>
                <form action="{{ route('admin.users.students') }}" method="GET"
                    class="ms-md-auto d-flex gap-2 w-100" style="max-width: 480px;" role="search">
                    @if ($filter !== 'all') <input type="hidden" name="filter" value="{{ $filter }}"> @endif
                    <div class="input-icon flex-grow-1">
                        <span class="input-icon-addon"><i class="ti ti-search"></i></span>
                        <input type="search" name="search" value="{{ $search }}" class="form-control"
                            placeholder="Search name or email…" aria-label="Search students" autocomplete="off">
                    </div>
                    <select name="sort" class="form-select w-auto" aria-label="Sort students" onchange="this.form.submit()">
                        @foreach ($sorts as $value => $label)
                            <option value="{{ $value }}" @selected($sort === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            @if ($students->isEmpty())
                <div class="pp-empty">
                    @if ($search !== '')
                        <div class="pp-empty-icon bg-secondary-lt"><i class="ti ti-search-off"></i></div>
                        <h3 class="mb-1">No matches for “{{ $search }}”</h3>
                        <p class="text-secondary mb-3">Try another name or email.</p>
                        <a href="{{ $linkFor(['search' => null]) }}" class="btn btn-outline-secondary">Clear search</a>
                    @else
                        <div class="pp-empty-icon bg-secondary-lt"><i class="ti ti-school"></i></div>
                        <h3 class="mb-1">No students here</h3>
                        <p class="text-secondary mb-0">Nobody matches this filter yet.</p>
                    @endif
                </div>
            @else
                {{-- ───────── Desktop: table ───────── --}}
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-vcenter card-table pp-table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Enrolled in</th>
                                <th>Joined</th>
                                <th>Notes</th>
                                                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                @php extract($rowData($student)); @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="avatar avatar-md rounded-circle" style="background-image: url('{{ $avatar }}')"></span>
                                            <div class="min-w-0">
                                                <div class="pp-name text-truncate">{{ $student->name }}</div>
                                                <span class="text-secondary small pp-email">{{ $student->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($student->enrollments_count)
                                            <span class="pp-num">{{ $student->enrollments_count }}</span>
                                            <span class="text-secondary small">{{ \Illuminate\Support\Str::plural('course', $student->enrollments_count) }}</span>
                                        @else
                                            <span class="text-secondary">Not enrolled yet</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">
                                        @if ($student->created_at)
                                            <div>{{ $student->created_at->format('d M Y') }}</div>
                                            <div class="small text-secondary">{{ $student->created_at->diffForHumans() }}</div>
                                        @else
                                            <span class="text-secondary">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="badge-group">
                                        @if ($applying)
                                            <a href="{{ route('admin.instructor-requests.index') }}" class="badge bg-yellow-lt text-decoration-none">
                                                <i class="ti ti-hourglass-high"></i>Applied to teach
                                            </a>
                                        @endif
                                        @if ($isNew)
                                            <span class="badge bg-teal-lt"><i class="ti ti-sparkles"></i>New</span>
                                        @endif
                                        @unless ($applying || $isNew)
                                            <span class="text-secondary">—</span>
                                        @endunless
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ───────── Mobile / tablet: cards ───────── --}}
                <div class="card-body d-lg-none pp-list-cards">
                    @foreach ($students as $student)
                        @php extract($rowData($student)); @endphp
                        <div class="pp-card">
                            <div class="d-flex align-items-start gap-3">
                                <span class="avatar avatar-md rounded-circle flex-shrink-0" style="background-image: url('{{ $avatar }}')"></span>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="d-flex align-items-start justify-content-between gap-2">
                                        <div class="pp-name">{{ $student->name }}</div>
                                        @if ($isNew) <span class="badge bg-teal-lt flex-shrink-0">New</span> @endif
                                    </div>
                                    <span class="pp-meta pp-email d-block">{{ $student->email }}</span>
                                    @if ($applying)
                                        <a href="{{ route('admin.instructor-requests.index') }}" class="badge bg-yellow-lt mt-2 text-decoration-none">
                                            <i class="ti ti-hourglass-high"></i>Applied to teach
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="pp-stats">
                                <div class="pp-stat">
                                    <div class="label">Enrolled in</div>
                                    <div class="value">{{ $student->enrollments_count ? $courses : 'None yet' }}</div>
                                </div>
                                <div class="pp-stat">
                                    <div class="label">Joined</div>
                                    <div class="value">{{ $student->created_at ? $student->created_at->format('d M Y') : '—' }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($students->hasPages())
                    <div class="card-footer d-flex justify-content-center justify-content-md-end">
                        {{ $students->onEachSide(1)->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
