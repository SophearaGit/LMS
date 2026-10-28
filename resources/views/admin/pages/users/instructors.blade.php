@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Instructors')
@push('stylesheets')
    @include('admin.pages.users.partials.people-styles')
    <style>
        /* Grid view is opt-in on desktop; phones and tablets always get cards. */
        #pp-grid { display: none; }
        @media (min-width: 992px) {
            .pp-mode-grid #pp-list { display: none !important; }
            .pp-mode-grid #pp-grid { display: block; }
        }
        @media (max-width: 991.98px) {
            #pp-grid { display: block; }
        }
    </style>
@endpush
@section('content')
    @php
        $filters = [
            'all'      => ['All instructors', 'ti-chalkboard', 'purple'],
            'active'   => ['Active',          'ti-circle-check', 'green'],
            'disabled' => ['Disabled',        'ti-user-off', 'red'],
        ];
        $sorts = [
            'newest' => 'Newest first', 'oldest' => 'Oldest first', 'name' => 'Name A–Z',
            'courses' => 'Most courses', 'students' => 'Most students',
        ];
        $linkFor = fn ($over) => route('admin.users.instructors', array_filter(array_merge(
            ['filter' => $filter === 'all' ? null : $filter, 'sort' => $sort === 'newest' ? null : $sort, 'search' => $search ?: null],
            is_array($over) ? $over : ['filter' => $over === 'all' ? null : $over])));

        $rowData = function ($u) {
            $hasOwnImage = $u->image && $u->image !== '/default-images/avatar/teacher.jpg'
                && is_file(public_path(ltrim($u->image, '/')));
            return [
                'avatar'     => $hasOwnImage ? asset($u->image) : asset('default-images/avatar/both.jpg'),
                'isDisabled' => $u->account_status === 'disabled',
                'subtitle'   => $u->headline ?: 'Instructor',
            ];
        };
    @endphp

    <div class="container-xl mt-4 mb-5">
        {{-- Page header --}}
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
            <div>
                <div class="text-secondary text-uppercase fw-semibold small mb-1">People</div>
                <h2 class="page-title mb-1">Instructors</h2>
                <div class="text-secondary">Approved teachers, their courses and students. Disable an account to block their access.</div>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.instructor-requests.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-user-exclamation me-1"></i> Instructor requests
                </a>
                @include('admin.pages.users.partials.export-menu', [
                    'noun' => 'instructors',
                    'excelRoute' => route('admin.users.instructors.excel'),
                    'pdfRoute' => route('admin.users.instructors.exportPdf'),
                    'viewCount' => $instructors->total(),
                    'allCount' => $counts['all'],
                    'filterLabel' => $filters[$filter][0],
                ])
            </div>
        </div>

        @include('admin.pages.users.partials.filter-cards')

        <div class="card" id="pp-root">
            {{-- Toolbar --}}
            <div class="card-header flex-wrap gap-3">
                <div>
                    <h3 class="card-title mb-0">{{ $filters[$filter][0] }}</h3>
                    <div class="text-secondary small mt-1">
                        @if ($instructors->total())
                            Showing {{ $instructors->firstItem() }}–{{ $instructors->lastItem() }} of {{ $instructors->total() }}
                        @else
                            No results
                        @endif
                    </div>
                </div>
                <div class="ms-md-auto d-flex flex-wrap gap-2 w-100" style="max-width: 560px;">
                    <form action="{{ route('admin.users.instructors') }}" method="GET" class="d-flex gap-2 flex-grow-1" role="search">
                        @if ($filter !== 'all') <input type="hidden" name="filter" value="{{ $filter }}"> @endif
                        <div class="input-icon flex-grow-1">
                            <span class="input-icon-addon"><i class="ti ti-search"></i></span>
                            <input type="search" name="search" value="{{ $search }}" class="form-control"
                                placeholder="Search name or email…" aria-label="Search instructors" autocomplete="off">
                        </div>
                        <select name="sort" class="form-select w-auto" aria-label="Sort instructors" onchange="this.form.submit()">
                            @foreach ($sorts as $value => $label)
                                <option value="{{ $value }}" @selected($sort === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </form>
                    <div class="btn-group pp-view-toggle d-none d-lg-inline-flex" role="group" aria-label="Layout">
                        <button type="button" class="btn btn-outline-secondary active" data-pp-view="list" title="List view" aria-label="List view">
                            <i class="ti ti-list"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-pp-view="grid" title="Grid view" aria-label="Grid view">
                            <i class="ti ti-layout-grid"></i>
                        </button>
                    </div>
                </div>
            </div>

            @if ($instructors->isEmpty())
                <div class="pp-empty">
                    @if ($search !== '')
                        <div class="pp-empty-icon bg-secondary-lt"><i class="ti ti-search-off"></i></div>
                        <h3 class="mb-1">No matches for “{{ $search }}”</h3>
                        <p class="text-secondary mb-3">Try another name or email.</p>
                        <a href="{{ $linkFor(['search' => null]) }}" class="btn btn-outline-secondary">Clear search</a>
                    @else
                        <div class="pp-empty-icon bg-secondary-lt"><i class="ti ti-chalkboard"></i></div>
                        <h3 class="mb-1">{{ $filter === 'disabled' ? 'No disabled instructors' : 'No instructors yet' }}</h3>
                        <p class="text-secondary mb-3">Approved instructor requests will appear here.</p>
                        <a href="{{ route('admin.instructor-requests.index') }}" class="btn btn-outline-secondary">Review requests</a>
                    @endif
                </div>
            @else
                {{-- ───────── Desktop list ───────── --}}
                <div class="table-responsive d-none d-lg-block" id="pp-list">
                    <table class="table table-vcenter card-table pp-table">
                        <thead>
                            <tr>
                                <th>Instructor</th>
                                <th>Courses</th>
                                <th>Students</th>
                                <th>Joined</th>
                                <th>Account</th>
                                                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instructors as $instructor)
                                @php extract($rowData($instructor)); @endphp
                                <tr class="{{ $isDisabled ? 'is-disabled' : '' }}">
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="avatar avatar-md rounded-circle" style="background-image: url('{{ $avatar }}')"></span>
                                            <div class="min-w-0">
                                                <div class="pp-name text-truncate">{{ $instructor->name }}</div>
                                                <div class="text-secondary small text-truncate" style="max-width: 320px;">
                                                    <span class="">{{ $instructor->email }}</span>
                                                    @if ($instructor->headline) · {{ $instructor->headline }} @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="pp-num">{{ $instructor->live_courses_count }}</span>
                                        <span class="text-secondary small">live</span>
                                        @if ($instructor->courses_count > $instructor->live_courses_count)
                                            <div class="small text-secondary">{{ $instructor->courses_count - $instructor->live_courses_count }} pending / draft</div>
                                        @endif
                                    </td>
                                    <td><span class="pp-num">{{ $instructor->students_count }}</span>
                                        <span class="text-secondary small">{{ \Illuminate\Support\Str::plural('enrolment', $instructor->students_count) }}</span></td>
                                    <td class="text-nowrap">
                                        @if ($instructor->created_at)
                                            <div>{{ $instructor->created_at->format('d M Y') }}</div>
                                            <div class="small text-secondary">{{ $instructor->created_at->diffForHumans() }}</div>
                                        @else
                                            <span class="text-secondary">—</span>
                                        @endif
                                    </td>
                                    <td class="pp-keep">
                                        @include('admin.pages.users.partials.account-switch', ['user' => $instructor])
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ───────── Grid (desktop option) / cards (mobile) ───────── --}}
                <div class="card-body" id="pp-grid">
                    <div class="row g-3">
                        @foreach ($instructors as $instructor)
                            @php extract($rowData($instructor)); @endphp
                            <div class="col-12 col-md-6 col-xl-4">
                                <div class="pp-card {{ $isDisabled ? 'is-disabled' : '' }}">
                                    <div class="d-flex align-items-start gap-3 pp-fade">
                                        <span class="avatar avatar-lg rounded-circle flex-shrink-0" style="background-image: url('{{ $avatar }}')"></span>
                                        <div class="flex-grow-1 min-w-0">
                                            <div class="pp-name text-truncate">{{ $instructor->name }}</div>
                                            <div class="pp-meta text-truncate">{{ $subtitle }}</div>
                                            <span class="pp-meta pp-email d-block">{{ $instructor->email }}</span>
                                        </div>
                                    </div>
                                    <div class="pp-stats pp-fade" style="--pp-cols: 3;">
                                        <div class="pp-stat">
                                            <div class="label">Live</div>
                                            <div class="value">{{ $instructor->live_courses_count }}</div>
                                        </div>
                                        <div class="pp-stat">
                                            <div class="label">Courses</div>
                                            <div class="value">{{ $instructor->courses_count }}</div>
                                        </div>
                                        <div class="pp-stat">
                                            <div class="label">Students</div>
                                            <div class="value">{{ $instructor->students_count }}</div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3 gap-2">
                                        @include('admin.pages.users.partials.account-switch', ['user' => $instructor])
                                        <span class="pp-meta text-nowrap">
                                            <i class="ti ti-calendar"></i>
                                            {{ $instructor->created_at ? $instructor->created_at->format('d M Y') : '—' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if ($instructors->hasPages())
                    <div class="card-footer d-flex justify-content-center justify-content-md-end">
                        {{ $instructors->onEachSide(1)->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>

    {{-- Confirm before disabling an instructor --}}
    <div class="modal modal-blur fade" id="pp-disable-confirm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <i class="ti ti-user-off text-danger mb-2" style="font-size: 3rem;"></i>
                    <h3 data-pp-title>Disable this account?</h3>
                    <div class="text-secondary">They won’t be able to use the instructor dashboard or manage courses until you enable the account again.</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row g-2">
                            <div class="col"><button type="button" class="btn w-100" data-bs-dismiss="modal">Cancel</button></div>
                            <div class="col"><button type="button" class="btn btn-danger w-100" data-pp-confirm>Disable</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        (function () {
            // ── List / grid preference (desktop only) ──
            var root = document.getElementById('pp-root');
            var KEY = 'instructors_view_pref';
            function setView(mode) {
                if (!root) return;
                root.classList.toggle('pp-mode-grid', mode === 'grid');
                document.querySelectorAll('[data-pp-view]').forEach(function (b) {
                    b.classList.toggle('active', b.getAttribute('data-pp-view') === mode);
                });
                try { localStorage.setItem(KEY, mode); } catch (e) {}
            }
            document.querySelectorAll('[data-pp-view]').forEach(function (b) {
                b.addEventListener('click', function () { setView(b.getAttribute('data-pp-view')); });
            });
            try { if (localStorage.getItem(KEY) === 'grid') setView('grid'); } catch (e) {}

            // ── Account switch: enabling is instant, disabling asks first ──
            var modalEl = document.getElementById('pp-disable-confirm');
            var pendingForm = null, pendingInput = null;
            document.querySelectorAll('[data-pp-switch]').forEach(function (input) {
                input.addEventListener('change', function () {
                    var form = input.closest('form');
                    if (input.checked) { lock(form); form.submit(); return; }
                    input.checked = true; // stay on until confirmed
                    pendingForm = form; pendingInput = input;
                    modalEl.querySelector('[data-pp-title]').textContent = 'Disable ' + input.getAttribute('data-name') + '?';
                    bootstrap.Modal.getOrCreateInstance(modalEl).show();
                });
            });
            modalEl.querySelector('[data-pp-confirm]').addEventListener('click', function () {
                if (!pendingForm) return;
                this.disabled = true;
                this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Disabling…';
                pendingInput.checked = false;
                lock(pendingForm);
                pendingForm.submit();
            });
            function lock(form) { form.querySelectorAll('input[type=checkbox]').forEach(function (i) { i.disabled = true; }); }
        })();
    </script>
@endpush
