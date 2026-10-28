@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Users')
@push('stylesheets')
    <style>
        @media (min-width: 1400px) {
            .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl { max-width: 100%; }
        }
        .min-w-0 { min-width: 0; }

        /* Badges: icon and text centred on one line, same spacing everywhere */
        .container-xl .badge {
            display: inline-flex; align-items: center; gap: .3rem; vertical-align: middle;
            line-height: 1; padding: .35rem .55rem; font-weight: 600;
        }
        .container-xl .badge > .ti { font-size: 1.05em; line-height: 1; margin: 0 !important; display: block; }
        .container-xl .badge-group { display: inline-flex; flex-wrap: wrap; align-items: center; gap: .35rem; }

        /* ── Filter cards ── */
        .ul-filter {
            display: block; height: 100%; color: inherit; text-decoration: none;
            border: 1px solid var(--tblr-border-color); border-radius: var(--tblr-border-radius-lg, 8px);
            background: var(--tblr-bg-surface); padding: 1rem 1.1rem; position: relative; overflow: hidden;
            transition: border-color .15s, transform .15s;
        }
        .ul-filter:hover { color: inherit; text-decoration: none; border-color: var(--ul-accent); transform: translateY(-1px); }
        .ul-filter.is-active { border-color: var(--ul-accent); box-shadow: 0 0 0 1px var(--ul-accent) inset; }
        .ul-filter.is-active::before { content: ""; position: absolute; inset: 0 0 auto 0; height: 3px; background: var(--ul-accent); }
        .ul-filter-icon {
            width: 2.5rem; height: 2.5rem; border-radius: 10px; display: inline-flex; align-items: center;
            justify-content: center; font-size: 1.35rem; flex-shrink: 0;
        }
        .ul-filter-count { font-size: 1.6rem; font-weight: 700; line-height: 1.1; font-variant-numeric: tabular-nums; }
        .ul-filter-label { color: var(--tblr-secondary); font-size: .85rem; }
        .ul-accent-all        { --ul-accent: var(--tblr-primary); }
        .ul-accent-student    { --ul-accent: var(--tblr-azure); }
        .ul-accent-instructor { --ul-accent: var(--tblr-purple); }
        .ul-accent-disabled   { --ul-accent: var(--tblr-red); }

        /* ── Table ── */
        .ul-table td { padding-top: .85rem; padding-bottom: .85rem; }
        .ul-table tbody tr:hover { background: var(--tblr-bg-surface-secondary, rgba(0,0,0,.02)); }
        .ul-table tr.is-disabled td:not(:last-child) { opacity: .55; }
        .ul-name { font-weight: 600; }
        .ul-email { word-break: break-all; }
        .ul-status-dot { width: .5rem; height: .5rem; border-radius: 50%; display: inline-block; margin-right: .4rem; }

        /* ── Mobile cards ── */
        .ul-card { border: 1px solid var(--tblr-border-color); border-radius: 10px; padding: 1rem; background: var(--tblr-bg-surface); }
        .ul-card + .ul-card { margin-top: .75rem; }
        .ul-card.is-disabled { background: var(--tblr-bg-surface-secondary, rgba(0,0,0,.02)); }
        .ul-meta { font-size: .85rem; color: var(--tblr-secondary); }
        .ul-card-stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: .5rem; margin-top: .85rem; }
        .ul-card-stat { border: 1px solid var(--tblr-border-color); border-radius: 8px; padding: .5rem .65rem; }
        .ul-card-stat .label { font-size: .72rem; text-transform: uppercase; letter-spacing: .03em; color: var(--tblr-secondary); }
        .ul-card-stat .value { font-weight: 600; }

        /* ── Empty state ── */
        .ul-empty { padding: 3.5rem 1rem; text-align: center; }
        .ul-empty-icon {
            width: 4rem; height: 4rem; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;
            font-size: 2rem; margin-bottom: 1rem;
        }
    </style>
@endpush
@section('content')
    @php
        $filters = [
            'all'        => ['label' => 'All users',          'icon' => 'ti-users',        'tone' => 'primary'],
            'student'    => ['label' => 'Students',           'icon' => 'ti-school',       'tone' => 'azure'],
            'instructor' => ['label' => 'Instructors',        'icon' => 'ti-chalkboard',   'tone' => 'purple'],
            'disabled'   => ['label' => 'Disabled accounts',  'icon' => 'ti-user-off',     'tone' => 'red'],
        ];
        $sorts = ['newest' => 'Newest first', 'oldest' => 'Oldest first', 'name' => 'Name A–Z'];
        $roles = [
            'instructor' => ['Instructor', 'bg-purple-lt', 'ti-chalkboard'],
            'student'    => ['Student',    'bg-azure-lt',  'ti-school'],
        ];
        $defaultAvatars = ['/default-images/avatar/teacher.jpg', '/default-images/avatar/student_girl.png'];

        // Per-row values shared by the desktop table and the mobile cards.
        $rowData = function ($user) use ($roles, $defaultAvatars) {
            $hasOwnImage = $user->image && ! in_array($user->image, $defaultAvatars, true)
                && is_file(public_path(ltrim($user->image, '/')));
            $isInstructor = $user->role === 'instructor';
            return [
                'avatar'     => $hasOwnImage ? asset($user->image) : asset('default-images/avatar/both.jpg'),
                'role'       => $roles[$user->role] ?? [ucfirst((string) $user->role), 'bg-secondary-lt', 'ti-user'],
                'isDisabled' => $user->account_status === 'disabled',
                'applying'   => ! $isInstructor && $user->approval_status === 'pending',
                'activity'   => $isInstructor
                    ? $user->courses_count . ' ' . \Illuminate\Support\Str::plural('course', $user->courses_count)
                    : $user->enrollments_count . ' ' . \Illuminate\Support\Str::plural('enrolment', $user->enrollments_count),
                'detailUrl'  => $isInstructor ? route('admin.users.instructors') : route('admin.users.students'),
            ];
        };
        $query = fn (array $over) => route('admin.users.index', array_filter(array_merge(
            ['filter' => $filter, 'sort' => $sort === 'newest' ? null : $sort, 'search' => $search ?: null], $over)));
    @endphp

    <div class="container-xl mt-4 mb-5">
        {{-- Page header --}}
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
            <div>
                <div class="text-secondary text-uppercase fw-semibold small mb-1">People</div>
                <h2 class="page-title mb-1">Users</h2>
                <div class="text-secondary">Everyone with an account on CAITD — students and instructors.</div>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.users.students') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-school me-1"></i> Students
                </a>
                <a href="{{ route('admin.users.instructors') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-chalkboard me-1"></i> Instructors
                </a>
            </div>
        </div>

        {{-- Filter cards --}}
        <div class="row g-3 mb-4">
            @foreach ($filters as $key => $f)
                <div class="col-6 col-lg-3">
                    <a href="{{ $query(['filter' => $key === 'all' ? null : $key]) }}"
                        class="ul-filter ul-accent-{{ $key }} {{ $filter === $key ? 'is-active' : '' }}"
                        @if ($filter === $key) aria-current="page" @endif>
                        <div class="d-flex align-items-center gap-3">
                            <span class="ul-filter-icon bg-{{ $f['tone'] }}-lt"><i class="ti {{ $f['icon'] }}"></i></span>
                            <div class="min-w-0">
                                <div class="ul-filter-count">{{ $counts[$key] }}</div>
                                <div class="ul-filter-label text-truncate">{{ $f['label'] }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="card">
            {{-- Toolbar --}}
            <div class="card-header flex-wrap gap-3">
                <div>
                    <h3 class="card-title mb-0">{{ $filters[$filter]['label'] }}</h3>
                    <div class="text-secondary small mt-1">
                        @if ($users->total())
                            Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }}
                        @else
                            No results
                        @endif
                    </div>
                </div>
                <form action="{{ route('admin.users.index') }}" method="GET"
                    class="ms-md-auto d-flex gap-2 w-100" style="max-width: 480px;" role="search">
                    @if ($filter !== 'all') <input type="hidden" name="filter" value="{{ $filter }}"> @endif
                    <div class="input-icon flex-grow-1">
                        <span class="input-icon-addon"><i class="ti ti-search"></i></span>
                        <input type="search" name="search" value="{{ $search }}" class="form-control"
                            placeholder="Search name or email…" aria-label="Search users" autocomplete="off">
                    </div>
                    <select name="sort" class="form-select w-auto" aria-label="Sort users" onchange="this.form.submit()">
                        @foreach ($sorts as $value => $label)
                            <option value="{{ $value }}" @selected($sort === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            @if ($users->isEmpty())
                <div class="ul-empty">
                    @if ($search !== '')
                        <div class="ul-empty-icon bg-secondary-lt"><i class="ti ti-search-off"></i></div>
                        <h3 class="mb-1">No matches for “{{ $search }}”</h3>
                        <p class="text-secondary mb-3">Try another name or email.</p>
                        <a href="{{ $query(['search' => null]) }}" class="btn btn-outline-secondary">Clear search</a>
                    @else
                        <div class="ul-empty-icon bg-secondary-lt"><i class="ti ti-users"></i></div>
                        <h3 class="mb-1">No users here yet</h3>
                        <p class="text-secondary mb-0">
                            {{ $filter === 'disabled' ? 'No accounts are disabled.' : 'Nobody matches this filter.' }}
                        </p>
                    @endif
                </div>
            @else
                {{-- ───────── Desktop: table ───────── --}}
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-vcenter card-table ul-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Activity</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @php extract($rowData($user)); @endphp
                                <tr class="{{ $isDisabled ? 'is-disabled' : '' }}">
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="avatar avatar-md rounded-circle"
                                                style="background-image: url('{{ $avatar }}')"></span>
                                            <div class="min-w-0">
                                                <div class="ul-name text-truncate">{{ $user->name }}</div>
                                                <span class="text-secondary small ul-email">{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="badge-group">
                                            <span class="badge {{ $role[1] }}"><i class="ti {{ $role[2] }}"></i>{{ $role[0] }}</span>
                                            @if ($applying)
                                                <a href="{{ route('admin.instructor-requests.index') }}"
                                                    class="badge bg-yellow-lt text-decoration-none" title="Waiting in Instructor Requests">
                                                    <i class="ti ti-hourglass-high"></i>Applied to teach
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-secondary">{{ $activity }}</td>
                                    <td>
                                        @if ($isDisabled)
                                            <span class="text-red"><span class="ul-status-dot bg-red"></span>Disabled</span>
                                        @else
                                            <span><span class="ul-status-dot bg-green"></span>Active</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">
                                        @if ($user->created_at)
                                            <div>{{ $user->created_at->format('d M Y') }}</div>
                                            <div class="small text-secondary">{{ $user->created_at->diffForHumans() }}</div>
                                        @else
                                            <span class="text-secondary">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-ghost-secondary btn-icon btn-sm" data-bs-toggle="dropdown"
                                                aria-expanded="false" aria-label="Actions for {{ $user->name }}">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ $detailUrl }}">
                                                    <i class="ti ti-external-link me-2"></i> Open in {{ $user->role === 'instructor' ? 'Instructors' : 'Students' }}
                                                </a>
                                                @if ($applying)
                                                    <a class="dropdown-item" href="{{ route('admin.instructor-requests.index') }}">
                                                        <i class="ti ti-user-check me-2"></i> Review teaching request
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ───────── Mobile / tablet: cards ───────── --}}
                <div class="card-body d-lg-none">
                    @foreach ($users as $user)
                        @php extract($rowData($user)); @endphp
                        <div class="ul-card {{ $isDisabled ? 'is-disabled' : '' }}">
                            <div class="d-flex align-items-start gap-3">
                                <span class="avatar avatar-md rounded-circle flex-shrink-0"
                                    style="background-image: url('{{ $avatar }}')"></span>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="d-flex align-items-start justify-content-between gap-2">
                                        <div class="ul-name">{{ $user->name }}</div>
                                        <span class="badge {{ $role[1] }} flex-shrink-0">{{ $role[0] }}</span>
                                    </div>
                                    <span class="ul-meta ul-email d-block">{{ $user->email }}</span>
                                    @if ($applying)
                                        <a href="{{ route('admin.instructor-requests.index') }}"
                                            class="badge bg-yellow-lt mt-2 text-decoration-none">
                                            <i class="ti ti-hourglass-high"></i>Applied to teach
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="ul-card-stats">
                                <div class="ul-card-stat">
                                    <div class="label">Status</div>
                                    <div class="value {{ $isDisabled ? 'text-red' : '' }}">
                                        <span class="ul-status-dot {{ $isDisabled ? 'bg-red' : 'bg-green' }}"></span>{{ $isDisabled ? 'Disabled' : 'Active' }}
                                    </div>
                                </div>
                                <div class="ul-card-stat">
                                    <div class="label">Activity</div>
                                    <div class="value">{{ $activity }}</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-3 gap-2">
                                <span class="ul-meta">
                                    <i class="ti ti-calendar"></i>
                                    Joined {{ $user->created_at ? $user->created_at->format('d M Y') : '—' }}
                                </span>
                                <a href="{{ $detailUrl }}" class="btn btn-sm btn-outline-secondary">
                                    Open <i class="ti ti-chevron-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($users->hasPages())
                    <div class="card-footer d-flex justify-content-center justify-content-md-end">
                        {{ $users->onEachSide(1)->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
