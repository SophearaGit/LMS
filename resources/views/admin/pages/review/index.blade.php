@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Reviews')
@push('stylesheets')
    @include('admin.pages.users.partials.people-styles')
    <style>
        .rv-stars { display: inline-flex; gap: .1rem; line-height: 1; }
        .rv-stars .ti { font-size: 1.05rem !important; }
        .rv-stars .on { color: #f59f00; }
        .rv-stars .off { color: var(--tblr-border-color); }

        .rv-score { display: flex; align-items: center; gap: 1rem; height: 100%; padding: 1rem 1.1rem;
            border: 1px solid var(--tblr-border-color); border-radius: var(--tblr-border-radius-lg, 8px); background: var(--tblr-bg-surface); }
        .rv-score .big { font-size: 2rem; font-weight: 800; line-height: 1; font-variant-numeric: tabular-nums; }
        .rv-bars { flex-grow: 1; min-width: 0; display: grid; gap: .15rem; }
        .rv-bar { display: grid; grid-template-columns: .8rem 1fr 1.6rem; align-items: center; gap: .4rem; font-size: .7rem; color: var(--tblr-secondary); }
        .rv-bar .track { height: 5px; border-radius: 3px; background: var(--tblr-border-color); overflow: hidden; }
        .rv-bar .fill { display: block; height: 100%; background: #f59f00; }
        .rv-bar .n { text-align: right; font-variant-numeric: tabular-nums; }

        .rv-toolbar { display: flex; flex-wrap: wrap; gap: .5rem; align-items: center; padding: .75rem 1rem;
            border-bottom: 1px solid var(--tblr-border-color); background: var(--tblr-bg-surface-secondary, #f8fafc); }
        .rv-toolbar .form-select { width: auto; min-width: 9rem; }
        .rv-toolbar .form-select.is-set { border-color: var(--tblr-primary); color: var(--tblr-primary); font-weight: 600; }

        .rv-item { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 1rem 1.5rem; padding: 1.1rem 1.25rem;
            border-bottom: 1px solid var(--tblr-border-color); transition: background .12s; }
        .rv-item:last-child { border-bottom: 0; }
        .rv-item:hover { background: var(--tblr-bg-surface-secondary, rgba(0,0,0,.015)); }
        .rv-item.is-waiting { box-shadow: inset 3px 0 0 var(--tblr-yellow); }
        .rv-who { display: flex; align-items: center; gap: .75rem; min-width: 0; }
        .rv-meta { font-size: .8rem; color: var(--tblr-secondary); }
        .rv-text { margin: .65rem 0 .75rem; font-size: .95rem; line-height: 1.6; white-space: pre-line; word-break: break-word; }
        .rv-text.is-clamped { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .rv-more { border: 0; background: none; padding: 0; font-size: .82rem; color: var(--tblr-primary); font-weight: 600; margin: -.4rem 0 .7rem; }
        .rv-course { display: inline-flex; align-items: center; gap: .6rem; max-width: 100%; padding: .35rem .7rem .35rem .35rem;
            border: 1px solid var(--tblr-border-color); border-radius: 8px; font-size: .82rem; }
        .rv-course img, .rv-course .ph { width: 40px; height: 28px; border-radius: 5px; object-fit: cover; flex-shrink: 0; background: var(--tblr-bg-surface-secondary, #f1f5f9); }
        .rv-course .t { font-weight: 600; }
        .rv-side { display: flex; flex-direction: column; align-items: flex-end; justify-content: space-between; gap: .75rem; min-width: 10.5rem; }
        .rv-actions { display: flex; gap: .4rem; }

        @media (max-width: 767.98px) {
            .rv-item { grid-template-columns: 1fr; padding: 1rem; }
            .rv-side { flex-direction: row; align-items: center; min-width: 0; padding-top: .75rem; border-top: 1px dashed var(--tblr-border-color); }
            .rv-actions { flex-grow: 1; justify-content: flex-end; }
            .rv-actions .btn-publish { flex-grow: 1; }
            .rv-score { flex-wrap: wrap; }
        }
    </style>
@endpush
@section('content')
    @php
        $stars = function ($n) {
            $out = '';
            for ($i = 1; $i <= 5; $i++) {
                $out .= $i <= $n ? '<i class="ti ti-star-filled on"></i>' : '<i class="ti ti-star off"></i>';
            }
            return '<span class="rv-stars" role="img" aria-label="' . (int) $n . ' out of 5 stars">' . $out . '</span>';
        };
        $avatarOf = function ($user) {
            $img = $user->image ?? null;
            return $img && is_file(public_path(ltrim($img, '/')))
                && ! in_array($img, ['/default-images/avatar/teacher.jpg', '/default-images/avatar/student_girl.png'], true)
                ? asset($img) : asset('default-images/avatar/both.jpg');
        };
        $filters = [
            'waiting'   => ['Waiting for approval', 'ti-hourglass-high', 'yellow'],
            'published' => ['Published',            'ti-world',          'green'],
            'all'       => ['All reviews',          'ti-messages',       'primary'],
        ];
        $link = fn (array $over = []) => route('admin.review.index', array_filter(array_merge([
            'filter' => $filter, 'rating' => $rating, 'sort' => $sort === 'newest' ? null : $sort, 'search' => $search ?: null,
        ], $over)));
        $hasFilters = $rating || $search !== '';
        $publishedTotal = max(1, $breakdown->sum());
    @endphp

    <div class="container-xl mt-4 mb-5">
        {{-- Page header --}}
        <div class="mb-4">
            <div class="text-secondary text-uppercase fw-semibold small mb-1">Feedback</div>
            <h2 class="page-title mb-1">Course Reviews</h2>
            <div class="text-secondary">New reviews stay hidden until you publish them. Published reviews appear on the course page.</div>
        </div>

        {{-- Summary --}}
        <div class="row g-3 mb-4">
            @foreach ($filters as $key => $f)
                <div class="col-6 col-lg-3">
                    <a href="{{ $link(['filter' => $key]) }}" style="--pp-accent: var(--tblr-{{ $f[2] }});"
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
            <div class="col-6 col-lg-3">
                <div class="rv-score">
                    <div>
                        <div class="big">{{ $counts['published'] ? number_format($average, 1) : '–' }}</div>
                        {!! $stars((int) round($average)) !!}
                        <div class="pp-filter-label mt-1">Average (published)</div>
                    </div>
                    <div class="rv-bars d-none d-sm-grid" aria-hidden="true">
                        @for ($r = 5; $r >= 1; $r--)
                            @php $n = (int) ($breakdown[$r] ?? 0); @endphp
                            <div class="rv-bar"><span>{{ $r }}</span><span class="track"><span class="fill" style="width: {{ round($n / $publishedTotal * 100) }}%"></span></span><span class="n">{{ $n }}</span></div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header flex-wrap gap-3">
                <div>
                    <h3 class="card-title mb-0">{{ $filters[$filter][0] }}</h3>
                    <div class="text-secondary small mt-1">
                        @if ($reviews->total())
                            Showing {{ $reviews->firstItem() }}–{{ $reviews->lastItem() }} of {{ $reviews->total() }}
                        @else
                            No results
                        @endif
                    </div>
                </div>
                <form action="{{ route('admin.review.index') }}" method="GET" class="ms-md-auto w-100" style="max-width: 380px;" role="search">
                    <input type="hidden" name="filter" value="{{ $filter }}">
                    @if ($rating) <input type="hidden" name="rating" value="{{ $rating }}"> @endif
                    @if ($sort !== 'newest') <input type="hidden" name="sort" value="{{ $sort }}"> @endif
                    <div class="input-icon">
                        <span class="input-icon-addon"><i class="ti ti-search"></i></span>
                        <input type="search" name="search" value="{{ $search }}" class="form-control"
                            placeholder="Search review, student or course…" aria-label="Search reviews" autocomplete="off">
                    </div>
                </form>
            </div>

            <form action="{{ route('admin.review.index') }}" method="GET" class="rv-toolbar">
                <input type="hidden" name="filter" value="{{ $filter }}">
                @if ($search !== '') <input type="hidden" name="search" value="{{ $search }}"> @endif
                <select name="rating" class="form-select form-select-sm {{ $rating ? 'is-set' : '' }}" aria-label="Rating" onchange="this.form.submit()">
                    <option value="">All ratings</option>
                    @for ($r = 5; $r >= 1; $r--)
                        <option value="{{ $r }}" @selected($rating === $r)>{{ $r }} {{ $r === 1 ? 'star' : 'stars' }}</option>
                    @endfor
                </select>
                <select name="sort" class="form-select form-select-sm" aria-label="Sort" onchange="this.form.submit()">
                    <option value="" @selected($sort === 'newest')>Newest first</option>
                    <option value="oldest" @selected($sort === 'oldest')>Oldest first</option>
                    <option value="highest" @selected($sort === 'highest')>Highest rating</option>
                    <option value="lowest" @selected($sort === 'lowest')>Lowest rating</option>
                </select>
                @if ($hasFilters)
                    <a href="{{ route('admin.review.index', ['filter' => $filter]) }}" class="btn btn-sm btn-ghost-secondary ms-auto">
                        <i class="ti ti-x me-1"></i> Clear filters
                    </a>
                @endif
            </form>

            @if ($reviews->isEmpty())
                <div class="pp-empty">
                    @if ($hasFilters)
                        <div class="pp-empty-icon bg-secondary-lt"><i class="ti ti-filter-off"></i></div>
                        <h3 class="mb-1">No reviews match these filters</h3>
                        <p class="text-secondary mb-3">Try another rating or search.</p>
                        <a href="{{ route('admin.review.index', ['filter' => $filter]) }}" class="btn btn-outline-secondary">Clear filters</a>
                    @elseif ($filter === 'waiting')
                        <div class="pp-empty-icon bg-green-lt"><i class="ti ti-mood-happy"></i></div>
                        <h3 class="mb-1">You’re all caught up</h3>
                        <p class="text-secondary mb-3">No reviews are waiting for approval.</p>
                        <a href="{{ route('admin.review.index', ['filter' => 'published']) }}" class="btn btn-outline-secondary">See published reviews</a>
                    @else
                        <div class="pp-empty-icon bg-secondary-lt"><i class="ti ti-message-off"></i></div>
                        <h3 class="mb-1">No reviews yet</h3>
                        <p class="text-secondary mb-0">Reviews appear here when students rate a course.</p>
                    @endif
                </div>
            @else
                <div>
                    @foreach ($reviews as $review)
                        @php
                            $u = $review->user;
                            $c = $review->course;
                            $live = (int) $review->status === 1;
                            $long = mb_strlen((string) $review->review) > 220 || substr_count((string) $review->review, "\n") > 2;
                        @endphp
                        <article class="rv-item {{ $live ? '' : 'is-waiting' }}">
                            <div class="min-w-0">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="rv-who">
                                        <span class="avatar avatar-md rounded-circle flex-shrink-0" style="background-image: url('{{ $u ? $avatarOf($u) : asset('default-images/avatar/both.jpg') }}')"></span>
                                        <div class="min-w-0">
                                            <div class="pp-name text-truncate">{{ optional($u)->name ?? 'Deleted user' }}</div>
                                            <div class="rv-meta text-truncate">
                                                {{ optional($u)->email }}
                                                @if ($review->updated_at) · <span title="{{ $review->updated_at->format('d M Y, H:i') }}">{{ $review->updated_at->diffForHumans() }}</span> @endif
                                            </div>
                                        </div>
                                    </div>
                                    {!! $stars((int) $review->rating) !!}
                                </div>

                                <div class="rv-text {{ $long ? 'is-clamped' : '' }}" id="rv-text-{{ $review->id }}">{{ $review->review }}</div>
                                @if ($long)
                                    <button type="button" class="rv-more" data-rv-more="rv-text-{{ $review->id }}" aria-expanded="false">Read more</button>
                                @endif

                                @if ($c)
                                    <span class="rv-course">
                                        @if ($c->thumbnail)
                                            <img src="{{ asset($c->thumbnail) }}" alt="" loading="lazy">
                                        @else
                                            <span class="ph"></span>
                                        @endif
                                        <span class="min-w-0">
                                            <span class="t d-block text-truncate">{{ $c->title }}</span>
                                            @if ($c->instructor) <span class="text-secondary d-block text-truncate">by {{ $c->instructor->name }}</span> @endif
                                        </span>
                                    </span>
                                @else
                                    <span class="rv-meta">Course no longer available</span>
                                @endif
                            </div>

                            <div class="rv-side">
                                <span class="badge {{ $live ? 'bg-green-lt' : 'bg-yellow-lt' }}">
                                    <i class="ti {{ $live ? 'ti-world' : 'ti-hourglass-high' }}"></i>{{ $live ? 'Published' : 'Waiting for approval' }}
                                </span>
                                <div class="rv-actions">
                                    <form action="{{ route('admin.review.update', $review->id) }}" method="POST" class="m-0 d-flex flex-grow-1" data-rv-status>
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="{{ $live ? 0 : 1 }}">
                                        @if ($live)
                                            <button type="submit" class="btn btn-outline-secondary btn-publish w-100">
                                                <i class="ti ti-eye-off me-1"></i> Unpublish
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-success btn-publish w-100">
                                                <i class="ti ti-check me-1"></i> Publish
                                            </button>
                                        @endif
                                    </form>
                                    <button type="button" class="btn btn-ghost-danger btn-icon" data-rv-delete
                                        data-action="{{ route('admin.review.destroy', $review->id) }}"
                                        data-name="{{ optional($u)->name ?? 'this student' }}"
                                        title="Delete review" aria-label="Delete review by {{ optional($u)->name }}">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($reviews->hasPages())
                    <div class="card-footer d-flex justify-content-center justify-content-md-end">
                        {{ $reviews->onEachSide(1)->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>

    {{-- Delete confirm --}}
    <div class="modal modal-blur fade" id="rv-delete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <i class="ti ti-alert-triangle text-danger mb-2" style="font-size: 3rem;"></i>
                    <h3>Delete this review?</h3>
                    <div class="text-secondary" data-rv-delete-text></div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row g-2">
                            <div class="col"><button type="button" class="btn w-100" data-bs-dismiss="modal">Cancel</button></div>
                            <div class="col"><button type="button" class="btn btn-danger w-100" data-rv-delete-ok>Delete</button></div>
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
            // Read more / less
            document.querySelectorAll('[data-rv-more]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var t = document.getElementById(btn.getAttribute('data-rv-more'));
                    var open = t.classList.toggle('is-clamped') === false;
                    btn.textContent = open ? 'Show less' : 'Read more';
                    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
                });
            });

            // Publish / unpublish: show progress, prevent double clicks
            document.querySelectorAll('[data-rv-status]').forEach(function (f) {
                f.addEventListener('submit', function () {
                    var b = f.querySelector('button');
                    b.disabled = true;
                    b.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving…';
                });
            });

            // Delete
            var modal = document.getElementById('rv-delete');
            var action = null;
            document.querySelectorAll('[data-rv-delete]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    action = btn.getAttribute('data-action');
                    modal.querySelector('[data-rv-delete-text]').textContent =
                        'The review by ' + btn.getAttribute('data-name') + ' will be removed permanently. To just hide it, unpublish it instead.';
                    var ok = modal.querySelector('[data-rv-delete-ok]');
                    ok.disabled = false; ok.textContent = 'Delete';
                    bootstrap.Modal.getOrCreateInstance(modal).show();
                });
            });
            modal.querySelector('[data-rv-delete-ok]').addEventListener('click', function () {
                if (!action) return;
                var ok = this;
                ok.disabled = true;
                ok.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Deleting…';
                fetch(action, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf_token]').content, 'Accept': 'application/json' }
                }).then(function (r) {
                    if (!r.ok) throw new Error();
                    window.location.reload();
                }).catch(function () {
                    ok.disabled = false; ok.textContent = 'Delete';
                    bootstrap.Modal.getOrCreateInstance(modal).hide();
                    if (window.notyf) notyf.error('Could not delete the review. Please try again.');
                });
            });
        })();
    </script>
@endpush
