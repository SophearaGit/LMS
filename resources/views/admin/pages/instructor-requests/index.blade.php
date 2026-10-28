@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Instructor Requests')
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
        .ir-filter {
            display: block; height: 100%; color: inherit; text-decoration: none;
            border: 1px solid var(--tblr-border-color); border-radius: var(--tblr-border-radius-lg, 8px);
            background: var(--tblr-bg-surface); padding: 1rem 1.1rem;
            transition: border-color .15s, box-shadow .15s, transform .15s;
            position: relative; overflow: hidden;
        }
        .ir-filter:hover { color: inherit; text-decoration: none; border-color: var(--ir-accent); transform: translateY(-1px); }
        .ir-filter.is-active { border-color: var(--ir-accent); box-shadow: 0 0 0 1px var(--ir-accent) inset; }
        .ir-filter.is-active::before {
            content: ""; position: absolute; inset: 0 0 auto 0; height: 3px; background: var(--ir-accent);
        }
        .ir-filter .ir-filter-icon {
            width: 2.5rem; height: 2.5rem; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center;
            font-size: 1.35rem; flex-shrink: 0;
        }
        .ir-filter .ir-filter-count { font-size: 1.6rem; font-weight: 700; line-height: 1.1; font-variant-numeric: tabular-nums; }
        .ir-filter .ir-filter-label { color: var(--tblr-secondary); font-size: .85rem; }
        .ir-accent-pending  { --ir-accent: var(--tblr-yellow); }
        .ir-accent-approved { --ir-accent: var(--tblr-green); }
        .ir-accent-rejected { --ir-accent: var(--tblr-red); }
        .ir-accent-all      { --ir-accent: var(--tblr-primary); }

        /* ── Table ── */
        .ir-table td { padding-top: .9rem; padding-bottom: .9rem; }
        .ir-table tbody tr { transition: background-color .12s; }
        .ir-table tbody tr:hover { background: var(--tblr-bg-surface-secondary, rgba(0,0,0,.02)); }
        .ir-name { font-weight: 600; }
        .ir-file-chip {
            display: inline-flex; align-items: center; gap: .35rem; font-size: .75rem; font-weight: 600;
            padding: .2rem .5rem; border-radius: 6px; letter-spacing: .02em; text-transform: uppercase;
        }
        .ir-actions .btn { min-width: 6.5rem; }

        /* ── Mobile cards ── */
        .ir-card { border: 1px solid var(--tblr-border-color); border-radius: 10px; padding: 1rem; background: var(--tblr-bg-surface); }
        .ir-card + .ir-card { margin-top: .75rem; }
        .ir-card .ir-meta { font-size: .85rem; color: var(--tblr-secondary); }
        .ir-card .btn { padding-top: .6rem; padding-bottom: .6rem; }
        .ir-email { word-break: break-all; }

        /* ── Empty state ── */
        .ir-empty { padding: 3.5rem 1rem; text-align: center; }
        .ir-empty .ir-empty-icon {
            width: 4rem; height: 4rem; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;
            font-size: 2rem; margin-bottom: 1rem;
        }

        /* ── Confirm modal ── */
        #ir-confirm .ir-modal-icon { font-size: 3rem; line-height: 1; }
    </style>
@endpush
@section('content')
    @php
        $filters = [
            'pending'  => ['label' => 'Pending review', 'icon' => 'ti-hourglass-high', 'tone' => 'yellow'],
            'approved' => ['label' => 'Approved',       'icon' => 'ti-circle-check',   'tone' => 'green'],
            'rejected' => ['label' => 'Rejected',       'icon' => 'ti-circle-x',       'tone' => 'red'],
            'all'      => ['label' => 'All requests',   'icon' => 'ti-list-details',   'tone' => 'primary'],
        ];
        $statusBadge = [
            'pending'  => ['Pending',  'bg-yellow-lt', 'ti-hourglass-high'],
            'approved' => ['Approved', 'bg-green-lt',  'ti-circle-check'],
            'rejected' => ['Rejected', 'bg-red-lt',    'ti-circle-x'],
        ];
        $previewable = ['pdf', 'jpg', 'jpeg', 'png'];

        // Per-row values shared by the desktop table and the mobile cards.
        $rowData = function ($item) use ($statusBadge) {
            $rowStatus = in_array($item->approval_status, ['approved', 'rejected']) ? $item->approval_status : 'pending';
            return [
                // Same default avatar the other admin user pages use, whenever the
                // user's image is empty or the file is missing.
                'avatar' => $item->image && is_file(public_path(ltrim($item->image, '/')))
                    ? asset($item->image)
                    : asset('default-images/avatar/both.jpg'),
                'rowStatus' => $rowStatus,
                'badge' => $statusBadge[$rowStatus],
                'waitingLong' => $rowStatus === 'pending' && $item->created_at && $item->created_at->lt(now()->subDays(3)),
                'docExt' => $item->document ? strtolower(pathinfo($item->document, PATHINFO_EXTENSION)) : null,
            ];
        };
    @endphp

    <div class="container-xl mt-4 mb-5">
        {{-- Page header --}}
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
            <div>
                <div class="text-secondary text-uppercase fw-semibold small mb-1">People</div>
                <h2 class="page-title mb-1">Instructor Requests</h2>
                <div class="text-secondary">
                    Review people who applied to teach. Approving makes them an instructor and emails them.
                </div>
            </div>
            <a href="{{ route('admin.users.instructors') }}" class="btn btn-outline-secondary">
                <i class="ti ti-users me-1"></i> View all instructors
            </a>
        </div>

        {{-- Filter cards --}}
        <div class="row g-3 mb-4">
            @foreach ($filters as $key => $f)
                <div class="col-6 col-lg-3">
                    <a href="{{ route('admin.instructor-requests.index', array_filter(['status' => $key, 'search' => $search])) }}"
                        class="ir-filter ir-accent-{{ $key }} {{ $status === $key ? 'is-active' : '' }}"
                        @if ($status === $key) aria-current="page" @endif>
                        <div class="d-flex align-items-center gap-3">
                            <span class="ir-filter-icon bg-{{ $f['tone'] }}-lt"><i class="ti {{ $f['icon'] }}"></i></span>
                            <div class="min-w-0">
                                <div class="ir-filter-count">{{ $counts[$key] }}</div>
                                <div class="ir-filter-label text-truncate">{{ $f['label'] }}</div>
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
                    <h3 class="card-title mb-0">{{ $filters[$status]['label'] }}</h3>
                    <div class="text-secondary small mt-1">
                        @if ($instructorRequests->total())
                            Showing {{ $instructorRequests->firstItem() }}–{{ $instructorRequests->lastItem() }}
                            of {{ $instructorRequests->total() }}
                            @if ($status === 'pending') · oldest first @endif
                        @else
                            No results
                        @endif
                    </div>
                </div>
                <form action="{{ route('admin.instructor-requests.index') }}" method="GET" class="ms-md-auto w-100"
                    style="max-width: 360px;" role="search">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <div class="input-icon">
                        <span class="input-icon-addon"><i class="ti ti-search"></i></span>
                        <input type="search" name="search" value="{{ $search }}" class="form-control"
                            placeholder="Search name or email…" aria-label="Search requests" autocomplete="off">
                    </div>
                </form>
            </div>

            @if ($instructorRequests->isEmpty())
                {{-- Empty state --}}
                <div class="ir-empty">
                    @if ($search !== '')
                        <div class="ir-empty-icon bg-secondary-lt"><i class="ti ti-search-off"></i></div>
                        <h3 class="mb-1">No matches for “{{ $search }}”</h3>
                        <p class="text-secondary mb-3">Try another name or email.</p>
                        <a href="{{ route('admin.instructor-requests.index', ['status' => $status]) }}"
                            class="btn btn-outline-secondary">Clear search</a>
                    @elseif ($status === 'pending')
                        <div class="ir-empty-icon bg-green-lt"><i class="ti ti-mood-happy"></i></div>
                        <h3 class="mb-1">You’re all caught up</h3>
                        <p class="text-secondary mb-0">There are no instructor requests waiting for review.</p>
                    @else
                        <div class="ir-empty-icon bg-secondary-lt"><i class="ti ti-inbox"></i></div>
                        <h3 class="mb-1">Nothing here yet</h3>
                        <p class="text-secondary mb-0">No {{ $status === 'all' ? '' : $status }} instructor requests.</p>
                    @endif
                </div>
            @else
                {{-- ───────── Desktop: table ───────── --}}
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-vcenter card-table ir-table">
                        <thead>
                            <tr>
                                <th>Applicant</th>
                                <th>Applied</th>
                                <th>Document</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instructorRequests as $item)
                                @php extract($rowData($item)); @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="avatar avatar-md rounded-circle"
                                                style="background-image: url('{{ $avatar }}')">
                                            </span>
                                            <div class="min-w-0">
                                                <div class="ir-name text-truncate">{{ $item->name }}</div>
                                                <span class="text-secondary small ir-email">{{ $item->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        @if ($item->created_at)
                                            <div>{{ $item->created_at->format('d M Y') }}</div>
                                            <div class="small {{ $waitingLong ? 'text-orange fw-semibold' : 'text-secondary' }}">
                                                @if ($waitingLong) <i class="ti ti-clock-exclamation"></i> Waiting @endif
                                                {{ $item->created_at->diffForHumans() }}
                                            </div>
                                        @else
                                            <span class="text-secondary">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @include('admin.pages.instructor-requests.partials.document')
                                    </td>
                                    <td>
                                        <span class="badge {{ $badge[1] }}"><i class="ti {{ $badge[2] }}"></i>{{ $badge[0] }}</span>
                                    </td>
                                    <td class="text-end">
                                        @include('admin.pages.instructor-requests.partials.actions', ['layout' => 'row'])
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ───────── Mobile / tablet: cards ───────── --}}
                <div class="card-body d-lg-none">
                    @foreach ($instructorRequests as $item)
                        @php extract($rowData($item)); @endphp
                        <div class="ir-card">
                            <div class="d-flex align-items-start gap-3">
                                <span class="avatar avatar-md rounded-circle flex-shrink-0"
                                    style="background-image: url('{{ $avatar }}')">
                                </span>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="d-flex align-items-start justify-content-between gap-2">
                                        <div class="ir-name">{{ $item->name }}</div>
                                        <span class="badge {{ $badge[1] }} flex-shrink-0">{{ $badge[0] }}</span>
                                    </div>
                                    <span class="ir-meta ir-email d-block">{{ $item->email }}</span>
                                    @if ($item->created_at)
                                        <div class="ir-meta mt-1 {{ $waitingLong ? 'text-orange fw-semibold' : '' }}">
                                            <i class="ti {{ $waitingLong ? 'ti-clock-exclamation' : 'ti-calendar' }}"></i>
                                            Applied {{ $item->created_at->format('d M Y') }} · {{ $item->created_at->diffForHumans() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3">
                                @include('admin.pages.instructor-requests.partials.document', ['mobile' => true])
                            </div>
                            @include('admin.pages.instructor-requests.partials.actions', ['layout' => 'stack'])
                        </div>
                    @endforeach
                </div>

                @if ($instructorRequests->hasPages())
                    <div class="card-footer d-flex justify-content-center justify-content-md-end">
                        {{ $instructorRequests->onEachSide(1)->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>

    {{-- Shared confirm dialog for approve / reject --}}
    <div class="modal modal-blur fade" id="ir-confirm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status" data-ir-status></div>
                <form method="POST" action="#" data-ir-form>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="" data-ir-input>
                    <div class="modal-body text-center py-4">
                        <div class="ir-modal-icon mb-2" data-ir-icon></div>
                        <h3 data-ir-title></h3>
                        <div class="text-secondary" data-ir-text></div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row g-2">
                                <div class="col">
                                    <button type="button" class="btn w-100" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn w-100" data-ir-submit></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        (function () {
            var modal = document.getElementById('ir-confirm');
            if (!modal) return;

            var copy = {
                approved: {
                    tone: 'success', icon: 'ti-circle-check text-success', button: 'Approve',
                    title: function (n) { return 'Approve ' + n + '?'; },
                    text: function (n) { return n + ' will become an instructor, can publish courses, and will get an approval email.'; }
                },
                rejected: {
                    tone: 'danger', icon: 'ti-alert-triangle text-danger', button: 'Reject',
                    title: function (n) { return 'Reject ' + n + '?'; },
                    text: function (n) { return n + ' will get a rejection email and their uploaded document will be deleted. This can’t be undone.'; }
                }
            };

            modal.addEventListener('show.bs.modal', function (e) {
                var btn = e.relatedTarget;
                if (!btn) return;
                var status = btn.getAttribute('data-status');
                var name = btn.getAttribute('data-name');
                var c = copy[status];

                modal.querySelector('[data-ir-form]').setAttribute('action', btn.getAttribute('data-action'));
                modal.querySelector('[data-ir-input]').value = status;
                modal.querySelector('[data-ir-status]').className = 'modal-status bg-' + c.tone;
                modal.querySelector('[data-ir-icon]').innerHTML = '<i class="ti ' + c.icon + '"></i>';
                modal.querySelector('[data-ir-title]').textContent = c.title(name);
                modal.querySelector('[data-ir-text]').textContent = c.text(name);

                var submit = modal.querySelector('[data-ir-submit]');
                submit.className = 'btn btn-' + c.tone + ' w-100';
                submit.disabled = false;
                submit.textContent = c.button;
            });

            // Prevent double submits and show progress while the email is sent.
            modal.querySelector('[data-ir-form]').addEventListener('submit', function () {
                var submit = modal.querySelector('[data-ir-submit]');
                submit.disabled = true;
                submit.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Saving…';
            });
        })();
    </script>
@endpush
