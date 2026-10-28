@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Payment Settings')
@push('stylesheets')
    <style>
        @media (min-width: 1400px) {
            .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl { max-width: 100%; }
        }
        .min-w-0 { min-width: 0; }
        .container-xl .badge { display: inline-flex; align-items: center; gap: .3rem; vertical-align: middle; line-height: 1; padding: .35rem .55rem; font-weight: 600; }
        .container-xl .badge > .ti { font-size: 1.05em; line-height: 1; margin: 0 !important; display: block; }

        /* Gateway picker */
        .ps-nav { display: flex; flex-direction: column; gap: .5rem; }
        .ps-nav-item { display: flex; align-items: center; gap: .8rem; width: 100%; text-align: left; padding: .8rem .9rem;
            border: 1px solid var(--tblr-border-color); border-radius: 12px; background: var(--tblr-bg-surface); color: inherit;
            transition: border-color .15s, box-shadow .15s, background .15s; }
        .ps-nav-item:hover { border-color: rgba(var(--tblr-primary-rgb), .45); }
        .ps-nav-item.active { border-color: var(--tblr-primary); box-shadow: 0 0 0 1px var(--tblr-primary) inset; background: rgba(var(--tblr-primary-rgb), .04); }
        .ps-logo { width: 2.6rem; height: 2.6rem; border-radius: 10px; flex-shrink: 0; display: inline-flex; align-items: center; justify-content: center; font-size: 1.4rem; }
        .ps-nav-name { font-weight: 700; line-height: 1.2; }
        .ps-nav-sub { font-size: .78rem; color: var(--tblr-secondary); }
        .ps-dirty-dot { width: .5rem; height: .5rem; border-radius: 50%; background: var(--tblr-orange); margin-left: auto; flex-shrink: 0; display: none; }
        .ps-nav-item.is-dirty .ps-dirty-dot { display: block; }
        @media (max-width: 991.98px) {
            .ps-nav { flex-direction: row; overflow-x: auto; padding-bottom: .25rem; scroll-snap-type: x mandatory; }
            .ps-nav-item { min-width: 220px; scroll-snap-align: start; }
        }

        /* Panel */
        .ps-section { padding: 1.25rem 1.4rem; border-bottom: 1px solid var(--tblr-border-color); }
        .ps-section:last-of-type { border-bottom: 0; }
        .ps-section-title { display: flex; align-items: center; gap: .5rem; font-weight: 700; margin-bottom: .2rem; }
        .ps-section-title .ti { color: var(--tblr-secondary); }
        .ps-section-desc { font-size: .85rem; color: var(--tblr-secondary); margin-bottom: 1rem; }

        .ps-choice { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: .6rem; max-width: 520px; }
        .ps-choice label { margin: 0; cursor: pointer; }
        .ps-choice input { position: absolute; opacity: 0; pointer-events: none; }
        .ps-choice .opt { display: flex; gap: .6rem; align-items: flex-start; padding: .7rem .8rem; border-radius: 10px; border: 1px solid var(--tblr-border-color); height: 100%; }
        .ps-choice .opt .ti { font-size: 1.25rem; margin-top: .05rem; }
        .ps-choice .opt strong { display: block; font-size: .9rem; }
        .ps-choice .opt small { color: var(--tblr-secondary); font-size: .76rem; line-height: 1.35; display: block; }
        .ps-choice input:checked + .opt { border-color: var(--tblr-primary); box-shadow: 0 0 0 1px var(--tblr-primary) inset; background: rgba(var(--tblr-primary-rgb), .05); }
        .ps-choice input:focus-visible + .opt { outline: 2px solid var(--tblr-primary); outline-offset: 2px; }

        .ps-rate-preview { display: flex; align-items: center; gap: .6rem; margin-top: .75rem; padding: .65rem .85rem; border-radius: 8px;
            background: var(--tblr-bg-surface-secondary, #f8fafc); border: 1px dashed var(--tblr-border-color); font-size: .85rem; }
        .ps-rate-preview strong { font-variant-numeric: tabular-nums; }
        .ps-rate-preview.is-warn { border-color: var(--tblr-orange); color: var(--tblr-orange); }

        .ps-secret-saved { display: flex; align-items: center; justify-content: space-between; gap: .75rem; flex-wrap: wrap; padding: .7rem .85rem;
            border: 1px solid var(--tblr-border-color); border-radius: 8px; background: var(--tblr-bg-surface-secondary, #f8fafc); }
        .ps-secret-saved code { background: none; padding: 0; color: var(--tblr-secondary); }
        .ps-key { font-family: var(--tblr-font-monospace, monospace); font-size: .8rem; }
        textarea.ps-key { min-height: 9rem; resize: vertical; }

        .ps-savebar { position: sticky; bottom: 0; z-index: 5; display: flex; align-items: center; justify-content: space-between; gap: 1rem;
            padding: .85rem 1.4rem; border-top: 1px solid var(--tblr-border-color); background: var(--tblr-bg-surface);
            border-radius: 0 0 var(--tblr-border-radius-lg, 8px) var(--tblr-border-radius-lg, 8px); }
        .ps-savebar .state { font-size: .85rem; color: var(--tblr-secondary); }
        .ps-savebar.is-dirty { box-shadow: 0 -6px 16px rgba(15, 23, 42, .06); }
        .ps-savebar.is-dirty .state { color: var(--tblr-orange); font-weight: 600; }
        @media (max-width: 575.98px) {
            .ps-section, .ps-savebar { padding-left: 1rem; padding-right: 1rem; }
            .ps-choice { grid-template-columns: 1fr; }
            .ps-savebar .btn { flex-grow: 1; }
        }
    </style>
@endpush
@section('content')
    @php
        $g = fn ($k) => config('gateway_setting.' . $k);
        $siteCur = config('settings.site_currency') ?: 'USD';
        // Which panel to open: the one just submitted (validation errors), else ABA.
        $openTab = old('_gateway', 'aba');
        $abaOn = $g('aba_status') === 'active';
        $paypalMode = $g('paypal_mode') ?: 'sandbox';
        $tail = fn ($v) => $v ? '…' . substr(trim((string) $v), -6) : null;
    @endphp

    <div class="container-xl mt-4 mb-5">
        {{-- Page header --}}
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
            <div>
                <div class="text-secondary text-uppercase fw-semibold small mb-1">Payments</div>
                <h2 class="page-title mb-1">Payment Settings</h2>
                <div class="text-secondary">How students pay for courses at checkout. Keys come from each provider’s merchant dashboard.</div>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary"><i class="ti ti-receipt me-1"></i> View orders</a>
        </div>

        <div class="row g-4">
            {{-- Gateway picker --}}
            <div class="col-lg-3">
                <div class="ps-nav" role="tablist" aria-label="Payment gateways">
                    <button type="button" class="ps-nav-item {{ $openTab === 'aba' ? 'active' : '' }}" data-ps-tab="aba" role="tab" aria-selected="{{ $openTab === 'aba' ? 'true' : 'false' }}">
                        <span class="ps-logo bg-azure-lt text-azure"><i class="ti ti-building-bank"></i></span>
                        <span class="min-w-0">
                            <span class="ps-nav-name d-block">ABA PayWay</span>
                            <span class="ps-nav-sub d-block">
                                <span class="badge {{ $abaOn ? 'bg-green-lt' : 'bg-secondary-lt' }}">{{ $abaOn ? 'Active' : 'Inactive' }}</span>
                                {{ $g('aba_currency') }}
                            </span>
                        </span>
                        <span class="ps-dirty-dot" title="Unsaved changes"></span>
                    </button>
                    <button type="button" class="ps-nav-item {{ $openTab === 'paypal' ? 'active' : '' }}" data-ps-tab="paypal" role="tab" aria-selected="{{ $openTab === 'paypal' ? 'true' : 'false' }}">
                        <span class="ps-logo bg-blue-lt text-blue"><i class="ti ti-brand-paypal"></i></span>
                        <span class="min-w-0">
                            <span class="ps-nav-name d-block">PayPal</span>
                            <span class="ps-nav-sub d-block">
                                <span class="badge {{ $paypalMode === 'live' ? 'bg-green-lt' : 'bg-orange-lt' }}">{{ $paypalMode === 'live' ? 'Live' : 'Sandbox (test)' }}</span>
                                {{ $g('paypal_currency') }}
                            </span>
                        </span>
                        <span class="ps-dirty-dot" title="Unsaved changes"></span>
                    </button>
                </div>
                <div class="small text-secondary mt-3 d-none d-lg-block">
                    <i class="ti ti-info-circle"></i> Stripe and Razorpay are switched off at checkout, so they’re not shown here.
                </div>
            </div>

            {{-- Panels --}}
            <div class="col-lg-9">
                {{-- ───────── ABA PayWay ───────── --}}
                <form action="{{ route('admin.payment-settings.aba') }}" method="POST" class="card ps-panel {{ $openTab === 'aba' ? '' : 'd-none' }}" data-ps-panel="aba" novalidate>
                    @csrf
                    <input type="hidden" name="_gateway" value="aba">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">ABA PayWay</h3>
                            <div class="text-secondary small">Students pay with the ABA Mobile app (KHQR / ABA Pay).</div>
                        </div>
                    </div>

                    <div class="ps-section">
                        <div class="ps-section-title"><i class="ti ti-power"></i> Status</div>
                        <div class="ps-section-desc">Turn ABA PayWay on or off for students.</div>
                        <div class="ps-choice" role="radiogroup">
                            <label><input type="radio" name="aba_status" value="active" @checked(old('aba_status', $g('aba_status')) === 'active')>
                                <span class="opt"><i class="ti ti-circle-check text-green"></i><span><strong>Active</strong><small>Accept payments with ABA.</small></span></span></label>
                            <label><input type="radio" name="aba_status" value="inactive" @checked(old('aba_status', $g('aba_status')) !== 'active')>
                                <span class="opt"><i class="ti ti-circle-off text-secondary"></i><span><strong>Inactive</strong><small>Keep the settings, don’t take payments.</small></span></span></label>
                        </div>
                        <x-input-error :messages="$errors->get('aba_status')" class="mt-2" />
                    </div>

                    <div class="ps-section" data-ps-rate data-ps-site="{{ $siteCur }}">
                        <div class="ps-section-title"><i class="ti ti-currency"></i> Currency &amp; conversion</div>
                        <div class="ps-section-desc">Course prices are in {{ $siteCur }}. The rate converts them into the currency ABA charges.</div>
                        <div class="row g-3">
                            <div class="col-sm-5">
                                <label class="form-label required" for="aba_currency">Charge in</label>
                                <select class="form-select" id="aba_currency" name="aba_currency" data-ps-cur>
                                    @foreach (config('gateway_currencies.aba_currencies') as $value)
                                        <option value="{{ $value }}" @selected(old('aba_currency', $g('aba_currency')) === $value)>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('aba_currency')" class="mt-2" />
                            </div>
                            <div class="col-sm-7">
                                <label class="form-label required" for="aba_rate">Exchange rate</label>
                                <div class="input-group">
                                    <span class="input-group-text">1 {{ $siteCur }} =</span>
                                    <input type="number" step="any" min="0" class="form-control" id="aba_rate" name="aba_rate" data-ps-rate-input
                                        value="{{ old('aba_rate', $g('aba_rate')) }}" placeholder="e.g. 4100">
                                    <span class="input-group-text" data-ps-cur-label>{{ old('aba_currency', $g('aba_currency')) }}</span>
                                </div>
                                <x-input-error :messages="$errors->get('aba_rate')" class="mt-2" />
                            </div>
                        </div>
                        <div class="ps-rate-preview" data-ps-preview aria-live="polite"></div>
                    </div>

                    <div class="ps-section">
                        <div class="ps-section-title"><i class="ti ti-key"></i> Merchant credentials</div>
                        <div class="ps-section-desc">From your ABA PayWay merchant account. Keep secret keys private.</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label required" for="aba_merchant_id">Merchant ID</label>
                                <input type="text" class="form-control ps-key" id="aba_merchant_id" name="aba_merchant_id" autocomplete="off"
                                    value="{{ old('aba_merchant_id', $g('aba_merchant_id')) }}" placeholder="e.g. ec000000">
                                <x-input-error :messages="$errors->get('aba_merchant_id')" class="mt-2" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required" for="aba_public_key">API key <span class="text-secondary fw-normal">(public key)</span></label>
                                @include('admin.pages.payment-settings.partials.secret-input', ['name' => 'aba_public_key', 'value' => old('aba_public_key', $g('aba_public_key'))])
                                <x-input-error :messages="$errors->get('aba_public_key')" class="mt-2" />
                            </div>
                            <div class="col-12">
                                <label class="form-label required" for="aba_rsa_public_key">RSA public key</label>
                                <textarea class="form-control ps-key" id="aba_rsa_public_key" name="aba_rsa_public_key" rows="4" spellcheck="false"
                                    placeholder="-----BEGIN PUBLIC KEY----- …">{{ old('aba_rsa_public_key', $g('aba_rsa_public_key')) }}</textarea>
                                <x-input-error :messages="$errors->get('aba_rsa_public_key')" class="mt-2" />
                            </div>
                            <div class="col-12">
                                <label class="form-label required" for="aba_rsa_secret_key">RSA private key</label>
                                @include('admin.pages.payment-settings.partials.secret-textarea', ['name' => 'aba_rsa_secret_key', 'value' => old('aba_rsa_secret_key', $g('aba_rsa_secret_key'))])
                                <x-input-error :messages="$errors->get('aba_rsa_secret_key')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="ps-savebar">
                        <span class="state" data-ps-state>All changes saved</span>
                        <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save ABA settings</button>
                    </div>
                </form>

                {{-- ───────── PayPal ───────── --}}
                <form action="{{ route('admin.payment-settings.paypal') }}" method="POST" class="card ps-panel {{ $openTab === 'paypal' ? '' : 'd-none' }}" data-ps-panel="paypal" novalidate>
                    @csrf
                    <input type="hidden" name="_gateway" value="paypal">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">PayPal</h3>
                            <div class="text-secondary small">Students pay with a PayPal account or card through PayPal.</div>
                        </div>
                    </div>

                    <div class="ps-section">
                        <div class="ps-section-title"><i class="ti ti-flask"></i> Mode</div>
                        <div class="ps-section-desc">Use Sandbox while testing; switch to Live to take real money.</div>
                        <div class="ps-choice" role="radiogroup">
                            <label><input type="radio" name="paypal_mode" value="sandbox" @checked(old('paypal_mode', $paypalMode) === 'sandbox')>
                                <span class="opt"><i class="ti ti-flask text-orange"></i><span><strong>Sandbox</strong><small>Test payments, no real money.</small></span></span></label>
                            <label><input type="radio" name="paypal_mode" value="live" @checked(old('paypal_mode', $paypalMode) === 'live')>
                                <span class="opt"><i class="ti ti-bolt text-green"></i><span><strong>Live</strong><small>Real payments from students.</small></span></span></label>
                        </div>
                        <x-input-error :messages="$errors->get('paypal_mode')" class="mt-2" />
                    </div>

                    <div class="ps-section" data-ps-rate data-ps-site="{{ $siteCur }}">
                        <div class="ps-section-title"><i class="ti ti-currency"></i> Currency &amp; conversion</div>
                        <div class="ps-section-desc">Course prices are in {{ $siteCur }}. The rate converts them into the currency PayPal charges.</div>
                        <div class="row g-3">
                            <div class="col-sm-5">
                                <label class="form-label required" for="paypal_currency">Charge in</label>
                                <select class="form-select" id="paypal_currency" name="paypal_currency" data-ps-cur>
                                    @foreach (config('gateway_currencies.paypal_currencies') as $value)
                                        <option value="{{ $value['code'] }}" @selected(old('paypal_currency', $g('paypal_currency')) === $value['code'])>
                                            {{ $value['code'] }} — {{ $value['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('paypal_currency')" class="mt-2" />
                            </div>
                            <div class="col-sm-7">
                                <label class="form-label required" for="paypal_rate">Exchange rate</label>
                                <div class="input-group">
                                    <span class="input-group-text">1 {{ $siteCur }} =</span>
                                    <input type="number" step="any" min="0" class="form-control" id="paypal_rate" name="paypal_rate" data-ps-rate-input
                                        value="{{ old('paypal_rate', $g('paypal_rate')) }}" placeholder="e.g. 1">
                                    <span class="input-group-text" data-ps-cur-label>{{ old('paypal_currency', $g('paypal_currency')) }}</span>
                                </div>
                                <x-input-error :messages="$errors->get('paypal_rate')" class="mt-2" />
                            </div>
                        </div>
                        <div class="ps-rate-preview" data-ps-preview aria-live="polite"></div>
                    </div>

                    <div class="ps-section">
                        <div class="ps-section-title"><i class="ti ti-key"></i> App credentials</div>
                        <div class="ps-section-desc">From developer.paypal.com → Apps &amp; Credentials. Use the keys that match the mode above.</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label required" for="paypal_live_client_id">Client ID</label>
                                <input type="text" class="form-control ps-key" id="paypal_live_client_id" name="paypal_live_client_id" autocomplete="off"
                                    value="{{ old('paypal_live_client_id', $g('paypal_live_client_id')) }}" placeholder="A…">
                                <x-input-error :messages="$errors->get('paypal_live_client_id')" class="mt-2" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required" for="paypal_live_app_id">App ID</label>
                                <input type="text" class="form-control ps-key" id="paypal_live_app_id" name="paypal_live_app_id" autocomplete="off"
                                    value="{{ old('paypal_live_app_id', $g('paypal_live_app_id')) }}" placeholder="APP-…">
                                <x-input-error :messages="$errors->get('paypal_live_app_id')" class="mt-2" />
                            </div>
                            <div class="col-12">
                                <label class="form-label required" for="paypal_live_client_secret">Client secret</label>
                                @include('admin.pages.payment-settings.partials.secret-input', ['name' => 'paypal_live_client_secret', 'value' => old('paypal_live_client_secret', $g('paypal_live_client_secret'))])
                                <x-input-error :messages="$errors->get('paypal_live_client_secret')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="ps-savebar">
                        <span class="state" data-ps-state>All changes saved</span>
                        <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> Save PayPal settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        (function () {
            var tabs = document.querySelectorAll('[data-ps-tab]');
            var panels = document.querySelectorAll('[data-ps-panel]');

            // ── Switch gateway (remembers the choice in the URL hash) ──
            function show(name, push) {
                tabs.forEach(function (t) {
                    var on = t.getAttribute('data-ps-tab') === name;
                    t.classList.toggle('active', on);
                    t.setAttribute('aria-selected', on ? 'true' : 'false');
                });
                panels.forEach(function (p) { p.classList.toggle('d-none', p.getAttribute('data-ps-panel') !== name); });
                if (push) history.replaceState(null, '', '#' + name);
            }
            tabs.forEach(function (t) { t.addEventListener('click', function () { show(t.getAttribute('data-ps-tab'), true); }); });
            // Reopen the panel from the URL hash, or the one that was just saved.
            var saved = null;
            try { saved = sessionStorage.getItem('ps-last-tab'); sessionStorage.removeItem('ps-last-tab'); } catch (e) {}
            var want = location.hash.replace('#', '') || saved;
            if (want && document.querySelector('[data-ps-panel="' + want + '"]') && !@json($errors->any())) show(want, false);

            // ── Show / hide secrets ──
            document.querySelectorAll('[data-ps-reveal]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var input = document.getElementById(btn.getAttribute('data-ps-reveal'));
                    var hidden = input.type === 'password';
                    input.type = hidden ? 'text' : 'password';
                    btn.querySelector('.ti').className = 'ti ' + (hidden ? 'ti-eye-off' : 'ti-eye');
                    btn.setAttribute('aria-label', hidden ? 'Hide value' : 'Show value');
                });
            });
            document.querySelectorAll('[data-ps-unlock]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var box = document.getElementById(btn.getAttribute('data-ps-unlock'));
                    var saved = box.querySelector('[data-ps-saved]');
                    var area = box.querySelector('textarea');
                    saved.classList.add('d-none');
                    area.classList.remove('d-none');
                    if (btn.getAttribute('data-mode') === 'replace') { area.value = ''; area.dispatchEvent(new Event('input', { bubbles: true })); }
                    area.focus();
                });
            });

            // ── Exchange-rate preview ──
            document.querySelectorAll('[data-ps-rate]').forEach(function (sec) {
                var site = sec.getAttribute('data-ps-site');
                var cur = sec.querySelector('[data-ps-cur]');
                var rate = sec.querySelector('[data-ps-rate-input]');
                var label = sec.querySelector('[data-ps-cur-label]');
                var out = sec.querySelector('[data-ps-preview]');
                function fmt(n, c) {
                    try { return new Intl.NumberFormat(undefined, { style: 'currency', currency: c, maximumFractionDigits: c === 'KHR' ? 0 : 2 }).format(n); }
                    catch (e) { return n.toFixed(2) + ' ' + c; }
                }
                function update() {
                    var c = cur.value, r = parseFloat(rate.value);
                    label.textContent = c;
                    if (!(r > 0)) {
                        out.className = 'ps-rate-preview is-warn';
                        out.innerHTML = '<i class="ti ti-alert-triangle"></i><span>Enter a rate above 0.</span>';
                        return;
                    }
                    var warn = (c === 'KHR' && site !== 'KHR' && r < 100) || (c !== site && r === 1);
                    out.className = 'ps-rate-preview' + (warn ? ' is-warn' : '');
                    out.innerHTML = '<i class="ti ' + (warn ? 'ti-alert-triangle' : 'ti-calculator') + '"></i><span>' +
                        'A course priced <strong>' + fmt(10, site) + '</strong> is charged <strong>' + fmt(10 * r, c) + '</strong>.' +
                        (warn ? ' This rate looks wrong. 1 ' + site + ' is about ' + (c === 'KHR' ? '4,100' : 'a different amount of') + ' ' + c + '.' : '') + '</span>';
                }
                cur.addEventListener('change', update);
                rate.addEventListener('input', update);
                update();
            });

            // ── Unsaved-changes tracking ──
            var dirtyForms = new Set();
            panels.forEach(function (form) {
                var name = form.getAttribute('data-ps-panel');
                var tab = document.querySelector('[data-ps-tab="' + name + '"]');
                var bar = form.querySelector('.ps-savebar');
                var state = form.querySelector('[data-ps-state]');
                var initial = new URLSearchParams(new FormData(form)).toString();
                function check() {
                    var dirty = new URLSearchParams(new FormData(form)).toString() !== initial;
                    dirty ? dirtyForms.add(name) : dirtyForms.delete(name);
                    tab.classList.toggle('is-dirty', dirty);
                    bar.classList.toggle('is-dirty', dirty);
                    state.innerHTML = dirty ? '<i class="ti ti-point-filled"></i> Unsaved changes' : 'All changes saved';
                }
                form.addEventListener('input', check);
                form.addEventListener('change', check);
                form.addEventListener('submit', function () {
                    dirtyForms.delete(name);
                    try { sessionStorage.setItem('ps-last-tab', name); } catch (e) {}
                    var b = form.querySelector('[type=submit]');
                    b.disabled = true;
                    b.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving…';
                });
            });
            window.addEventListener('beforeunload', function (e) {
                if (dirtyForms.size) { e.preventDefault(); e.returnValue = ''; }
            });
        })();
    </script>
@endpush
