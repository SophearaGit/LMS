{{-- Shared look for the Users, Instructors and Students pages --}}
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

    .pp-filter {
        display: block; height: 100%; color: inherit; text-decoration: none;
        border: 1px solid var(--tblr-border-color); border-radius: var(--tblr-border-radius-lg, 8px);
        background: var(--tblr-bg-surface); padding: 1rem 1.1rem; position: relative; overflow: hidden;
        transition: border-color .15s, transform .15s;
    }
    .pp-filter:hover { color: inherit; text-decoration: none; border-color: var(--pp-accent); transform: translateY(-1px); }
    .pp-filter.is-active { border-color: var(--pp-accent); box-shadow: 0 0 0 1px var(--pp-accent) inset; }
    .pp-filter.is-active::before { content: ""; position: absolute; inset: 0 0 auto 0; height: 3px; background: var(--pp-accent); }
    .pp-filter-icon {
        width: 2.5rem; height: 2.5rem; border-radius: 10px; display: inline-flex; align-items: center;
        justify-content: center; font-size: 1.35rem; flex-shrink: 0;
    }
    .pp-filter-count { font-size: 1.6rem; font-weight: 700; line-height: 1.1; font-variant-numeric: tabular-nums; }
    .pp-filter-label { color: var(--tblr-secondary); font-size: .85rem; }

    .pp-table td { padding-top: .85rem; padding-bottom: .85rem; }
    .pp-table tbody tr:hover { background: var(--tblr-bg-surface-secondary, rgba(0,0,0,.02)); }
    .pp-table tr.is-disabled td:not(.pp-keep) { opacity: .55; }
    .pp-name { font-weight: 600; }
    .pp-email { word-break: break-all; }
    .pp-dot { width: .5rem; height: .5rem; border-radius: 50%; display: inline-block; margin-right: .4rem; }
    .pp-num { font-weight: 600; font-variant-numeric: tabular-nums; }

    .pp-card { border: 1px solid var(--tblr-border-color); border-radius: 10px; padding: 1rem; background: var(--tblr-bg-surface); height: 100%; }
    .pp-card.is-disabled { background: var(--tblr-bg-surface-secondary, rgba(0,0,0,.02)); }
    .pp-card.is-disabled .pp-fade { opacity: .55; }
    .pp-list-cards .pp-card + .pp-card { margin-top: .75rem; }
    .pp-meta { font-size: .85rem; color: var(--tblr-secondary); }
    .pp-stats { display: grid; grid-template-columns: repeat(var(--pp-cols, 2), 1fr); gap: .5rem; margin-top: .85rem; }
    .pp-stat { border: 1px solid var(--tblr-border-color); border-radius: 8px; padding: .5rem .65rem; min-width: 0; }
    .pp-stat .label { font-size: .7rem; text-transform: uppercase; letter-spacing: .03em; color: var(--tblr-secondary); }
    .pp-stat .value { font-weight: 600; font-variant-numeric: tabular-nums; }

    .pp-empty { padding: 3.5rem 1rem; text-align: center; }
    .pp-empty-icon {
        width: 4rem; height: 4rem; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;
        font-size: 2rem; margin-bottom: 1rem;
    }

    .pp-view-toggle .btn { padding-left: .6rem; padding-right: .6rem; }
    .pp-view-toggle .btn.active { background: var(--tblr-primary); color: #fff; border-color: var(--tblr-primary); }
</style>
