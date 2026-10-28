@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Payout Request')
@push('stylesheets')
    <style>
        @media (min-width: 1400px) {
            .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl { max-width: 100%; }
        }
        .min-w-0 { min-width: 0; }
        .container-xl .badge { display: inline-flex; align-items: center; gap: .3rem; vertical-align: middle; line-height: 1; padding: .35rem .55rem; font-weight: 600; }
        .container-xl .badge > .ti { font-size: 1.05em; line-height: 1; margin: 0 !important; display: block; }

        .wr-hero { border-radius: 12px; overflow: hidden; }
        .wr-hero-band { height: 5px; }
        .wr-amount { font-size: 2.4rem; font-weight: 800; line-height: 1.05; font-variant-numeric: tabular-nums; letter-spacing: -.01em; }
        .wr-label { font-size: .68rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase; color: var(--tblr-secondary); margin-bottom: .3rem; }
        .wr-balance { display: grid; grid-template-columns: repeat(3, 1fr); gap: .5rem; margin-top: 1.25rem; }
        .wr-balance > div { border: 1px solid var(--tblr-border-color); border-radius: 10px; padding: .65rem .8rem; min-width: 0; }
        .wr-balance .v { font-weight: 700; font-variant-numeric: tabular-nums; font-size: 1.05rem; }
        .wr-balance .op { color: var(--tblr-secondary); }

        .wr-payto { border: 1px solid var(--tblr-border-color); border-radius: 10px; background: var(--tblr-bg-surface-secondary, #f8fafc); }
        .wr-payto-head { display: flex; align-items: center; justify-content: space-between; gap: .75rem; padding: .8rem 1rem; border-bottom: 1px solid var(--tblr-border-color); }
        .wr-gw { display: inline-flex; align-items: center; gap: .55rem; font-weight: 700; }
        .wr-gw .tile { width: 2.25rem; height: 2.25rem; border-radius: 9px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .wr-payto-body { padding: 1rem; font-size: .95rem; line-height: 1.65; word-break: break-word; }
        .wr-payto-body.plain { white-space: pre-line; }
        .wr-payto-body p:last-child { margin-bottom: 0; }

        .wr-steps { counter-reset: s; list-style: none; padding: 0; margin: 0 0 1rem; }
        .wr-steps li { counter-increment: s; position: relative; padding-left: 2.1rem; margin-bottom: .55rem; font-size: .9rem; }
        .wr-steps li::before { content: counter(s); position: absolute; left: 0; top: -.05rem; width: 1.5rem; height: 1.5rem; border-radius: 50%;
            background: rgba(var(--tblr-primary-rgb), .1); color: var(--tblr-primary); font-weight: 700; font-size: .78rem;
            display: flex; align-items: center; justify-content: center; }

        .wr-kv { display: flex; justify-content: space-between; gap: 1rem; padding: .55rem 0; border-bottom: 1px solid var(--tblr-border-color); font-size: .875rem; }
        .wr-kv:last-child { border-bottom: 0; }
        .wr-kv > span:first-child { color: var(--tblr-secondary); flex-shrink: 0; }
        .wr-kv > span:last-child { text-align: right; font-weight: 600; min-width: 0; word-break: break-word; }
        .wr-copy { border: 0; background: none; padding: 0 0 0 .35rem; color: var(--tblr-secondary); cursor: pointer; }
        .wr-copy:hover { color: var(--tblr-primary); }

        @media (max-width: 575.98px) {
            .wr-amount { font-size: 2rem; }
            .wr-balance { grid-template-columns: 1fr; }
        }
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
        $i = $withdraw->instructor;
        $st = $statusMeta[$withdraw->status] ?? $statusMeta['pending'];
        $isPending = $withdraw->status === 'pending';
        $info = (string) optional($instructorPayoutInformation)->information;
        $infoIsHtml = $info !== strip_tags($info);
        $infoPlain = trim(html_entity_decode(strip_tags(preg_replace('#<br\s*/?>|</p>|</div>|</li>#i', "\n", $info)), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $gateway = optional($instructorPayoutInformation)->gateway;
        $wallet = (float) optional($i)->wallet;
        $after = round($wallet - (float) $withdraw->amount, 2);
        $short = $isPending && $after < 0;
        $canPay = $isPending && $i && ! $short && $gateway && $info !== '';
        $band = ['pending' => 'var(--tblr-yellow)', 'approved' => 'var(--tblr-green)', 'rejected' => 'var(--tblr-red)'][$withdraw->status] ?? 'var(--tblr-primary)';
    @endphp

    <div class="container-xl mt-4 mb-5">
        {{-- Top bar --}}
        <div class="mb-4">
            @include('admin.partials.back-link', [
                'href' => str_contains(url()->previous(), '/admin/withdraw-request') && url()->previous() !== url()->current() ? url()->previous() : route('admin.withdraw-request.index'),
                'label' => 'Payout requests',
            ])
            <div class="d-flex flex-wrap align-items-center gap-2 mt-1">
                <h2 class="page-title mb-0">Payout to {{ optional($i)->name ?? 'deleted instructor' }}</h2>
                <span class="badge {{ $st[1] }}"><i class="ti {{ $st[2] }}"></i>{{ $st[0] }}</span>
            </div>
            <div class="text-secondary small mt-1">
                Requested {{ optional($withdraw->created_at)->format('d M Y \a\t H:i') }}
                @if ($withdraw->created_at) · {{ $withdraw->created_at->diffForHumans() }} @endif
            </div>
        </div>

        <div class="row g-4">
            {{-- ───────── Main ───────── --}}
            <div class="col-lg-8">
                {{-- Amount + balance --}}
                <div class="card wr-hero mb-4">
                    <div class="wr-hero-band" style="background: {{ $band }};"></div>
                    <div class="card-body">
                        <div class="wr-label">{{ $isPending ? 'Amount to send' : ($withdraw->status === 'approved' ? 'Amount paid' : 'Amount requested') }}</div>
                        <div class="wr-amount">{{ $money($withdraw->amount) }}</div>

                        @if ($isPending && $i)
                            <div class="wr-balance">
                                <div><div class="wr-label">Wallet now</div><div class="v">{{ $money($wallet) }}</div></div>
                                <div><div class="wr-label">Payout</div><div class="v op">− {{ $money($withdraw->amount) }}</div></div>
                                <div class="{{ $short ? 'border-danger' : '' }}">
                                    <div class="wr-label">Balance after</div>
                                    <div class="v {{ $short ? 'text-red' : 'text-green' }}">{{ $money($after) }}</div>
                                </div>
                            </div>
                        @endif

                        @if ($withdraw->status === 'approved')
                            <div class="alert alert-success d-flex gap-2 align-items-start mt-3 mb-0">
                                <i class="ti ti-circle-check mt-1"></i>
                                <div>
                                    Paid on {{ optional($withdraw->updated_at)->format('d M Y, H:i') }} and deducted from the instructor’s wallet.
                                    @if ($withdraw->transaction_id)
                                        <div class="mt-1">Reference: <strong class="font-monospace">{{ $withdraw->transaction_id }}</strong></div>
                                    @endif
                                </div>
                            </div>
                        @elseif ($withdraw->status === 'rejected')
                            <div class="alert alert-danger d-flex gap-2 align-items-start mt-3 mb-0">
                                <i class="ti ti-circle-x mt-1"></i>
                                <div>Rejected on {{ optional($withdraw->updated_at)->format('d M Y, H:i') }}. The instructor’s balance was not changed.</div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Where to send it --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title"><i class="ti ti-send me-2 text-secondary"></i>Send the money to</h3>
                    </div>
                    <div class="card-body">
                        @if ($gateway || $info !== '')
                            <div class="wr-payto">
                                <div class="wr-payto-head">
                                    <span class="wr-gw">
                                        <span class="tile bg-primary-lt"><i class="ti {{ $gatewayIcon($gateway) }}"></i></span>
                                        {{ $gateway ?: 'Unknown gateway' }}
                                    </span>
                                    @if ($infoPlain !== '')
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-copy-text="{{ $infoPlain }}">
                                            <i class="ti ti-copy me-1"></i><span>Copy details</span>
                                        </button>
                                    @endif
                                </div>
                                @if ($infoIsHtml)
                                    <div class="wr-payto-body">{!! $info !!}</div>
                                @else
                                    <div class="wr-payto-body plain">{{ $info !== '' ? $info : 'No details provided.' }}</div>
                                @endif
                            </div>
                        @else
                            <div class="alert alert-warning d-flex gap-2 align-items-start mb-0">
                                <i class="ti ti-alert-triangle mt-1"></i>
                                <div>This instructor hasn’t saved any payout details yet, so there’s nowhere to send the money. Ask them to add them under Withdraw → Request payout.</div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Decide --}}
                @if ($isPending)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="ti ti-checklist me-2 text-secondary"></i>Complete this payout</h3>
                        </div>
                        <div class="card-body">
                            <ol class="wr-steps">
                                <li>Send <strong>{{ $money($withdraw->amount) }}</strong> using the {{ $gateway ?: 'payout' }} details above.</li>
                                <li>Paste the transaction or reference number from your bank or app (recommended).</li>
                                <li>Mark the request as paid. The amount is taken from the instructor’s wallet.</li>
                            </ol>

                            @if ($short)
                                <div class="alert alert-danger d-flex gap-2 align-items-start">
                                    <i class="ti ti-alert-triangle mt-1"></i>
                                    <div>The wallet balance ({{ $money($wallet) }}) is lower than this payout, so it can’t be marked as paid. Reject it instead.</div>
                                </div>
                            @endif

                            <form action="{{ route('admin.withdraw-request.update-status', $withdraw->id) }}" method="POST" id="wr-form">
                                @csrf
                                <input type="hidden" name="status" value="" data-wr-status>
                                <div class="mb-3">
                                    <label class="form-label" for="transaction_id">Transaction reference <span class="text-secondary fw-normal">(optional)</span></label>
                                    <input type="text" id="transaction_id" name="transaction_id" maxlength="255"
                                        class="form-control @error('transaction_id') is-invalid @enderror"
                                        value="{{ old('transaction_id') }}" placeholder="e.g. ABA transaction ID 100FT123456789" @disabled(! $canPay)>
                                    @error('transaction_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    @error('status') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="button" class="btn btn-success flex-grow-1 flex-sm-grow-0" data-wr-action="approved" @disabled(! $canPay)>
                                        <i class="ti ti-circle-check me-1"></i> Mark as paid
                                    </button>
                                    <button type="button" class="btn btn-outline-danger flex-grow-1 flex-sm-grow-0" data-wr-action="rejected">
                                        <i class="ti ti-x me-1"></i> Reject
                                    </button>
                                </div>
                                <div class="small text-secondary mt-2"><i class="ti ti-lock"></i> A decision is final and can’t be changed afterwards.</div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ───────── Side ───────── --}}
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header"><h3 class="card-title"><i class="ti ti-user me-2 text-secondary"></i>Instructor</h3></div>
                    <div class="card-body">
                        @if ($i)
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="avatar avatar-lg rounded-circle" style="background-image: url('{{ $avatarOf($i) }}')"></span>
                                <div class="min-w-0">
                                    <div class="fw-bold text-truncate">{{ $i->name }}</div>
                                    <div class="small text-secondary text-truncate">{{ $i->email }}</div>
                                </div>
                            </div>
                            <div class="wr-kv"><span>Wallet balance</span><span>{{ $money($wallet) }}</span></div>
                            <div class="wr-kv"><span>Paid out so far</span><span>{{ $money($paidTotal) }}</span></div>
                            <div class="wr-kv"><span>Account</span>
                                <span class="{{ $i->account_status === 'disabled' ? 'text-red' : 'text-green' }}">{{ $i->account_status === 'disabled' ? 'Disabled' : 'Active' }}</span>
                            </div>
                            <a href="{{ route('admin.users.instructors', ['search' => $i->email]) }}" class="btn btn-outline-secondary w-100 mt-3">
                                <i class="ti ti-external-link me-1"></i> Open in Instructors
                            </a>
                        @else
                            <div class="text-secondary">This instructor’s account was deleted.</div>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><h3 class="card-title"><i class="ti ti-history me-2 text-secondary"></i>Earlier requests</h3></div>
                    <div class="card-body py-2">
                        @forelse ($history as $h)
                            @php $hs = $statusMeta[$h->status] ?? $statusMeta['pending']; @endphp
                            <a href="{{ route('admin.withdraw-request.show', $h->id) }}" class="wr-kv text-reset text-decoration-none">
                                <span>{{ optional($h->created_at)->format('d M Y') }}</span>
                                <span class="d-inline-flex align-items-center gap-2">{{ $money($h->amount) }}
                                    <span class="badge {{ $hs[1] }}">{{ $hs[0] }}</span></span>
                            </a>
                        @empty
                            <div class="text-secondary small py-2">This is their first payout request.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Confirm dialog --}}
    <div class="modal modal-blur fade" id="wr-confirm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status" data-c-status></div>
                <div class="modal-body text-center py-4">
                    <i class="ti mb-2" style="font-size: 3rem;" data-c-icon></i>
                    <h3 data-c-title></h3>
                    <div class="text-secondary" data-c-text></div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row g-2">
                            <div class="col"><button type="button" class="btn w-100" data-bs-dismiss="modal">Cancel</button></div>
                            <div class="col"><button type="button" class="btn w-100" data-c-ok></button></div>
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
            // Copy payout details
            document.querySelectorAll('[data-copy-text]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    if (!navigator.clipboard) return;
                    navigator.clipboard.writeText(btn.getAttribute('data-copy-text')).then(function () {
                        var label = btn.querySelector('span'), icon = btn.querySelector('.ti');
                        label.textContent = 'Copied'; icon.className = 'ti ti-check me-1 text-green';
                        setTimeout(function () { label.textContent = 'Copy details'; icon.className = 'ti ti-copy me-1'; }, 1600);
                    }).catch(function () {});
                });
            });

            // Confirm before the (final) decision
            var form = document.getElementById('wr-form');
            if (!form) return;
            var modal = document.getElementById('wr-confirm');
            var amount = @json($money($withdraw->amount));
            var name = @json(optional($i)->name ?? 'the instructor');
            var copy = {
                approved: { tone: 'success', icon: 'ti-circle-check', button: 'Yes, mark as paid',
                    title: 'Mark ' + amount + ' as paid?',
                    text: 'Only do this after you have sent the money. ' + amount + ' will be taken from ' + name + '’s wallet.' },
                rejected: { tone: 'danger', icon: 'ti-alert-triangle', button: 'Reject request',
                    title: 'Reject this payout?',
                    text: name + ' keeps their balance and can request again. This can’t be undone.' }
            };
            var chosen = null;
            form.querySelectorAll('[data-wr-action]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    chosen = btn.getAttribute('data-wr-action');
                    var c = copy[chosen];
                    modal.querySelector('[data-c-status]').className = 'modal-status bg-' + c.tone;
                    modal.querySelector('[data-c-icon]').className = 'ti mb-2 text-' + c.tone + ' ' + c.icon;
                    modal.querySelector('[data-c-title]').textContent = c.title;
                    var ref = form.querySelector('#transaction_id');
                    modal.querySelector('[data-c-text]').textContent = c.text +
                        (chosen === 'approved' && ref && ref.value.trim() ? ' Reference: ' + ref.value.trim() + '.' : '');
                    var ok = modal.querySelector('[data-c-ok]');
                    ok.className = 'btn w-100 btn-' + c.tone; ok.disabled = false; ok.textContent = c.button;
                    bootstrap.Modal.getOrCreateInstance(modal).show();
                });
            });
            modal.querySelector('[data-c-ok]').addEventListener('click', function () {
                if (!chosen) return;
                form.querySelector('[data-wr-status]').value = chosen;
                this.disabled = true;
                this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving…';
                form.submit();
            });
        })();
    </script>
@endpush
