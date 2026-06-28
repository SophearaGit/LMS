@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Instructors')
@push('stylesheets')
    <style>
        @media (min-width: 1400px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl,
            .container-xxl {
                max-width: 100%;
            }
        }

        /* ── View toggle (only 2 states needed, no Tabler native) ── */
        .ir-view-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border: var(--tblr-border-width) solid var(--tblr-border-color);
            background: transparent;
            border-radius: var(--tblr-border-radius);
            color: var(--tblr-secondary);
            cursor: pointer;
            transition: background .15s, color .15s;
        }

        .ir-view-btn:first-child {
            border-right: 0;
            border-radius: var(--tblr-border-radius) 0 0 var(--tblr-border-radius);
        }

        .ir-view-btn:last-child {
            border-radius: 0 var(--tblr-border-radius) var(--tblr-border-radius) 0;
        }

        .ir-view-btn.active,
        .ir-view-btn:hover {
            background: var(--tblr-bg-surface-secondary);
            color: var(--tblr-body-color);
        }

        /* ── Grid view ── */
        #grid-view {
            display: none;
        }

        #grid-view.active {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: var(--tblr-page-padding);
        }

        /* ── Disabled row/card ── */
        .row-disabled {
            opacity: .45;
        }

        .card-disabled {
            opacity: .45;
        }

        /* ── Toggle switch (tiny, pure CSS) ── */
        .tblr-switch {
            position: relative;
            display: inline-block;
            width: 2rem;
            height: 1.25rem;
        }

        .tblr-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .tblr-switch-slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background: var(--tblr-border-color);
            border-radius: 100rem;
            transition: .2s;
        }

        .tblr-switch-slider::before {
            content: '';
            position: absolute;
            width: .875rem;
            height: .875rem;
            left: .1875rem;
            bottom: .1875rem;
            background: #fff;
            border-radius: 50%;
            transition: .2s;
        }

        .tblr-switch input:checked+.tblr-switch-slider {
            background: var(--tblr-success);
        }

        .tblr-switch input:checked+.tblr-switch-slider::before {
            transform: translateX(.75rem);
        }
    </style>
@endpush
@section('content')
    <div class="container-xl mt-4">
        {{-- Stats row --}}
        <div class="row row-cards mb-3">
            <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Total instructors</div>
                                <div class="text-secondary">{{ $instructors->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-success text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Active</div>
                                <div class="text-secondary">{{ $instructors->where('account_status', 'enabled')->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-secondary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Disabled</div>
                                <div class="text-secondary">{{ $instructors->where('account_status', 'disabled')->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Instructors</h3>
                <div class="card-actions d-flex align-items-center gap-2">
                    {{-- View toggle --}}
                    <div class="d-flex">
                        <button class="ir-view-btn active" id="btn-list" title="List view" aria-label="List view">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6" />
                                <line x1="8" y1="12" x2="21" y2="12" />
                                <line x1="8" y1="18" x2="21" y2="18" />
                                <line x1="3" y1="6" x2="3.01" y2="6" />
                                <line x1="3" y1="12" x2="3.01" y2="12" />
                                <line x1="3" y1="18" x2="3.01" y2="18" />
                            </svg>
                        </button>
                        <button class="ir-view-btn" id="btn-grid" title="Grid view" aria-label="Grid view">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7" />
                                <rect x="14" y="3" width="7" height="7" />
                                <rect x="14" y="14" width="7" height="7" />
                                <rect x="3" y="14" width="7" height="7" />
                            </svg>
                        </button>
                    </div>
                    {{-- Export dropdown --}}
                    <div class="dropdown">
                        <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{ route('admin.users.instructors.excel') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                </svg>
                                Export Excel
                            </a>
                            <a href="{{ route('admin.users.instructors.exportPdf') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                </svg>
                                Download PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- ═══ LIST VIEW ═══ --}}
                <div id="list-view">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Instructor</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Account</th>
                                    <th>Toggle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($instructors as $instructor)
                                    @php $isDisabled = $instructor->account_status === 'disabled'; @endphp
                                    <tr class="{{ $isDisabled ? 'row-disabled' : '' }}">
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url({{ $instructor->image === '/default-images/avatar/teacher.jpg' ? asset('/default-images/avatar/both.jpg') : asset($instructor->image) }})"></span>
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">{{ $instructor->name }}</div>
                                                    @if ($instructor->headline)
                                                        <div class="text-secondary small">{{ $instructor->headline }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-secondary">{{ $instructor->email }}</td>
                                        <td class="text-secondary">{{ ucfirst($instructor->role) }}</td>
                                        <td>
                                            @if ($isDisabled)
                                                <span class="badge bg-secondary text-secondary-fg">Disabled</span>
                                            @else
                                                <span class="badge bg-success text-success-fg">Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form
                                                action="{{ route('admin.users.instructors.toggle-active', $instructor->id) }}"
                                                method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="account_status"
                                                    value="{{ $isDisabled ? 'enabled' : 'disabled' }}">
                                                <label class="tblr-switch"
                                                    title="{{ $isDisabled ? 'Enable account' : 'Disable account' }}">
                                                    <input type="checkbox" {{ $isDisabled ? '' : 'checked' }}
                                                        onchange="this.closest('form').submit()">
                                                    <span class="tblr-switch-slider"></span>
                                                </label>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="empty">
                                                <div class="empty-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                                        <circle cx="9" cy="7" r="4" />
                                                    </svg>
                                                </div>
                                                <p class="empty-title">No instructors found</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- ═══ END LIST VIEW ═══ --}}
                {{-- ═══ GRID VIEW ═══ --}}
                <div id="grid-view">
                    @forelse ($instructors as $instructor)
                        @php $isDisabled = $instructor->account_status === 'disabled'; @endphp
                        <div class="card card-sm {{ $isDisabled ? 'card-disabled' : '' }}">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="avatar avatar-md me-3"
                                        style="background-image: url({{ $instructor->image === '/default-images/avatar/teacher.jpg' ? asset('/default-images/avatar/both.jpg') : asset($instructor->image) }})"></span>
                                    <div class="flex-fill overflow-hidden">
                                        <div class="font-weight-medium text-truncate">{{ $instructor->name }}</div>
                                        <div class="text-secondary small text-truncate">
                                            {{ $instructor->headline ?? ucfirst($instructor->role) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-secondary small mb-2 text-truncate">{{ $instructor->email }}</div>
                                <div class="d-flex align-items-center justify-content-between">
                                    @if ($isDisabled)
                                        <span class="badge bg-secondary-lt text-secondary">Disabled</span>
                                    @else
                                        <span class="badge bg-success-lt text-success">Active</span>
                                    @endif
                                    <form action="{{ route('admin.users.instructors.toggle-active', $instructor->id) }}"
                                        method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="account_status"
                                            value="{{ $isDisabled ? 'enabled' : 'disabled' }}">
                                        <label class="tblr-switch"
                                            title="{{ $isDisabled ? 'Enable account' : 'Disable account' }}">
                                            <input type="checkbox" {{ $isDisabled ? '' : 'checked' }}
                                                onchange="this.closest('form').submit()">
                                            <span class="tblr-switch-slider"></span>
                                        </label>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty" style="grid-column:1/-1">
                            <p class="empty-title">No instructors found</p>
                        </div>
                    @endforelse
                </div>
                {{-- ═══ END GRID VIEW ═══ --}}
            </div>
            {{-- Pagination --}}
            @if (method_exists($instructors, 'hasPages') && $instructors->hasPages())
                <div class="card-footer d-flex align-items-center">
                    {{ $instructors->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        (function() {
            var btnList = document.getElementById('btn-list');
            var btnGrid = document.getElementById('btn-grid');
            var listView = document.getElementById('list-view');
            var gridView = document.getElementById('grid-view');
            var KEY = 'instructors_view_pref';

            function setView(mode) {
                if (mode === 'grid') {
                    listView.style.display = 'none';
                    gridView.classList.add('active');
                    btnGrid.classList.add('active');
                    btnList.classList.remove('active');
                } else {
                    listView.style.display = 'block';
                    gridView.classList.remove('active');
                    btnList.classList.add('active');
                    btnGrid.classList.remove('active');
                }
                localStorage.setItem(KEY, mode);
            }
            btnList.addEventListener('click', function() {
                setView('list');
            });
            btnGrid.addEventListener('click', function() {
                setView('grid');
            });
            var saved = localStorage.getItem(KEY);
            if (saved === 'grid') {
                setView('grid');
            }
        })();
    </script>
@endpush
