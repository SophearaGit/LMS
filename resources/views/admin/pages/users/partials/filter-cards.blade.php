{{-- $filters: key => [label, icon, tone]; $counts; $filter (current); $linkFor(key) => url --}}
<div class="row g-3 mb-4">
    @foreach ($filters as $key => $f)
        <div class="col-6 col-lg-{{ 12 / count($filters) }}">
            <a href="{{ $linkFor($key) }}" style="--pp-accent: var(--tblr-{{ $f[2] }});"
                class="pp-filter {{ $filter === $key ? 'is-active' : '' }}" @if ($filter === $key) aria-current="page" @endif>
                <div class="d-flex align-items-center gap-3">
                    <span class="pp-filter-icon bg-{{ $f[2] }}-lt"><i class="ti {{ $f[1] }}"></i></span>
                    <div class="min-w-0">
                        <div class="pp-filter-count">{{ $counts[$key] }}</div>
                        <div class="pp-filter-label text-truncate">{{ $f[0] }}</div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
