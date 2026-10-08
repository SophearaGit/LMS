@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin Dashboard')

@php
    $hour = now()->hour;
    $greeting = $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening');
    $currency = config('settings.site_currency_icon');
    $progressTotal = max(array_sum($progress), 1);
    $attentionTotal = collect($attention)->sum('count');

    // "+3 vs last month" style comparison for the KPI cards
    $compare = function (int $now, int $before) {
        $diff = $now - $before;
        if ($diff > 0) return ['class' => 'text-green', 'icon' => 'ti-trending-up', 'text' => "+{$diff} vs last month"];
        if ($diff < 0) return ['class' => 'text-red', 'icon' => 'ti-trending-down', 'text' => "{$diff} vs last month"];
        return ['class' => 'text-secondary', 'icon' => 'ti-minus', 'text' => 'Same as last month'];
    };
    $initials = fn ($name) => collect(explode(' ', trim((string) $name)))->filter()->take(2)->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))->implode('') ?: '?';
@endphp

@push('stylesheets')
    <style>
        .dash-kpi .kpi-value { font-size: 1.85rem; font-weight: 700; line-height: 1.1; font-variant-numeric: tabular-nums; }
        .dash-kpi .kpi-icon { width: 2.5rem; height: 2.5rem; border-radius: .6rem; display: inline-flex; align-items: center; justify-content: center; font-size: 1.35rem; }
        .dash-chart { position: relative; height: 300px; }
        .dash-num { font-variant-numeric: tabular-nums; }
        .dash-attention .list-group-item { display: flex; align-items: center; gap: .75rem; }
        .dash-attention .count-pill { min-width: 2rem; text-align: center; font-weight: 600; }
        .progress-stacked { height: .9rem; border-radius: .5rem; overflow: hidden; display: flex; gap: 2px; background: transparent; }
        .progress-stacked > div { height: 100%; }
        .progress-stacked > div:first-child { border-radius: .5rem 0 0 .5rem; }
        .progress-stacked > div:last-child { border-radius: 0 .5rem .5rem 0; }
        .seg-done { background: #1f5fae; }
        .seg-doing { background: #4f93e3; }
        .seg-new { background: #b9d3f2; }
        [data-bs-theme="dark"] .seg-done { background: #7fb3f0; }
        [data-bs-theme="dark"] .seg-doing { background: #3c82d8; }
        [data-bs-theme="dark"] .seg-new { background: #24476f; }
        .legend-dot { width: .7rem; height: .7rem; border-radius: 50%; display: inline-block; }
        .course-progress { height: .45rem; min-width: 5rem; }
    </style>
@endpush

@section('content')
    {{-- Header --}}
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">{{ now()->format('l, j F Y') }}</div>
                    <h2 class="page-title">{{ $greeting }}{{ $adminName ? ', ' . $adminName : '' }}</h2>
                    <div class="text-secondary mt-1">
                        Here is how teaching and learning are going across CAITD.
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <div class="dropdown">
                            <a href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-download me-1"></i> Reports
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('admin.report.excel') }}" class="dropdown-item">
                                    <i class="ti ti-file-spreadsheet me-2"></i> Course report (Excel)
                                </a>
                                <a href="{{ route('admin.report.pdf') }}" class="dropdown-item">
                                    <i class="ti ti-file-type-pdf me-2"></i> Course report (PDF)
                                </a>
                            </div>
                        </div>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-primary">
                            <i class="ti ti-books me-1"></i> Manage courses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">

                {{-- KPI cards --}}
                @php
                    $kpis = [
                        ['label' => 'Students', 'value' => $students['total'], 'icon' => 'ti-school', 'tone' => 'bg-primary-lt',
                         'sub' => $students['this_month'] . ' joined this month', 'cmp' => $compare($students['this_month'], $students['last_month']),
                         'url' => route('admin.users.students')],
                        ['label' => 'Active learners', 'value' => $activeLearners, 'icon' => 'ti-activity', 'tone' => 'bg-green-lt',
                         'sub' => 'Studied a lesson in the last 30 days', 'cmp' => null, 'url' => null],
                        ['label' => 'Enrolments', 'value' => $enrollments['total'], 'icon' => 'ti-book-2', 'tone' => 'bg-azure-lt',
                         'sub' => $enrollments['this_month'] . ' new this month', 'cmp' => $compare($enrollments['this_month'], $enrollments['last_month']),
                         'url' => null],
                        ['label' => 'Certificates issued', 'value' => $certificates['total'], 'icon' => 'ti-certificate', 'tone' => 'bg-orange-lt',
                         'sub' => $certificates['this_month'] . ' issued this month', 'cmp' => $compare($certificates['this_month'], $certificates['last_month']),
                         'url' => route('admin.certificates.issued')],
                    ];
                @endphp
                @foreach ($kpis as $kpi)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card dash-kpi">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="subheader">{{ $kpi['label'] }}</div>
                                    <span class="kpi-icon {{ $kpi['tone'] }} ms-auto"><i class="ti {{ $kpi['icon'] }}"></i></span>
                                </div>
                                <div class="kpi-value">{{ number_format($kpi['value']) }}</div>
                                <div class="text-secondary small mt-1">{{ $kpi['sub'] }}</div>
                                @if ($kpi['cmp'])
                                    <div class="small mt-1 {{ $kpi['cmp']['class'] }}">
                                        <i class="ti {{ $kpi['cmp']['icon'] }}"></i> {{ $kpi['cmp']['text'] }}
                                    </div>
                                @endif
                                @if ($kpi['url'])
                                    <a href="{{ $kpi['url'] }}" class="stretched-link" aria-label="Open {{ $kpi['label'] }}"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Trend chart --}}
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">Enrolments and certificates</h3>
                                <div class="card-subtitle">Per month, last 12 months</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="dash-chart">
                                <canvas id="learningTrend" role="img"
                                    aria-label="Line chart of enrolments and certificates per month over the last 12 months"></canvas>
                            </div>
                            @if (collect($trend['enrollments'])->sum() + collect($trend['certificates'])->sum() === 0)
                                <div class="text-secondary small mt-2">No enrolments or certificates in the last 12 months yet.</div>
                            @endif
                            <details class="mt-3">
                                <summary class="text-secondary small">Show as table</summary>
                                <div class="table-responsive mt-2">
                                    <table class="table table-sm table-vcenter mb-0">
                                        <thead><tr><th>Month</th><th class="text-end">Enrolments</th><th class="text-end">Certificates</th></tr></thead>
                                        <tbody>
                                            @foreach ($trend['labels'] as $i => $label)
                                                <tr>
                                                    <td>{{ $label }}</td>
                                                    <td class="text-end dash-num">{{ $trend['enrollments'][$i] }}</td>
                                                    <td class="text-end dash-num">{{ $trend['certificates'][$i] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </details>
                        </div>
                    </div>
                </div>

                {{-- Needs attention --}}
                <div class="col-lg-4">
                    <div class="card dash-attention">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">Needs your attention</h3>
                                <div class="card-subtitle">
                                    {{ $attentionTotal > 0 ? $attentionTotal . ' item' . ($attentionTotal === 1 ? '' : 's') . ' waiting for a decision' : 'Nothing waiting, all caught up' }}
                                </div>
                            </div>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach ($attention as $item)
                                <a href="{{ $item['url'] }}" class="list-group-item list-group-item-action">
                                    <span class="avatar avatar-sm {{ $item['count'] > 0 ? 'bg-yellow-lt' : 'bg-secondary-lt' }}">
                                        <i class="ti {{ $item['icon'] }}"></i>
                                    </span>
                                    <span class="flex-fill">{{ $item['label'] }}</span>
                                    @if ($item['count'] > 0)
                                        <span class="badge bg-yellow-lt count-pill dash-num">{{ $item['count'] }}</span>
                                    @else
                                        <span class="text-secondary small"><i class="ti ti-check"></i> None</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Courses at a glance --}}
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">Courses with the most students</h3>
                                <div class="card-subtitle">Average lesson progress and completions per course</div>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('admin.courses.index') }}" class="btn btn-sm">All courses</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th class="text-end">Students</th>
                                        <th>Avg. progress</th>
                                        <th class="text-end">Completed</th>
                                        <th class="text-end">Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($topCourses as $course)
                                        <tr>
                                            <td>
                                                <a href="{{ route('courses.show', $course->slug) }}" target="_blank" class="text-reset fw-medium">
                                                    {{ Str::limit($course->title, 38) }}
                                                </a>
                                                <div class="text-secondary small">{{ optional($course->instructor)->name ?? 'No instructor' }}</div>
                                            </td>
                                            <td class="text-end dash-num">{{ number_format($course->enrollments_count) }}</td>
                                            <td style="min-width: 9rem">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="progress course-progress flex-fill">
                                                        <div class="progress-bar" style="width: {{ $course->avg_progress }}%"
                                                            role="progressbar" aria-valuenow="{{ $course->avg_progress }}" aria-valuemin="0" aria-valuemax="100"
                                                            aria-label="{{ $course->avg_progress }}% average progress"></div>
                                                    </div>
                                                    <span class="small dash-num text-secondary">{{ $course->avg_progress }}%</span>
                                                </div>
                                            </td>
                                            <td class="text-end dash-num">{{ $course->completed_count }}</td>
                                            <td class="text-end dash-num">
                                                @if ($course->reviews_avg_rating)
                                                    <i class="ti ti-star-filled text-yellow"></i> {{ number_format($course->reviews_avg_rating, 1) }}
                                                @else
                                                    <span class="text-secondary">–</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center text-secondary py-4">No approved courses yet.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Learning progress --}}
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">Learning progress</h3>
                                <div class="card-subtitle">All {{ number_format($enrollments['total']) }} enrolments by lessons completed</div>
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                $segments = [
                                    ['key' => 'completed', 'label' => 'Completed every lesson', 'class' => 'seg-done'],
                                    ['key' => 'in_progress', 'label' => 'In progress', 'class' => 'seg-doing'],
                                    ['key' => 'not_started', 'label' => 'Not started yet', 'class' => 'seg-new'],
                                ];
                            @endphp
                            <div class="progress-stacked mb-3" role="img"
                                aria-label="{{ $progress['completed'] }} completed, {{ $progress['in_progress'] }} in progress, {{ $progress['not_started'] }} not started">
                                @foreach ($segments as $seg)
                                    @if ($progress[$seg['key']] > 0)
                                        <div class="{{ $seg['class'] }}" style="width: {{ $progress[$seg['key']] / $progressTotal * 100 }}%"
                                            title="{{ $seg['label'] }}: {{ $progress[$seg['key']] }}"></div>
                                    @endif
                                @endforeach
                            </div>
                            @foreach ($segments as $seg)
                                <div class="d-flex align-items-center py-1">
                                    <span class="legend-dot {{ $seg['class'] }} me-2"></span>
                                    <span class="flex-fill">{{ $seg['label'] }}</span>
                                    <span class="fw-medium dash-num me-2">{{ number_format($progress[$seg['key']]) }}</span>
                                    <span class="text-secondary small dash-num" style="width: 3rem; text-align: right">
                                        {{ round($progress[$seg['key']] / $progressTotal * 100) }}%
                                    </span>
                                </div>
                            @endforeach

                            <div class="hr-text my-3">School at a glance</div>
                            <div class="row g-3 text-center">
                                <div class="col-4">
                                    <div class="h2 mb-0 dash-num">{{ number_format($instructorCount) }}</div>
                                    <div class="text-secondary small">Instructors</div>
                                </div>
                                <div class="col-4">
                                    <div class="h2 mb-0 dash-num">{{ number_format($courseCounts['published']) }}</div>
                                    <div class="text-secondary small">Live courses</div>
                                </div>
                                <div class="col-4">
                                    <div class="h2 mb-0 dash-num">
                                        @if ($rating['count'] > 0)
                                            {{ number_format($rating['average'], 1) }}<i class="ti ti-star-filled text-yellow fs-3 ms-1"></i>
                                        @else
                                            –
                                        @endif
                                    </div>
                                    <div class="text-secondary small">{{ number_format($rating['count']) }} reviews</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Latest enrolments --}}
                <div class="col-md-6 col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest enrolments</h3>
                        </div>
                        <div class="list-group list-group-flush">
                            @forelse ($latestEnrollments as $enrolment)
                                <div class="list-group-item">
                                    <div class="row align-items-center g-3">
                                        <div class="col-auto">
                                            <span class="avatar avatar-sm bg-primary-lt">{{ $initials(optional($enrolment->user)->name) }}</span>
                                        </div>
                                        <div class="col text-truncate">
                                            <div class="text-reset fw-medium text-truncate">{{ optional($enrolment->user)->name ?? 'Deleted user' }}</div>
                                            <div class="text-secondary small text-truncate">{{ optional($enrolment->course)->title ?? 'Removed course' }}</div>
                                        </div>
                                        <div class="col-auto text-secondary small">{{ $enrolment->created_at?->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item text-secondary text-center py-4">No enrolments yet.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Latest certificates --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent certificates</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.certificates.issued') }}" class="btn btn-sm">View all</a>
                            </div>
                        </div>
                        <div class="list-group list-group-flush">
                            @forelse ($latestCertificates as $certificate)
                                <div class="list-group-item">
                                    <div class="row align-items-center g-3">
                                        <div class="col-auto">
                                            <span class="avatar avatar-sm bg-orange-lt"><i class="ti ti-certificate"></i></span>
                                        </div>
                                        <div class="col text-truncate">
                                            <div class="fw-medium text-truncate">{{ optional($certificate->user)->name ?? 'Deleted user' }}</div>
                                            <div class="text-secondary small text-truncate">{{ optional($certificate->course)->title ?? 'Removed course' }}</div>
                                        </div>
                                        <div class="col-auto text-secondary small">
                                            {{ $certificate->issued_at ? \Carbon\Carbon::parse($certificate->issued_at)->format('j M') : '' }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item text-secondary text-center py-4">No certificates issued yet.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Revenue --}}
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Revenue</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm">Orders</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="subheader">This month</div>
                            <div class="h1 mb-1 dash-num">{{ $currency }}{{ number_format($revenue['this_month'], 2) }}</div>
                            @php $revCmp = $revenue['this_month'] <=> $revenue['last_month']; @endphp
                            <div class="small {{ $revCmp > 0 ? 'text-green' : ($revCmp < 0 ? 'text-red' : 'text-secondary') }}">
                                <i class="ti {{ $revCmp > 0 ? 'ti-trending-up' : ($revCmp < 0 ? 'ti-trending-down' : 'ti-minus') }}"></i>
                                Last month: {{ $currency }}{{ number_format($revenue['last_month'], 2) }}
                            </div>
                            <div class="hr my-3"></div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-secondary">This year</span>
                                <span class="fw-medium dash-num">{{ $currency }}{{ number_format($revenue['this_year'], 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary">Paid orders</span>
                                <span class="fw-medium dash-num">{{ number_format($revenue['paid_orders']) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        (function () {
            const canvas = document.getElementById('learningTrend');
            if (!canvas || typeof Chart === 'undefined') return;

            const dark = document.body.getAttribute('data-bs-theme') === 'dark';
            const css = getComputedStyle(document.body);
            const ink = css.getPropertyValue('--tblr-secondary').trim() || (dark ? '#9aa0ac' : '#667382');
            const grid = css.getPropertyValue('--tblr-border-color').trim() || (dark ? '#2b3648' : '#e6e7e9');
            const surface = css.getPropertyValue('--tblr-bg-surface').trim() || (dark ? '#1b2434' : '#ffffff');
            const series = {
                enrol: dark ? '#3987e5' : '#2a78d6',
                cert: dark ? '#d95926' : '#eb6834',
            };

            const line = (label, data, color) => ({
                label, data,
                borderColor: color,
                backgroundColor: color,
                borderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBorderColor: surface,
                pointBorderWidth: 2,
                tension: 0.25,
            });

            new Chart(canvas, {
                type: 'line',
                data: {
                    labels: @json($trend['labels']),
                    datasets: [
                        line('Enrolments', @json($trend['enrollments']), series.enrol),
                        line('Certificates issued', @json($trend['certificates']), series.cert),
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: {
                            position: 'top', align: 'start',
                            labels: { color: ink, usePointStyle: true, pointStyle: 'circle', boxWidth: 8, boxHeight: 8, padding: 16 },
                        },
                        tooltip: { padding: 10, boxPadding: 4, usePointStyle: true },
                    },
                    scales: {
                        x: { grid: { display: false }, border: { color: grid }, ticks: { color: ink, maxRotation: 0, autoSkipPadding: 12 } },
                        y: {
                            beginAtZero: true,
                            grid: { color: grid }, border: { display: false },
                            ticks: { color: ink, precision: 0 },
                            title: { display: true, text: 'Count', color: ink },
                        },
                    },
                },
            });
        })();
    </script>
@endpush
