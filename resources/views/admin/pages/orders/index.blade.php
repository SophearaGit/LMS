@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Orders')
@push('stylesheets')
    @include('admin.pages.users.partials.people-styles')
    <style>
        .od-revenue { border: 1px solid var(--tblr-border-color); border-radius: var(--tblr-border-radius-lg, 8px);
            background: linear-gradient(135deg, rgba(var(--tblr-primary-rgb), .08), rgba(var(--tblr-primary-rgb), .02));
            padding: 1rem 1.1rem; height: 100%; }
        .od-revenue .amount { font-size: 1.45rem; font-weight: 700; line-height: 1.15; font-variant-numeric: tabular-nums; }
        .od-revenue .amount small { font-size: .7em; font-weight: 600; color: var(--tblr-secondary); }
        .od-revenue .more { font-size: .78rem; color: var(--tblr-secondary); }

        .od-filters { display: flex; flex-wrap: wrap; gap: .5rem; align-items: center; padding: .75rem 1rem;
            border-bottom: 1px solid var(--tblr-border-color); background: var(--tblr-bg-surface-secondary, #f8fafc); }
        .od-filters .form-select { width: auto; min-width: 9.5rem; }
        .od-filters .form-select.is-set { border-color: var(--tblr-primary); color: var(--tblr-primary); font-weight: 600; }

        .od-invoice { font-weight: 600; font-family: var(--tblr-font-monospace, monospace); font-size: .85rem; }
        .od-amount { font-weight: 700; font-variant-numeric: tabular-nums; white-space: nowrap; }
        .od-amount .cur { font-size: .75em; font-weight: 600; color: var(--tblr-secondary); margin-left: .2rem; }
        .od-courses { max-width: 280px; }
        .od-method { display: inline-flex; align-items: center; gap: .4rem; white-space: nowrap; }
        .od-method .ti { font-size: 1.15rem; color: var(--tblr-secondary); }

        .od-card .od-top { display: flex; justify-content: space-between; align-items: flex-start; gap: .5rem; }
        .od-card .od-foot { display: flex; justify-content: space-between; align-items: flex-end; gap: .75rem;
            margin-top: .85rem; padding-top: .85rem; border-top: 1px dashed var(--tblr-border-color); }
        .od-card .od-amount { font-size: 1.15rem; }
    </style>
@endpush
@section('content')
    @php
        $statusMeta = [
            'approved' => ['Paid',    'bg-green-lt',  'ti-circle-check'],
            'pending'  => ['Pending', 'bg-yellow-lt', 'ti-hourglass-high'],
        ];
        $filterCards = [
            'all'      => ['All orders', 'ti-receipt',        'primary'],
            'approved' => ['Paid',       'ti-circle-check',   'green'],
            'pending'  => ['Pending',    'ti-hourglass-high', 'yellow'],
        ];
        $money = fn ($amount, $currency) => number_format((float) $amount, 2);
        $link = fn (array $over = []) => route('admin.orders.index', array_filter(array_merge([
            'status' => $status === 'all' ? null : $status,
            'method' => $method ?: null,
            'period' => $period === 'any' ? null : $period,
            'sort'   => $sort === 'newest' ? null : $sort,
            'search' => $search ?: null,
        ], $over)));
        $courseNames = fn ($order) => $order->order_items->map(fn ($i) => optional($i->course)->title)->filter()->values();
    @endphp

    <div class="container-xl mt-4 mb-5">
        {{-- Page header --}}
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
            <div>
                <div class="text-secondary text-uppercase fw-semibold small mb-1">Sales</div>
                <h2 class="page-title mb-1">Orders</h2>
                <div class="text-secondary">Every course purchase, who bought it, how they paid and whether it went through.</div>
            </div>
            <a href="{{ route('admin.payment-settings.index') }}" class="btn btn-outline-secondary">
                <i class="ti ti-credit-card me-1"></i> Payment settings
            </a>
        </div>

        {{-- Summary: status filters + revenue --}}
        <div class="row g-3 mb-4">
            @foreach ($filterCards as $key => $f)
                <div class="col-6 col-lg-3">
                    <a href="{{ $link(['status' => $key === 'all' ? null : $key]) }}" style="--pp-accent: var(--tblr-{{ $f[2] }});"
                        class="pp-filter {{ $status === $key ? 'is-active' : '' }}" @if ($status === $key) aria-current="page" @endif>
                        <div class="d-flex align-items-center gap-3">
                            <span class="pp-filter-icon bg-{{ $f[2] }}-lt"><i class="ti {{ $f[1] }}"></i></span>
                            <div class="min-w-0">
                                <div class="pp-filter-count">{{ number_format($counts[$key]) }}</div>
                                <div class="pp-filter-label text-truncate">{{ $f[0] }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="col-6 col-lg-3">
                <div class="od-revenue">
                    <div class="pp-filter-label mb-1"><i class="ti ti-cash me-1"></i>Revenue (paid)</div>
                    @forelse ($revenue->take(1) as $r)
                        <div class="amount">{{ $money($r->total, $r->currency) }}<small> {{ $r->currency }}</small></div>
                    @empty
                        <div class="amount">0.00</div>
                    @endforelse
                    <div class="more">
                        @php $month = $revenueThisMonth->first(); @endphp
                        This month: {{ $month ? $money($month->total, $month->currency) . ' ' . $month->currency : '0.00' }}
                        @if ($revenue->count() > 1)
                            <br>+ {{ $revenue->slice(1)->map(fn ($r) => $money($r->total, $r->currency) . ' ' . $r->currency)->implode(', ') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            {{-- Toolbar --}}
            <div class="card-header flex-wrap gap-3">
                <div>
                    <h3 class="card-title mb-0">{{ $filterCards[$status][0] }}</h3>
                    <div class="text-secondary small mt-1">
                        @if ($orders->total())
                            Showing {{ $orders->firstItem() }}–{{ $orders->lastItem() }} of {{ number_format($orders->total()) }}
                        @else
                            No results
                        @endif
                    </div>
                </div>
                <form action="{{ route('admin.orders.index') }}" method="GET" class="ms-md-auto w-100" style="max-width: 380px;" role="search">
                    @foreach (['status' => $status === 'all' ? null : $status, 'method' => $method ?: null, 'period' => $period === 'any' ? null : $period, 'sort' => $sort === 'newest' ? null : $sort] as $k => $v)
                        @if ($v) <input type="hidden" name="{{ $k }}" value="{{ $v }}"> @endif
                    @endforeach
                    <div class="input-icon">
                        <span class="input-icon-addon"><i class="ti ti-search"></i></span>
                        <input type="search" name="search" value="{{ $search }}" class="form-control"
                            placeholder="Invoice, transaction, name or email…" aria-label="Search orders" autocomplete="off">
                    </div>
                </form>
            </div>

            {{-- Filter bar --}}
            <form action="{{ route('admin.orders.index') }}" method="GET" class="od-filters">
                @if ($status !== 'all') <input type="hidden" name="status" value="{{ $status }}"> @endif
                @if ($search !== '') <input type="hidden" name="search" value="{{ $search }}"> @endif
                <select name="method" class="form-select form-select-sm {{ $method ? 'is-set' : '' }}" aria-label="Payment method" onchange="this.form.submit()">
                    <option value="">All payment methods</option>
                    @foreach ($methods as $key => $m)
                        <option value="{{ $key }}" @selected($method === $key)>{{ $m[0] }}</option>
                    @endforeach
                </select>
                <select name="period" class="form-select form-select-sm {{ $period !== 'any' ? 'is-set' : '' }}" aria-label="Date range" onchange="this.form.submit()">
                    @foreach ($periods as $key => $label)
                        <option value="{{ $key === 'any' ? '' : $key }}" @selected($period === $key)>{{ $label }}</option>
                    @endforeach
                </select>
                <select name="sort" class="form-select form-select-sm" aria-label="Sort orders" onchange="this.form.submit()">
                    <option value="" @selected($sort === 'newest')>Newest first</option>
                    <option value="oldest" @selected($sort === 'oldest')>Oldest first</option>
                    <option value="amount" @selected($sort === 'amount')>Highest amount</option>
                </select>
                @if ($hasFilters)
                    <a href="{{ route('admin.orders.index', array_filter(['status' => $status === 'all' ? null : $status])) }}"
                        class="btn btn-sm btn-ghost-secondary ms-auto">
                        <i class="ti ti-x me-1"></i> Clear filters
                    </a>
                @endif
            </form>

            @if ($orders->isEmpty())
                <div class="pp-empty">
                    @if ($hasFilters)
                        <div class="pp-empty-icon bg-secondary-lt"><i class="ti ti-filter-off"></i></div>
                        <h3 class="mb-1">No orders match these filters</h3>
                        <p class="text-secondary mb-3">Try a different date range, payment method or search.</p>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Show all orders</a>
                    @else
                        <div class="pp-empty-icon bg-secondary-lt"><i class="ti ti-receipt-off"></i></div>
                        <h3 class="mb-1">No {{ $status === 'all' ? '' : strtolower($filterCards[$status][0]) }} orders yet</h3>
                        <p class="text-secondary mb-0">Orders appear here as soon as students buy a course.</p>
                    @endif
                </div>
            @else
                {{-- ───────── Desktop: table ───────── --}}
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-vcenter card-table pp-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Courses</th>
                                <th>Payment</th>
                                <th class="text-end">Amount</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $st = $statusMeta[$order->status] ?? [ucfirst($order->status), 'bg-secondary-lt', 'ti-circle'];
                                    $m = $methods[$order->payment_method] ?? [ucfirst($order->payment_method), 'ti-credit-card'];
                                    $names = $courseNames($order);
                                    $discounted = (float) $order->total_amount > (float) $order->paid_amount;
                                @endphp
                                <tr>
                                    <td class="text-nowrap">
                                        <div class="od-invoice">#{{ $order->invoice_id }}</div>
                                        <div class="small text-secondary">
                                            {{ optional($order->created_at)->format('d M Y, H:i') }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($order->customer)
                                            <div class="pp-name text-truncate" style="max-width: 220px;">{{ $order->customer->name }}</div>
                                            <div class="small text-secondary text-truncate" style="max-width: 220px;">{{ $order->customer->email }}</div>
                                        @else
                                            <span class="text-secondary">Deleted user</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="od-courses text-truncate" title="{{ $names->implode(', ') }}">{{ $names->first() ?? '—' }}</div>
                                        @if ($order->order_items_count > 1)
                                            <div class="small text-secondary">+ {{ $order->order_items_count - 1 }} more {{ \Illuminate\Support\Str::plural('course', $order->order_items_count - 1) }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="od-method"><i class="ti {{ $m[1] }}"></i>{{ $m[0] }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="od-amount">{{ $money($order->paid_amount, $order->currency) }}<span class="cur">{{ $order->currency }}</span></div>
                                        @if ($order->has_coupon && $order->coupon_code)
                                            <div class="small text-green">Coupon {{ $order->coupon_code }}</div>
                                        @elseif ($discounted)
                                            <div class="small text-secondary"><s>{{ $money($order->total_amount, $order->currency) }}</s></div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $st[1] }}"><i class="ti {{ $st[2] }}"></i>{{ $st[0] }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary text-nowrap">
                                            View <i class="ti ti-chevron-right ms-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ───────── Mobile / tablet: cards ───────── --}}
                <div class="card-body d-lg-none pp-list-cards">
                    @foreach ($orders as $order)
                        @php
                            $st = $statusMeta[$order->status] ?? [ucfirst($order->status), 'bg-secondary-lt', 'ti-circle'];
                            $m = $methods[$order->payment_method] ?? [ucfirst($order->payment_method), 'ti-credit-card'];
                            $names = $courseNames($order);
                        @endphp
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="pp-card od-card d-block text-reset text-decoration-none">
                            <div class="od-top">
                                <div class="min-w-0">
                                    <div class="od-invoice">#{{ $order->invoice_id }}</div>
                                    <div class="pp-meta">{{ optional($order->created_at)->format('d M Y, H:i') }}</div>
                                </div>
                                <span class="badge {{ $st[1] }} flex-shrink-0"><i class="ti {{ $st[2] }}"></i>{{ $st[0] }}</span>
                            </div>
                            <div class="mt-3">
                                <div class="pp-name">{{ optional($order->customer)->name ?? 'Deleted user' }}</div>
                                @if ($order->customer)<div class="pp-meta pp-email">{{ $order->customer->email }}</div>@endif
                            </div>
                            <div class="pp-meta mt-2 text-truncate">
                                <i class="ti ti-book"></i> {{ $names->first() ?? '—' }}
                                @if ($order->order_items_count > 1) <span class="text-secondary">+{{ $order->order_items_count - 1 }} more</span> @endif
                            </div>
                            <div class="od-foot">
                                <span class="od-method pp-meta"><i class="ti {{ $m[1] }}"></i>{{ $m[0] }}</span>
                                <div class="text-end">
                                    <div class="od-amount">{{ $money($order->paid_amount, $order->currency) }}<span class="cur">{{ $order->currency }}</span></div>
                                    <div class="small text-primary">View details <i class="ti ti-chevron-right"></i></div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if ($orders->hasPages())
                    <div class="card-footer d-flex justify-content-center justify-content-md-end">
                        {{ $orders->onEachSide(1)->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
