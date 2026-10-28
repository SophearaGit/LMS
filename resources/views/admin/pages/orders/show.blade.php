@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Order details')
@push('stylesheets')
    <style>
        @media (min-width: 1400px) {
            .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl { max-width: 100%; }
        }
        .min-w-0 { min-width: 0; }
        .container-xl .badge { display: inline-flex; align-items: center; gap: .3rem; vertical-align: middle; line-height: 1; padding: .35rem .55rem; font-weight: 600; }
        .container-xl .badge > .ti { font-size: 1.05em; line-height: 1; margin: 0 !important; display: block; }

        /* ── Invoice document ── */
        .inv { border-radius: 12px; overflow: hidden; }
        .inv-band { height: 6px; background: linear-gradient(90deg, var(--tblr-primary), rgba(var(--tblr-primary-rgb), .45)); }
        .inv-body { padding: 2.25rem 2.5rem; }
        .inv-logo { max-height: 40px; max-width: 170px; }
        .inv-word { font-size: 1.9rem; font-weight: 800; letter-spacing: .14em; color: var(--tblr-primary); line-height: 1; }
        .inv-label { font-size: .68rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase; color: var(--tblr-secondary); margin-bottom: .3rem; }
        .inv-meta { display: grid; grid-template-columns: auto auto; gap: .2rem 1rem; justify-content: end; font-size: .875rem; }
        .inv-meta dt { color: var(--tblr-secondary); font-weight: 400; text-align: right; }
        .inv-meta dd { margin: 0; font-weight: 600; text-align: right; }
        .inv-mono { font-family: var(--tblr-font-monospace, monospace); }
        .inv-parties { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin: 2rem 0; padding: 1.25rem 1.4rem;
            border-radius: 10px; background: var(--tblr-bg-surface-secondary, #f8fafc); border: 1px solid var(--tblr-border-color); }
        .inv-parties .name { font-weight: 700; font-size: 1rem; }
        .inv-parties .line { color: var(--tblr-secondary); font-size: .875rem; line-height: 1.55; word-break: break-word; }

        .inv-stamp { display: inline-block; border: 2px solid currentColor; border-radius: 6px; padding: .2rem .65rem;
            font-weight: 800; letter-spacing: .14em; font-size: .8rem; transform: rotate(-4deg); }

        .inv-items { width: 100%; border-collapse: collapse; }
        .inv-items th { font-size: .68rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase;
            color: var(--tblr-secondary); padding: 0 .75rem .6rem; border-bottom: 2px solid var(--tblr-border-color); text-align: left; }
        .inv-items td { padding: .9rem .75rem; border-bottom: 1px solid var(--tblr-border-color); vertical-align: middle; }
        .inv-items .num { text-align: right; white-space: nowrap; font-variant-numeric: tabular-nums; }
        .inv-items .idx { width: 2rem; color: var(--tblr-secondary); }
        .inv-thumb { width: 56px; height: 38px; border-radius: 6px; object-fit: cover; background: var(--tblr-bg-surface-secondary, #f1f5f9); flex-shrink: 0; }
        .inv-course { font-weight: 600; }

        .inv-totals { width: 100%; max-width: 340px; margin-left: auto; margin-top: 1.25rem; font-size: .9rem; }
        .inv-totals .row-line { display: flex; justify-content: space-between; padding: .35rem 0; font-variant-numeric: tabular-nums; }
        .inv-totals .row-line span:first-child { color: var(--tblr-secondary); }
        .inv-totals .grand { margin-top: .5rem; padding: .8rem 1rem; border-radius: 10px; background: rgba(var(--tblr-primary-rgb), .08);
            font-size: 1.05rem; font-weight: 800; }
        .inv-totals .grand span:first-child { color: inherit; }

        .inv-foot { margin-top: 2.25rem; padding-top: 1.25rem; border-top: 1px dashed var(--tblr-border-color);
            display: flex; flex-wrap: wrap; justify-content: space-between; gap: 1rem; font-size: .82rem; color: var(--tblr-secondary); }

        /* ── Side panel ── */
        .od-side .card + .card { margin-top: 1rem; }
        .od-kv { display: flex; justify-content: space-between; gap: 1rem; padding: .55rem 0; border-bottom: 1px solid var(--tblr-border-color); font-size: .875rem; }
        .od-kv:last-child { border-bottom: 0; }
        .od-kv > span:first-child { color: var(--tblr-secondary); flex-shrink: 0; }
        .od-kv > span:last-child { text-align: right; font-weight: 600; min-width: 0; word-break: break-all; }
        .od-split { height: 10px; border-radius: 6px; overflow: hidden; display: flex; background: var(--tblr-border-color); }
        .od-copy { border: 0; background: none; padding: 0 0 0 .35rem; color: var(--tblr-secondary); cursor: pointer; }
        .od-copy:hover { color: var(--tblr-primary); }

        @media (max-width: 767.98px) {
            .inv-body { padding: 1.5rem 1.1rem; }
            .inv-parties { grid-template-columns: 1fr; gap: 1rem; }
            .inv-head { flex-direction: column; align-items: flex-start !important; }
            .inv-meta { justify-content: start; }
            .inv-meta dt, .inv-meta dd { text-align: left; }
            .inv-items .col-qty, .inv-items .idx, .inv-thumb { display: none; }
            .inv-totals { max-width: none; }
        }

        /* ── Print: just the invoice ── */
        @media print {
            @page { margin: 12mm; }
            aside.navbar-vertical, .navbar, .footer, .d-print-none { display: none !important; }
            .page-wrapper { margin: 0 !important; padding: 0 !important; }
            body, .page { background: #fff !important; }
            .container-xl { max-width: 100% !important; padding: 0 !important; margin: 0 !important; }
            .od-main { flex: 0 0 100% !important; max-width: 100% !important; }
            .inv { border: 0 !important; box-shadow: none !important; }
            .inv-body { padding: 0 !important; }
            .inv-band, .inv-parties, .inv-totals .grand { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
@endpush
@section('content')
    @php
        $cur = $order->currency;
        $fmt = fn ($n) => number_format((float) $n, 2);
        $isPaid = $order->status === 'approved';
        $site = config('settings.site_name') ?: 'CAITD';
        // The front-site logo is drawn for light backgrounds (the admin one sits on the dark sidebar).
        $logo = is_file(public_path('front/images/logo.png')) ? 'front/images/logo.png' : null;
        $subtotal = $order->order_items->sum(fn ($i) => (float) $i->price * max(1, (int) $i->qty));
        $discount = max(0, (float) $order->total_amount - (float) $order->paid_amount);
        $customer = $order->customer;
        $avatar = $customer && $customer->image && is_file(public_path(ltrim($customer->image, '/')))
            && ! in_array($customer->image, ['/default-images/avatar/teacher.jpg', '/default-images/avatar/student_girl.png'], true)
            ? asset($customer->image) : asset('default-images/avatar/both.jpg');

        // Revenue split: commission_rate on each line is the instructor's share (%).
        $instructorShare = $order->order_items->sum(fn ($i) => (float) $i->price * max(1, (int) $i->qty) * (float) $i->commission_rate / 100);
        $platformShare = max(0, $subtotal - $instructorShare);
        $instructorPct = $subtotal > 0 ? round($instructorShare / $subtotal * 100) : 0;
    @endphp

    <div class="container-xl mt-4 mb-5">
        {{-- Top bar --}}
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 d-print-none">
            <div class="min-w-0">
                @include('admin.partials.back-link', [
                'href' => url()->previous() !== url()->current() && str_contains(url()->previous(), '/admin/orders') ? url()->previous() : route('admin.orders.index'),
                'label' => 'Orders',
            ])
                <div class="d-flex flex-wrap align-items-center gap-2 mt-1">
                    <h2 class="page-title mb-0">Order <span class="inv-mono">#{{ $order->invoice_id }}</span></h2>
                    <span class="badge {{ $isPaid ? 'bg-green-lt' : 'bg-yellow-lt' }}">
                        <i class="ti {{ $isPaid ? 'ti-circle-check' : 'ti-hourglass-high' }}"></i>{{ $isPaid ? 'Paid' : 'Pending' }}
                    </span>
                </div>
                <div class="text-secondary small mt-1">
                    Placed {{ optional($order->created_at)->format('d M Y \a\t H:i') }}
                    @if ($order->created_at) · {{ $order->created_at->diffForHumans() }} @endif
                </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="window.print()">
                <i class="ti ti-printer me-2"></i> Print / Save as PDF
            </button>
        </div>

        <div class="row g-4">
            {{-- ───────── Invoice document ───────── --}}
            <div class="col-lg-8 od-main">
                <div class="card inv">
                    <div class="inv-band"></div>
                    <div class="inv-body">
                        <div class="d-flex justify-content-between align-items-start gap-4 inv-head">
                            <div class="min-w-0">
                                @if ($logo)
                                    <img src="{{ asset($logo) }}" alt="{{ $site }}" class="inv-logo">
                                @else
                                    <div class="fw-bold fs-2">{{ $site }}</div>
                                @endif
                            </div>
                            <div class="text-end">
                                <div class="inv-word mb-3">INVOICE</div>
                                <dl class="inv-meta mb-0">
                                    <dt>Invoice no.</dt><dd class="inv-mono">#{{ $order->invoice_id }}</dd>
                                    <dt>Issued</dt><dd>{{ optional($order->created_at)->format('d M Y') }}</dd>
                                    <dt>Payment</dt><dd>{{ $method[0] }}</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="inv-parties">
                            <div class="min-w-0">
                                <div class="inv-label">From</div>
                                <div class="name">{{ $site }}</div>
                                <div class="line">
                                    @if (config('settings.site_address')) {{ config('settings.site_address') }}<br> @endif
                                    @if (config('settings.site_phone')) {{ config('settings.site_phone') }}<br> @endif
                                    @if (config('settings.receiver_email')) {{ config('settings.receiver_email') }} @endif
                                </div>
                            </div>
                            <div class="min-w-0">
                                <div class="d-flex justify-content-between align-items-start gap-2">
                                    <div class="inv-label">Billed to</div>
                                    <span class="inv-stamp {{ $isPaid ? 'text-green' : 'text-yellow' }}">{{ $isPaid ? 'PAID' : 'PENDING' }}</span>
                                </div>
                                <div class="name">{{ optional($customer)->name ?? 'Deleted user' }}</div>
                                <div class="line">{{ optional($customer)->email }}</div>
                            </div>
                        </div>

                        <table class="inv-items">
                            <thead>
                                <tr>
                                    <th class="idx">#</th>
                                    <th>Course</th>
                                    <th class="num col-qty">Qty</th>
                                    <th class="num">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->order_items as $item)
                                    @php $course = $item->course; @endphp
                                    <tr>
                                        <td class="idx">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                @if ($course && $course->thumbnail)
                                                    <img src="{{ asset($course->thumbnail) }}" alt="" class="inv-thumb" loading="lazy">
                                                @endif
                                                <div class="min-w-0">
                                                    <div class="inv-course">{{ optional($course)->title ?? 'Course no longer available' }}</div>
                                                    @if ($course && $course->instructor)
                                                        <div class="small text-secondary">by {{ $course->instructor->name }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="num col-qty">{{ max(1, (int) $item->qty) }}</td>
                                        <td class="num fw-semibold">{{ $fmt($item->price * max(1, (int) $item->qty)) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-secondary py-4">No items on this order.</td></tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="inv-totals">
                            <div class="row-line"><span>Subtotal</span><span>{{ $fmt($order->total_amount ?: $subtotal) }} {{ $cur }}</span></div>
                            @if ($order->has_coupon && $order->coupon_code)
                                <div class="row-line text-green">
                                    <span>Coupon <span class="inv-mono">{{ $order->coupon_code }}</span></span>
                                    <span>− {{ $fmt($order->coupon_discount ?: $discount) }} {{ $cur }}</span>
                                </div>
                            @elseif ($discount > 0)
                                <div class="row-line text-green"><span>Discount</span><span>− {{ $fmt($discount) }} {{ $cur }}</span></div>
                            @endif
                            <div class="row-line grand">
                                <span>{{ $isPaid ? 'Total paid' : 'Amount due' }}</span>
                                <span>{{ $fmt($order->paid_amount) }} {{ $cur }}</span>
                            </div>
                        </div>

                        <div class="inv-foot">
                            <div>
                                Paid via <strong>{{ $method[0] }}</strong>
                                @if ($order->transaction_id) · Ref <span class="inv-mono">{{ $order->transaction_id }}</span> @endif
                            </div>
                            <div>Thank you for learning with {{ $site }}.</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ───────── Admin side panel (not printed) ───────── --}}
            <div class="col-lg-4 od-side d-print-none">
                <div class="card">
                    <div class="card-header"><h3 class="card-title"><i class="ti ti-credit-card me-2 text-secondary"></i>Payment</h3></div>
                    <div class="card-body py-2">
                        <div class="od-kv"><span>Status</span>
                            <span><span class="badge {{ $isPaid ? 'bg-green-lt' : 'bg-yellow-lt' }}">{{ $isPaid ? 'Paid' : 'Pending' }}</span></span>
                        </div>
                        <div class="od-kv"><span>Method</span><span><i class="ti {{ $method[1] }} me-1 text-secondary"></i>{{ $method[0] }}</span></div>
                        <div class="od-kv"><span>Amount</span><span>{{ $fmt($order->paid_amount) }} {{ $cur }}</span></div>
                        <div class="od-kv"><span>Transaction</span>
                            <span>
                                <span class="inv-mono small" id="od-txn">{{ $order->transaction_id ?: '—' }}</span>
                                @if ($order->transaction_id)
                                    <button type="button" class="od-copy" data-copy="#od-txn" title="Copy transaction ID" aria-label="Copy transaction ID"><i class="ti ti-copy"></i></button>
                                @endif
                            </span>
                        </div>
                        <div class="od-kv"><span>Date</span><span>{{ optional($order->created_at)->format('d M Y, H:i') }}</span></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><h3 class="card-title"><i class="ti ti-user me-2 text-secondary"></i>Customer</h3></div>
                    <div class="card-body">
                        @if ($customer)
                            <div class="d-flex align-items-center gap-3">
                                <span class="avatar avatar-md rounded-circle" style="background-image: url('{{ $avatar }}')"></span>
                                <div class="min-w-0">
                                    <div class="fw-semibold text-truncate">{{ $customer->name }}</div>
                                    <div class="small text-secondary text-truncate">{{ $customer->email }}</div>
                                </div>
                            </div>
                            <a href="{{ route($customer->role === 'instructor' ? 'admin.users.instructors' : 'admin.users.students', ['search' => $customer->email]) }}"
                                class="btn btn-outline-secondary w-100 mt-3">
                                <i class="ti ti-external-link me-1"></i> Open in {{ $customer->role === 'instructor' ? 'Instructors' : 'Students' }}
                            </a>
                            <a href="{{ route('admin.orders.index', ['search' => $customer->email]) }}" class="btn btn-ghost-secondary w-100 mt-2">
                                <i class="ti ti-receipt me-1"></i> All orders by this customer
                            </a>
                        @else
                            <div class="text-secondary">This customer’s account was deleted.</div>
                        @endif
                    </div>
                </div>

                @if ($subtotal > 0)
                    <div class="card">
                        <div class="card-header"><h3 class="card-title"><i class="ti ti-chart-pie me-2 text-secondary"></i>Revenue split</h3></div>
                        <div class="card-body">
                            <div class="od-split mb-3" role="img" aria-label="Instructor {{ $instructorPct }}%, platform {{ 100 - $instructorPct }}%">
                                <div style="width: {{ $instructorPct }}%; background: var(--tblr-purple);"></div>
                                <div style="width: {{ 100 - $instructorPct }}%; background: var(--tblr-primary);"></div>
                            </div>
                            <div class="od-kv"><span><i class="ti ti-point-filled" style="color: var(--tblr-purple);"></i> Instructor ({{ $instructorPct }}%)</span><span>{{ $fmt($instructorShare) }} {{ $cur }}</span></div>
                            <div class="od-kv"><span><i class="ti ti-point-filled" style="color: var(--tblr-primary);"></i> Platform ({{ 100 - $instructorPct }}%)</span><span>{{ $fmt($platformShare) }} {{ $cur }}</span></div>
                            <div class="small text-secondary mt-2">Based on the commission rate saved with each course at the time of sale.</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.querySelectorAll('[data-copy]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var text = document.querySelector(btn.getAttribute('data-copy')).textContent.trim();
                var done = function () {
                    var icon = btn.querySelector('.ti');
                    icon.className = 'ti ti-check text-green';
                    setTimeout(function () { icon.className = 'ti ti-copy'; }, 1500);
                };
                if (navigator.clipboard) { navigator.clipboard.writeText(text).then(done).catch(function () {}); }
            });
        });
    </script>
@endpush
