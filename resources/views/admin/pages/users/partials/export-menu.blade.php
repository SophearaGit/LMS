{{--
    Export menu for a people list.
    Expects: $noun (plural, e.g. "students"), $excelRoute, $pdfRoute,
             $viewCount (rows in the current filter/search), $allCount, $filter, $search, $filterLabel
--}}
@php
    $hasScope = $filter !== 'all' || $search !== '';
    $viewQuery = http_build_query(array_filter(['filter' => $filter === 'all' ? null : $filter, 'search' => $search ?: null]));
    $startScope = $hasScope ? 'view' : 'all';
    $noun1 = \Illuminate\Support\Str::singular($noun);
@endphp
<div class="dropdown pp-export" data-pp-export data-view-query="{{ $viewQuery }}"
    data-view-count="{{ $viewCount }}" data-all-count="{{ $allCount }}" data-noun="{{ $noun }}" data-noun1="{{ $noun1 }}">
    <button class="btn btn-primary" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
        <i class="ti ti-download me-2"></i> Export <i class="ti ti-chevron-down ms-2 pp-export-caret"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end pp-export-menu p-0">
        <div class="pp-export-head">
            <div class="fw-bold">Export {{ $noun }}</div>
            <div class="text-secondary small">Pick what to include, then a file type.</div>
        </div>

        @if ($hasScope)
            <div class="pp-export-section">
                <div class="pp-export-label">Include</div>
                <div class="pp-seg" role="radiogroup" aria-label="Rows to export">
                    <label class="pp-seg-opt">
                        <input type="radio" name="pp-export-scope" value="view" @checked($startScope === 'view')>
                        <span>
                            <span class="pp-seg-title">This view</span>
                            <span class="pp-seg-sub text-truncate">{{ $filterLabel }}{{ $search !== '' ? ' · “' . $search . '”' : '' }}</span>
                            <span class="pp-seg-count">{{ number_format($viewCount) }}</span>
                        </span>
                    </label>
                    <label class="pp-seg-opt">
                        <input type="radio" name="pp-export-scope" value="all" @checked($startScope === 'all')>
                        <span>
                            <span class="pp-seg-title">Everyone</span>
                            <span class="pp-seg-sub">All {{ $noun }}</span>
                            <span class="pp-seg-count">{{ number_format($allCount) }}</span>
                        </span>
                    </label>
                </div>
            </div>
        @endif

        <div class="pp-export-section pt-2">
            @if ($hasScope)<div class="pp-export-label">Format</div>@endif
            <a href="{{ $excelRoute }}" class="pp-export-item" data-base="{{ $excelRoute }}">
                <span class="pp-export-tile bg-green-lt text-green"><i class="ti ti-table"></i></span>
                <span class="flex-grow-1 min-w-0">
                    <span class="pp-export-title">Excel spreadsheet</span>
                    <span class="pp-export-desc">Sort and filter in Excel or Google Sheets</span>
                </span>
                <span class="pp-export-ext">.xlsx</span>
            </a>
            <a href="{{ $pdfRoute }}" class="pp-export-item" data-base="{{ $pdfRoute }}">
                <span class="pp-export-tile bg-red-lt text-red"><i class="ti ti-file-text"></i></span>
                <span class="flex-grow-1 min-w-0">
                    <span class="pp-export-title">PDF report</span>
                    <span class="pp-export-desc">Print-ready A4 with a summary</span>
                </span>
                <span class="pp-export-ext">.pdf</span>
            </a>
        </div>

        <div class="pp-export-foot">
            <i class="ti ti-info-circle"></i>
            <span data-pp-export-note></span>
        </div>
    </div>
</div>

@once
    @push('stylesheets')
        <style>
            .pp-export-menu { width: 340px; max-width: calc(100vw - 2rem); overflow: hidden; border-radius: 12px; }
            .pp-export .dropdown-toggle::after { display: none; }
            .pp-export-caret { transition: transform .15s; font-size: .9em; }
            .pp-export .show > .pp-export-caret, .pp-export button[aria-expanded="true"] .pp-export-caret { transform: rotate(180deg); }
            .pp-export-head { padding: .9rem 1rem .75rem; border-bottom: 1px solid var(--tblr-border-color); }
            .pp-export-section { padding: .75rem .75rem 0; }
            .pp-export-label {
                font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em;
                color: var(--tblr-secondary); padding: 0 .25rem .4rem;
            }

            .pp-seg { display: grid; grid-template-columns: 1fr 1fr; gap: .5rem; }
            .pp-seg-opt { position: relative; margin: 0; cursor: pointer; min-width: 0; }
            .pp-seg-opt input { position: absolute; opacity: 0; pointer-events: none; }
            .pp-seg-opt > span {
                display: grid; grid-template-columns: 1fr auto; grid-template-areas: "t c" "s c";
                align-items: center; column-gap: .5rem; padding: .55rem .65rem;
                border: 1px solid var(--tblr-border-color); border-radius: 8px; transition: border-color .12s, background .12s;
            }
            .pp-seg-title { grid-area: t; font-weight: 600; font-size: .85rem; }
            .pp-seg-sub { grid-area: s; font-size: .72rem; color: var(--tblr-secondary); min-width: 0; }
            .pp-seg-count {
                grid-area: c; font-weight: 700; font-size: .78rem; font-variant-numeric: tabular-nums;
                background: var(--tblr-bg-surface-secondary, #f1f5f9); border-radius: 6px; padding: .15rem .45rem;
            }
            .pp-seg-opt:hover > span { border-color: var(--tblr-primary); }
            .pp-seg-opt input:checked + span { border-color: var(--tblr-primary); background: rgba(var(--tblr-primary-rgb), .06); box-shadow: 0 0 0 1px var(--tblr-primary) inset; }
            .pp-seg-opt input:checked + span .pp-seg-count { background: var(--tblr-primary); color: #fff; }
            .pp-seg-opt input:focus-visible + span { outline: 2px solid var(--tblr-primary); outline-offset: 2px; }

            .pp-export-item {
                display: flex; align-items: center; gap: .75rem; padding: .6rem .55rem; border-radius: 8px;
                color: inherit; text-decoration: none; transition: background .12s;
            }
            .pp-export-item + .pp-export-item { margin-top: .15rem; }
            .pp-export-item:hover, .pp-export-item:focus-visible { background: var(--tblr-bg-surface-secondary, #f1f5f9); color: inherit; text-decoration: none; }
            .pp-export-tile {
                width: 2.4rem; height: 2.4rem; border-radius: 9px; flex-shrink: 0;
                display: inline-flex; align-items: center; justify-content: center; font-size: 1.25rem;
            }
            .pp-export-title { display: block; font-weight: 600; line-height: 1.25; }
            .pp-export-desc { display: block; font-size: .78rem; color: var(--tblr-secondary); line-height: 1.3; }
            .pp-export-ext {
                font-size: .7rem; font-weight: 700; color: var(--tblr-secondary); letter-spacing: .02em;
                border: 1px solid var(--tblr-border-color); border-radius: 6px; padding: .15rem .4rem; flex-shrink: 0;
            }
            .pp-export-item.is-busy { pointer-events: none; }
            .pp-export-item.is-busy .pp-export-desc { color: var(--tblr-primary); }

            .pp-export-foot {
                display: flex; gap: .4rem; align-items: flex-start; margin-top: .75rem;
                padding: .65rem 1rem; font-size: .75rem; color: var(--tblr-secondary);
                background: var(--tblr-bg-surface-secondary, #f8fafc); border-top: 1px solid var(--tblr-border-color);
            }
            .pp-export-foot .ti { margin-top: .1rem; }
        </style>
    @endpush
    @push('scripts')
        <script>
            document.querySelectorAll('[data-pp-export]').forEach(function (box) {
                var viewQuery = box.getAttribute('data-view-query');
                var counts = { view: +box.getAttribute('data-view-count'), all: +box.getAttribute('data-all-count') };
                var noun = box.getAttribute('data-noun'), noun1 = box.getAttribute('data-noun1');
                var note = box.querySelector('[data-pp-export-note]');
                var items = box.querySelectorAll('.pp-export-item');

                function scope() {
                    var r = box.querySelector('input[name="pp-export-scope"]:checked');
                    return r ? r.value : 'all';
                }
                function refresh() {
                    var s = scope(), n = counts[s];
                    items.forEach(function (a) {
                        var base = a.getAttribute('data-base');
                        a.href = (s === 'view' && viewQuery) ? base + '?' + viewQuery : base;
                    });
                    note.textContent = n === 0
                        ? 'Nothing to export — the file will be empty.'
                        : 'Exports ' + n.toLocaleString() + ' ' + (n === 1 ? noun1 : noun) + ', sorted by name.';
                }
                box.querySelectorAll('input[name="pp-export-scope"]').forEach(function (r) { r.addEventListener('change', refresh); });
                refresh();

                // Feedback while the server builds the file (the page itself stays put).
                items.forEach(function (a) {
                    a.addEventListener('click', function () {
                        var desc = a.querySelector('.pp-export-desc'), ext = a.querySelector('.pp-export-ext');
                        var oldDesc = desc.textContent, oldExt = ext.innerHTML;
                        a.classList.add('is-busy');
                        desc.textContent = 'Preparing your file…';
                        ext.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span>';
                        setTimeout(function () {
                            a.classList.remove('is-busy');
                            desc.textContent = oldDesc;
                            ext.innerHTML = oldExt;
                            var toggle = box.querySelector('[data-bs-toggle="dropdown"]');
                            if (window.bootstrap && toggle) bootstrap.Dropdown.getOrCreateInstance(toggle).hide();
                        }, 2200);
                    });
                });
            });
        </script>
    @endpush
@endonce
