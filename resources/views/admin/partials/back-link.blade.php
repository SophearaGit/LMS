{{--
    Back button used at the top of detail pages.
    Expects: $href (where to go), $label (e.g. "Payout requests").
    Optional: $section (small text above the label, e.g. "Back to").
--}}
<a href="{{ $href }}" class="back-link d-print-none" aria-label="Back to {{ strtolower($label) }}">
    <span class="back-link-arrow" aria-hidden="true"><i class="ti ti-arrow-left"></i></span>
    <span class="back-link-text">
        <span class="back-link-kicker">{{ $section ?? 'Back to' }}</span>
        <span class="back-link-label">{{ $label }}</span>
    </span>
</a>

@once
    @push('stylesheets')
        <style>
            .back-link {
                display: inline-flex; align-items: center; gap: .65rem;
                padding: .3rem .95rem .3rem .3rem; margin-bottom: .9rem;
                border: 1px solid var(--tblr-border-color); border-radius: 999px;
                background: var(--tblr-bg-surface); color: var(--tblr-body-color);
                text-decoration: none; line-height: 1.15;
                box-shadow: 0 1px 2px rgba(15, 23, 42, .04);
                transition: border-color .15s, box-shadow .15s, color .15s, background .15s;
            }
            .back-link:hover, .back-link:focus-visible {
                color: var(--tblr-primary); text-decoration: none;
                border-color: rgba(var(--tblr-primary-rgb), .45);
                background: rgba(var(--tblr-primary-rgb), .04);
                box-shadow: 0 3px 10px rgba(var(--tblr-primary-rgb), .12);
            }
            .back-link:focus-visible { outline: 2px solid var(--tblr-primary); outline-offset: 2px; }
            .back-link-arrow {
                width: 2rem; height: 2rem; border-radius: 50%; flex-shrink: 0;
                display: inline-flex; align-items: center; justify-content: center;
                background: rgba(var(--tblr-primary-rgb), .1); color: var(--tblr-primary);
                transition: transform .18s ease, background .15s, color .15s;
            }
            .back-link-arrow .ti { font-size: 1.05rem !important; line-height: 1; }
            .back-link:hover .back-link-arrow, .back-link:focus-visible .back-link-arrow {
                background: var(--tblr-primary); color: #fff; transform: translateX(-3px);
            }
            .back-link-text { display: flex; flex-direction: column; }
            .back-link-kicker { font-size: .66rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--tblr-secondary); }
            .back-link-label { font-size: .875rem; font-weight: 600; }
            @media (prefers-reduced-motion: reduce) { .back-link, .back-link-arrow { transition: none; } }
        </style>
    @endpush
@endonce
