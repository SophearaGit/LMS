@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Payout Gateways')
@push('stylesheets')
    @include('admin.pages.users.partials.people-styles')
    <style>
        .pg-stat { display: flex; align-items: center; gap: .75rem; padding: .85rem 1rem; height: 100%;
            border: 1px solid var(--tblr-border-color); border-radius: var(--tblr-border-radius-lg, 8px); background: var(--tblr-bg-surface); }
        .pg-stat .pp-filter-icon { width: 2.25rem; height: 2.25rem; font-size: 1.2rem; }
        .pg-stat .n { font-size: 1.35rem; font-weight: 700; line-height: 1.1; font-variant-numeric: tabular-nums; }
        .pg-stat .l { font-size: .8rem; color: var(--tblr-secondary); }

        .pg-card { display: flex; flex-direction: column; height: 100%; border: 1px solid var(--tblr-border-color);
            border-radius: 12px; background: var(--tblr-bg-surface); transition: border-color .15s, box-shadow .15s; }
        .pg-card:hover { border-color: rgba(var(--tblr-primary-rgb), .45); box-shadow: 0 4px 14px rgba(0,0,0,.05); }
        .pg-card.is-off { background: var(--tblr-bg-surface-secondary, #f8fafc); }
        .pg-card.is-off .pg-fade { opacity: .6; }
        .pg-card-top { display: flex; align-items: flex-start; gap: .85rem; padding: 1.1rem 1.1rem .85rem; }
        .pg-logo { width: 2.75rem; height: 2.75rem; border-radius: 12px; flex-shrink: 0; display: inline-flex;
            align-items: center; justify-content: center; font-size: 1.5rem; }
        .pg-name { font-weight: 700; font-size: 1.05rem; line-height: 1.2; word-break: break-word; }
        .pg-body { padding: 0 1.1rem 1rem; flex-grow: 1; }
        .pg-label { font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--tblr-secondary); margin-bottom: .3rem; }
        .pg-instructions { font-size: .875rem; color: var(--tblr-body-color); line-height: 1.5;
            display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
            padding: .6rem .75rem; border-radius: 8px; background: var(--tblr-bg-surface-secondary, #f8fafc); border: 1px dashed var(--tblr-border-color); }
        .pg-card.is-off .pg-instructions { background: var(--tblr-bg-surface); }
        .pg-foot { display: flex; align-items: center; justify-content: space-between; gap: .5rem;
            padding: .75rem 1.1rem; border-top: 1px solid var(--tblr-border-color); }
        .pg-usage { font-size: .82rem; color: var(--tblr-secondary); display: inline-flex; align-items: center; gap: .35rem; }
        .pg-usage strong { color: var(--tblr-body-color); }

        .pg-add { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: .4rem; height: 100%;
            min-height: 220px; border: 2px dashed var(--tblr-border-color); border-radius: 12px; color: var(--tblr-secondary);
            background: transparent; width: 100%; transition: border-color .15s, color .15s, background .15s; }
        .pg-add:hover { border-color: var(--tblr-primary); color: var(--tblr-primary); background: rgba(var(--tblr-primary-rgb), .03); }
        .pg-add .ti { font-size: 2rem; }

        .pg-switch { margin: 0; }
        .pg-switch .form-check-input { cursor: pointer; width: 2.25rem; height: 1.25rem; margin: 0; }

        #pg-form-modal .form-hint { font-size: .8rem; }
        .pg-status-choice { display: grid; grid-template-columns: 1fr 1fr; gap: .5rem; }
        .pg-status-choice label { margin: 0; cursor: pointer; }
        .pg-status-choice input { position: absolute; opacity: 0; pointer-events: none; }
        .pg-status-choice span { display: flex; align-items: center; gap: .5rem; padding: .6rem .75rem; border-radius: 8px;
            border: 1px solid var(--tblr-border-color); font-weight: 600; font-size: .875rem; }
        .pg-status-choice input:checked + span { border-color: var(--tblr-primary); box-shadow: 0 0 0 1px var(--tblr-primary) inset; background: rgba(var(--tblr-primary-rgb), .05); }
        .pg-status-choice input:focus-visible + span { outline: 2px solid var(--tblr-primary); outline-offset: 2px; }
    </style>
@endpush
@section('content')
    @php
        $brand = function ($name) {
            $n = strtolower($name);
            return match (true) {
                str_contains($n, 'aba')      => ['ti-building-bank', 'azure'],
                str_contains($n, 'paypal')   => ['ti-brand-paypal', 'blue'],
                str_contains($n, 'stripe')   => ['ti-brand-stripe', 'purple'],
                str_contains($n, 'razorpay') => ['ti-credit-card', 'indigo'],
                str_contains($n, 'bank')     => ['ti-building-bank', 'teal'],
                str_contains($n, 'wing') || str_contains($n, 'cash') => ['ti-cash', 'green'],
                default                      => ['ti-wallet', 'secondary'],
            };
        };
        $plain = fn ($html) => trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags(str_replace(['<br>', '<br/>', '<br />', '</p>'], ' ', (string) $html)))));
        $total = $payoutGateways->count();

        // Reopen the right dialog after a failed save.
        $reopen = $errors->any() ? session('gateway_form') : null;
        if (! $reopen && $openAdd) $reopen = 'add';
        if (! $reopen && $openEdit && $payoutGateways->firstWhere('id', $openEdit)) $reopen = 'edit-' . $openEdit;
    @endphp

    <div class="container-xl mt-4 mb-5">
        {{-- Page header --}}
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
            <div>
                <div class="text-secondary text-uppercase fw-semibold small mb-1">Payments</div>
                <h2 class="page-title mb-1">Payout Gateways</h2>
                <div class="text-secondary">How you pay instructors. Active gateways show up in each instructor’s payout settings.</div>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.withdraw-request.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-cash me-1"></i> Payout requests
                </a>
                <button type="button" class="btn btn-primary" data-pg-open="add">
                    <i class="ti ti-plus me-1"></i> Add gateway
                </button>
            </div>
        </div>

        {{-- Summary --}}
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-4">
                <div class="pg-stat">
                    <span class="pp-filter-icon bg-green-lt"><i class="ti ti-circle-check"></i></span>
                    <div><div class="n">{{ $activeCount }}</div><div class="l">Active — instructors can choose</div></div>
                </div>
            </div>
            <div class="col-6 col-sm-4">
                <div class="pg-stat">
                    <span class="pp-filter-icon bg-secondary-lt"><i class="ti ti-eye-off"></i></span>
                    <div><div class="n">{{ $total - $activeCount }}</div><div class="l">Hidden</div></div>
                </div>
            </div>
            <div class="col-6 col-sm-4">
                <div class="pg-stat">
                    <span class="pp-filter-icon bg-purple-lt"><i class="ti ti-users"></i></span>
                    <div><div class="n">{{ $instructorsSet }}</div><div class="l">Instructors set up</div></div>
                </div>
            </div>
        </div>

        @if ($total && ! $activeCount)
            <div class="alert alert-warning d-flex align-items-start gap-2 mb-4" role="alert">
                <i class="ti ti-alert-triangle mt-1"></i>
                <div>No gateway is active, so instructors can’t add payout details or request withdrawals. Turn at least one on.</div>
            </div>
        @endif

        @if (! $total)
            <div class="card">
                <div class="pp-empty">
                    <div class="pp-empty-icon bg-primary-lt"><i class="ti ti-wallet"></i></div>
                    <h3 class="mb-1">No payout gateways yet</h3>
                    <p class="text-secondary mb-3">Add the ways you pay instructors, such as ABA, bank transfer or PayPal.</p>
                    <button type="button" class="btn btn-primary" data-pg-open="add"><i class="ti ti-plus me-1"></i> Add your first gateway</button>
                </div>
            </div>
        @else
            <div class="row g-3">
                @foreach ($payoutGateways as $g)
                    @php
                        [$icon, $tone] = $brand($g->name);
                        $on = (string) $g->status === '1';
                        $users = (int) ($usage[$g->name] ?? 0);
                        $preview = $plain($g->description);
                    @endphp
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="pg-card {{ $on ? '' : 'is-off' }}">
                            <div class="pg-card-top">
                                <span class="pg-logo bg-{{ $tone }}-lt pg-fade"><i class="ti {{ $icon }}"></i></span>
                                <div class="flex-grow-1 min-w-0 pg-fade">
                                    <div class="pg-name">{{ $g->name }}</div>
                                    <span class="badge {{ $on ? 'bg-green-lt' : 'bg-secondary-lt' }} mt-1">
                                        <i class="ti {{ $on ? 'ti-circle-check' : 'ti-eye-off' }}"></i>{{ $on ? 'Active' : 'Hidden' }}
                                    </span>
                                </div>
                                <form action="{{ route('admin.payout-gateways.toggle', $g->id) }}" method="POST" class="pg-switch form-check form-switch" data-pg-toggle
                                    data-name="{{ $g->name }}" data-users="{{ $users }}" data-on="{{ $on ? 1 : 0 }}">
                                    @csrf
                                    @method('PATCH')
                                    <input class="form-check-input" type="checkbox" role="switch" @checked($on)
                                        aria-label="{{ $on ? 'Hide' : 'Activate' }} {{ $g->name }}" title="{{ $on ? 'Hide from instructors' : 'Make available to instructors' }}">
                                </form>
                            </div>
                            <div class="pg-body pg-fade">
                                <div class="pg-label">What instructors are asked for</div>
                                <div class="pg-instructions" title="{{ $preview }}">{{ $preview ?: 'No instructions yet.' }}</div>
                            </div>
                            <div class="pg-foot">
                                <span class="pg-usage">
                                    <i class="ti ti-users"></i>
                                    @if ($users) <strong>{{ $users }}</strong> {{ \Illuminate\Support\Str::plural('instructor', $users) }} use this
                                    @else Not used yet @endif
                                </span>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-sm btn-ghost-primary" data-pg-open="edit-{{ $g->id }}"
                                        data-id="{{ $g->id }}" data-name="{{ $g->name }}" data-description="{{ $g->description }}"
                                        data-status="{{ $on ? 1 : 0 }}" data-users="{{ $users }}"
                                        data-action="{{ route('admin.payout-gateways.update', $g->id) }}">
                                        <i class="ti ti-pencil me-1"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-ghost-danger btn-icon" data-pg-delete
                                        data-name="{{ $g->name }}" data-users="{{ $users }}"
                                        data-action="{{ route('admin.payout-gateways.destroy', $g->id) }}"
                                        title="Delete {{ $g->name }}" aria-label="Delete {{ $g->name }}">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 col-md-6 col-xl-4">
                    <button type="button" class="pg-add" data-pg-open="add">
                        <i class="ti ti-circle-plus"></i>
                        <span class="fw-semibold">Add a gateway</span>
                        <span class="small">Bank transfer, ABA, Wing, PayPal…</span>
                    </button>
                </div>
            </div>
        @endif
    </div>

    {{-- Add / edit dialog --}}
    <div class="modal modal-blur fade" id="pg-form-modal" tabindex="-1" aria-hidden="true" aria-labelledby="pg-form-title">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" action="{{ route('admin.payout-gateways.store') }}" data-pg-form
                data-store="{{ route('admin.payout-gateways.store') }}">
                @csrf
                <input type="hidden" name="_method" value="POST" data-pg-method>
                <div class="modal-header">
                    <h5 class="modal-title" id="pg-form-title" data-pg-title>Add payout gateway</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required" for="pg-name">Name</label>
                        <input type="text" id="pg-name" name="name" maxlength="255" required
                            class="form-control @error('name') is-invalid @enderror" placeholder="e.g. ABA Bank, Wing, PayPal"
                            value="{{ old('name') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-hint mt-1 d-none text-warning" data-pg-rename-hint>
                            <i class="ti ti-info-circle"></i> Renaming keeps the <span data-pg-users></span> linked to it.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required" for="pg-description">Instructions for instructors</label>
                        <textarea id="pg-description" name="description" rows="5" maxlength="2000" required
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="e.g. Account name, account number and bank branch.">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="d-flex justify-content-between form-hint mt-1 text-secondary">
                            <span>Shown to instructors when they enter their payout details.</span>
                            <span data-pg-count>0 / 2000</span>
                        </div>
                    </div>
                    <div>
                        <div class="form-label">Availability</div>
                        <div class="pg-status-choice" role="radiogroup">
                            <label>
                                <input type="radio" name="status" value="1" @checked(old('status', '1') == '1')>
                                <span><i class="ti ti-circle-check text-green"></i> Active</span>
                            </label>
                            <label>
                                <input type="radio" name="status" value="0" @checked(old('status') === '0')>
                                <span><i class="ti ti-eye-off text-secondary"></i> Hidden</span>
                            </label>
                        </div>
                        @error('status') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" data-pg-submit>Add gateway</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Confirm dialog (delete / hide) --}}
    <div class="modal modal-blur fade" id="pg-confirm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status" data-pgc-status></div>
                <div class="modal-body text-center py-4">
                    <i class="ti mb-2" style="font-size: 3rem;" data-pgc-icon></i>
                    <h3 data-pgc-title></h3>
                    <div class="text-secondary" data-pgc-text></div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row g-2">
                            <div class="col"><button type="button" class="btn w-100" data-bs-dismiss="modal">Cancel</button></div>
                            <div class="col"><button type="button" class="btn w-100" data-pgc-ok></button></div>
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
            var formModal = document.getElementById('pg-form-modal');
            var form = formModal.querySelector('[data-pg-form]');
            var nameInput = form.querySelector('#pg-name');
            var desc = form.querySelector('#pg-description');
            var count = form.querySelector('[data-pg-count]');
            var hint = form.querySelector('[data-pg-rename-hint]');
            var originalName = '';
            var plural = function (n, w) { return n + ' ' + w + (n === 1 ? '' : 's'); };

            function updateCount() { count.textContent = desc.value.length + ' / 2000'; }
            desc.addEventListener('input', updateCount);
            nameInput.addEventListener('input', function () {
                hint.classList.toggle('d-none', !(originalName && nameInput.value.trim() !== originalName && +hint.getAttribute('data-users') > 0));
            });

            function clearErrors() {
                form.querySelectorAll('.is-invalid').forEach(function (el) { el.classList.remove('is-invalid'); });
                form.querySelectorAll('.invalid-feedback').forEach(function (el) { el.remove(); });
            }
            function setStatus(v) { form.querySelector('input[name=status][value="' + v + '"]').checked = true; }

            function openAdd(keepValues) {
                if (!keepValues) { clearErrors(); nameInput.value = ''; desc.value = ''; setStatus('1'); }
                form.action = form.getAttribute('data-store');
                form.querySelector('[data-pg-method]').value = 'POST';
                form.querySelector('[data-pg-title]').textContent = 'Add payout gateway';
                form.querySelector('[data-pg-submit]').textContent = 'Add gateway';
                originalName = ''; hint.classList.add('d-none');
                updateCount();
                bootstrap.Modal.getOrCreateInstance(formModal).show();
            }
            function openEdit(btn, keepValues) {
                if (!keepValues) {
                    clearErrors();
                    nameInput.value = btn.getAttribute('data-name');
                    desc.value = btn.getAttribute('data-description');
                    setStatus(btn.getAttribute('data-status'));
                }
                form.action = btn.getAttribute('data-action');
                form.querySelector('[data-pg-method]').value = 'PUT';
                form.querySelector('[data-pg-title]').textContent = 'Edit ' + btn.getAttribute('data-name');
                form.querySelector('[data-pg-submit]').textContent = 'Save changes';
                originalName = btn.getAttribute('data-name');
                var users = +btn.getAttribute('data-users');
                hint.setAttribute('data-users', users);
                hint.querySelector('[data-pg-users]').textContent = plural(users, 'instructor');
                hint.classList.add('d-none');
                updateCount();
                bootstrap.Modal.getOrCreateInstance(formModal).show();
            }

            document.querySelectorAll('[data-pg-open]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    btn.getAttribute('data-pg-open') === 'add' ? openAdd(false) : openEdit(btn, false);
                });
            });
            formModal.addEventListener('shown.bs.modal', function () { nameInput.focus(); });
            form.addEventListener('submit', function () {
                var b = form.querySelector('[data-pg-submit]');
                b.disabled = true;
                b.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving…';
            });

            // ── Generic confirm ──
            var confirmEl = document.getElementById('pg-confirm');
            var onOk = null;
            function ask(o) {
                confirmEl.querySelector('[data-pgc-status]').className = 'modal-status bg-' + o.tone;
                confirmEl.querySelector('[data-pgc-icon]').className = 'ti mb-2 text-' + o.tone + ' ' + o.icon;
                confirmEl.querySelector('[data-pgc-title]').textContent = o.title;
                confirmEl.querySelector('[data-pgc-text]').textContent = o.text;
                var ok = confirmEl.querySelector('[data-pgc-ok]');
                ok.className = 'btn w-100 btn-' + o.tone; ok.disabled = false; ok.textContent = o.button;
                onOk = o.run;
                bootstrap.Modal.getOrCreateInstance(confirmEl).show();
            }
            confirmEl.querySelector('[data-pgc-ok]').addEventListener('click', function () {
                if (!onOk) return;
                this.disabled = true;
                this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Working…';
                onOk();
            });

            // ── Active / hidden switch ──
            document.querySelectorAll('[data-pg-toggle]').forEach(function (f) {
                var input = f.querySelector('input[type=checkbox]');
                input.addEventListener('change', function () {
                    var users = +f.getAttribute('data-users'), name = f.getAttribute('data-name');
                    if (f.getAttribute('data-on') === '1' && users > 0) {
                        input.checked = true;
                        ask({
                            tone: 'warning', icon: 'ti-eye-off', button: 'Hide gateway',
                            title: 'Hide ' + name + '?',
                            text: plural(users, 'instructor') + ' currently use ' + name + '. They keep their saved details, but nobody can choose it until you turn it back on.',
                            run: function () { input.disabled = true; f.submit(); }
                        });
                        return;
                    }
                    input.disabled = true;
                    f.submit();
                });
            });

            // ── Delete ──
            document.querySelectorAll('[data-pg-delete]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var users = +btn.getAttribute('data-users'), name = btn.getAttribute('data-name');
                    ask({
                        tone: 'danger', icon: 'ti-alert-triangle', button: 'Delete',
                        title: 'Delete ' + name + '?',
                        text: users > 0
                            ? plural(users, 'instructor') + ' have ' + name + ' as their payout method and will need to choose another one. Consider hiding it instead.'
                            : 'This removes ' + name + ' permanently. It can’t be undone.',
                        run: function () {
                            fetch(btn.getAttribute('data-action'), {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf_token]').content,
                                    'Accept': 'application/json'
                                }
                            }).then(function (r) {
                                if (!r.ok) throw new Error();
                                window.location.reload();
                            }).catch(function () {
                                bootstrap.Modal.getOrCreateInstance(confirmEl).hide();
                                if (window.notyf) { notyf.error('Could not delete ' + name + '. Please try again.'); }
                            });
                        }
                    });
                });
            });

            // ── Reopen after validation error or ?add / ?edit= links ──
            var reopen = @json($reopen);
            if (reopen) {
                // Bootstrap (tabler.min.js) is deferred, so wait until it has loaded.
                document.addEventListener('DOMContentLoaded', function () {
                    var keep = @json($errors->any());
                    if (reopen === 'add') openAdd(keep);
                    else {
                        var b = document.querySelector('[data-pg-open="' + reopen + '"]');
                        if (b) openEdit(b, keep);
                    }
                });
            }
        })();
    </script>
@endpush
