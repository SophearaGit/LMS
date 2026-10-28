@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Payout Requests')
@push('stylesheets')
    @include('admin.pages.users.partials.people-styles')
    <style>
        .wr-money { font-weight: 700; font-variant-numeric: tabular-nums; white-space: nowrap; }
        .wr-big { font-size: 1.1rem; }
        .wr-sub { font-size: .78rem; color: var(--tblr-secondary); }
        .wr-filter-amt { font-size: .78rem; color: var(--tblr-secondary); font-variant-numeric: tabular-nums; }
        .wr-pay { display: inline-flex; align-items: center; gap: .4rem; white-space: nowrap; }
        .wr-pay .ti { font-size: 1.15rem; color: var(--tblr-secondary); }
        .wr-card .wr-top { display: flex; justify-content: space-between; align-items: flex-start; gap: .75rem; }
        .wr-card .wr-foot { display: flex; justify-content: space-between; align-items: center; gap: .75rem;
            margin-top: .85rem; padding-top: .85rem; border-top: 1px dashed var(--tblr-border-color); }
    </style>
@endpush
@section('content')
    @php
        // Shared helpers for the payout request pages.
        $cur = config('settings.site_currency_icon') ?: '$';
        $money = fn ($n) => $cur . number_format((float) $n, 2);
        $statusMeta = [
            'pending'  => ['Waiting',  'bg-yellow-lt', 'ti-hourglass-high'],
            'approved' => ['Paid',     'bg-green-lt',  'ti-circle-check'],
            'rejected' => ['Rejected', 'bg-red-lt',    'ti-circle-x'],
        ];
        $gatewayIcon = function ($name) {
            $n = strtolower((string) $name);
            return match (true) {
                $n === ''                    => 'ti-alert-triangle',
                str_contains($n, 'aba')      => 'ti-building-bank',
                str_contains($n, 'paypal')   => 'ti-brand-paypal',
                str_contains($n, 'stripe')   => 'ti-brand-stripe',
                str_contains($n, 'razorpay') => 'ti-credit-card',
                str_contains($n, 'bank')     => 'ti-building-bank',
                default                      => 'ti-wallet',
            };
        };
        $avatarOf = function ($user) {
            $img = $user->image ?? null;
            return $img && is_file(public_path(ltrim($img, '/')))
                && ! in_array($img, ['/default-images/avatar/teacher.jpg', '/default-images/avatar/student_girl.png'], true)
                ? asset($img) : asset('default-images/avatar/both.jpg');
        };
    @endphp
    @php
        $filters = [
            'pending'  => ['Waiting for payment', 'ti-hourglass-high', 'yellow', $money($totals['pending']) . ' requested'],
            'approved' => ['Paid out',            'ti-circle-check',   'green',  $money($totals['paid']) . ' total'],
            'rejected' => ['Rejected',            'ti-circle-x',       'red',    null],
            'all'      => ['All requests',        'ti-list-details',   'primary', null],
        ];
    @endphp

    <div class="container-xl mt-4 mb-5">
        {{-- Page header --}}
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
            <div>
                <div class="text-secondary text-uppercase fw-semibold small mb-1">Payments</div>
                <h2 class="page-title mb-1">Payout Requests</h2>
                <div class="text-secondary">
                    Instructors asking to withdraw their earnings. Send the money, then mark the request as paid.
                    @if ($totals['paidMonth'] > 0) <span class="text-nowrap">· {{ $money($totals['paidMonth']) }} paid this month</span> @endif
                </div>
            </div>
            <a href="{{ route('admin.payout-gateways.index') }}" class="btn btn-outline-secondary">
                <i class="ti ti-wallet me-1"></i> Payout gateways
            </a>
        </div>

        {{-- Status cards --}}
        <div class="row g-3 mb-4">
            @foreach ($filters as $key => $f)
                <div class="col-6 col-lg-3">
                    <a href="{{ route('admin.withdraw-request.index', array_filter(['status' => $key, 'search' => $search ?: null])) }}"
                        style="--pp-accent: var(--tblr-{{ $f[2] }});"
                        class="pp-filter {{ $status === $key ? 'is-active' : '' }}" @if ($status === $key) aria-current="page" @endif>
                        <div class="d-flex align-items-center gap-3">
                            <span class="pp-filter-icon bg-{{ $f[2] }}-lt"><i class="ti {{ $f[1] }}"></i></span>
                            <div class="min-w-0">
                                <div class="pp-filter-count">{{ $counts[$key] }}</div>
                                <div class="pp-filter-label text-truncate">{{ $f[0] }}</div>
                                @if ($f[3]) <div class="wr-filter-amt text-truncate">{{ $f[3] }}</div> @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="card">
            <div class="card-header flex-wrap gap-3">
                <div>
                    <h3 class="card-title mb-0">{{ $filters[$status][0] }}</h3>
                    <div class="text-secondary small mt-1">
                        @if ($withdrawRequests->total())
                            Showing {{ $withdrawRequests->firstItem() }}–{{ $withdrawRequests->lastItem() }} of {{ $withdrawRequests->total() }}
                            @if ($status === 'pending') · oldest first @endif
                        @else
                            No results
                        @endif
                    </div>
                </div>
                <form action="{{ route('admin.withdraw-request.index') }}" method="GET" class="ms-md-auto w-100" style="max-width: 360px;" role="search">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <div class="input-icon">
                        <span class="input-icon-addon"><i class="ti ti-search"></i></span>
                        <input type="search" name="search" value="{{ $search }}" class="form-control"
                            placeholder="Instructor, email or transaction ref…" aria-label="Search payout requests" autocomplete="off">
                    </div>
                </form>
            </div>

            @if ($withdrawRequests->isEmpty())
                <div class="pp-empty">
                    @if ($search !== '')
                        <div class="pp-empty-icon bg-secondary-lt"><i class="ti ti-search-off"></i></div>
                        <h3 class="mb-1">No matches for “{{ $search }}”</h3>
                        <p class="text-secondary mb-3">Try another name, email or reference.</p>
                        <a href="{{ route('admin.withdraw-request.index', ['status' => $status]) }}" class="btn btn-outline-secondary">Clear search</a>
                    @elseif ($status === 'pending')
                        <div class="pp-empty-icon bg-green-lt"><i class="ti ti-mood-happy"></i></div>
                        <h3 class="mb-1">You’re all caught up</h3>
                        <p class="text-secondary mb-3">No instructor is waiting for a payout.</p>
                        <a href="{{ route('admin.withdraw-request.index', ['status' => 'all']) }}" class="btn btn-outline-secondary">See all requests</a>
                    @else
                        <div class="pp-empty-icon bg-secondary-lt"><i class="ti ti-inbox"></i></div>
                        <h3 class="mb-1">Nothing here yet</h3>
                        <p class="text-secondary mb-0">No {{ $status === 'all' ? '' : strtolower($filters[$status][0]) }} payout requests.</p>
                    @endif
                </div>
            @else
                {{-- ───────── Desktop: table ───────── --}}
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-vcenter card-table pp-table">
                        <thead>
                            <tr>
                                <th>Instructor</th>
                                <th class="text-end">Amount</th>
                                <th>Pay to</th>
                                <th>Requested</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdrawRequests as $w)
                                @php
                                    $i = $w->instructor;
                                    $st = $statusMeta[$w->status] ?? $statusMeta['pending'];
                                    $gateway = optional(optional($i)->payoutInformation)->gateway;
                                    $short = $w->status === 'pending' && $i && round((float) $i->wallet, 2) < round((float) $w->amount, 2);
                                    $waitingLong = $w->status === 'pending' && $w->created_at && $w->created_at->lt(now()->subDays(3));
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="avatar avatar-md rounded-circle" style="background-image: url('{{ $i ? $avatarOf($i) : asset('default-images/avatar/both.jpg') }}')"></span>
                                            <div class="min-w-0">
                                                <div class="pp-name text-truncate" style="max-width: 240px;">{{ optional($i)->name ?? 'Deleted instructor' }}</div>
                                                <div class="small text-secondary text-truncate" style="max-width: 240px;">{{ optional($i)->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="wr-money wr-big">{{ $money($w->amount) }}</div>
                                        @if ($w->status === 'pending' && $i)
                                            <div class="wr-sub {{ $short ? 'text-red fw-semibold' : '' }}">
                                                @if ($short) <i class="ti ti-alert-triangle"></i> @endif Balance {{ $money($i->wallet) }}
                                            </div>
                                        @elseif ($w->status === 'approved' && $w->transaction_id)
                                            <div class="wr-sub text-truncate" style="max-width: 160px;" title="{{ $w->transaction_id }}">Ref {{ $w->transaction_id }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($gateway)
                                            <span class="wr-pay"><i class="ti {{ $gatewayIcon($gateway) }}"></i>{{ $gateway }}</span>
                                        @else
                                            <span class="text-orange small"><i class="ti ti-alert-triangle"></i> No payout details</span>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">
                                        @if ($w->created_at)
                                            <div>{{ $w->created_at->format('d M Y') }}</div>
                                            <div class="small {{ $waitingLong ? 'text-orange fw-semibold' : 'text-secondary' }}">
                                                @if ($waitingLong) <i class="ti ti-clock-exclamation"></i> Waiting @endif
                                                {{ $w->created_at->diffForHumans() }}
                                            </div>
                                        @endif
                                    </td>
                                    <td><span class="badge {{ $st[1] }}"><i class="ti {{ $st[2] }}"></i>{{ $st[0] }}</span></td>
                                    <td>
                                        @if ($w->status === 'pending')
                                            <a href="{{ route('admin.withdraw-request.show', $w->id) }}" class="btn btn-sm btn-primary text-nowrap">
                                                Review &amp; pay <i class="ti ti-chevron-right ms-1"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.withdraw-request.show', $w->id) }}" class="btn btn-sm btn-outline-secondary text-nowrap">
                                                View <i class="ti ti-chevron-right ms-1"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ───────── Mobile / tablet: cards ───────── --}}
                <div class="card-body d-lg-none pp-list-cards">
                    @foreach ($withdrawRequests as $w)
                        @php
                            $i = $w->instructor;
                            $st = $statusMeta[$w->status] ?? $statusMeta['pending'];
                            $gateway = optional(optional($i)->payoutInformation)->gateway;
                            $short = $w->status === 'pending' && $i && round((float) $i->wallet, 2) < round((float) $w->amount, 2);
                        @endphp
                        <a href="{{ route('admin.withdraw-request.show', $w->id) }}" class="pp-card wr-card d-block text-reset text-decoration-none">
                            <div class="wr-top">
                                <div class="d-flex align-items-center gap-3 min-w-0">
                                    <span class="avatar avatar-md rounded-circle flex-shrink-0" style="background-image: url('{{ $i ? $avatarOf($i) : asset('default-images/avatar/both.jpg') }}')"></span>
                                    <div class="min-w-0">
                                        <div class="pp-name text-truncate">{{ optional($i)->name ?? 'Deleted instructor' }}</div>
                                        <div class="pp-meta">{{ optional($w->created_at)->format('d M Y') }} · {{ optional($w->created_at)->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <span class="badge {{ $st[1] }} flex-shrink-0"><i class="ti {{ $st[2] }}"></i>{{ $st[0] }}</span>
                            </div>
                            <div class="wr-foot">
                                <div class="min-w-0">
                                    @if ($gateway)
                                        <span class="wr-pay pp-meta"><i class="ti {{ $gatewayIcon($gateway) }}"></i>{{ $gateway }}</span>
                                    @else
                                        <span class="text-orange small"><i class="ti ti-alert-triangle"></i> No payout details</span>
                                    @endif
                                    @if ($short) <div class="small text-red fw-semibold mt-1"><i class="ti ti-alert-triangle"></i> Balance too low</div> @endif
                                </div>
                                <div class="text-end">
                                    <div class="wr-money wr-big">{{ $money($w->amount) }}</div>
                                    <div class="small text-primary">{{ $w->status === 'pending' ? 'Review & pay' : 'View' }} <i class="ti ti-chevron-right"></i></div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if ($withdrawRequests->hasPages())
                    <div class="card-footer d-flex justify-content-center justify-content-md-end">
                        {{ $withdrawRequests->onEachSide(1)->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
