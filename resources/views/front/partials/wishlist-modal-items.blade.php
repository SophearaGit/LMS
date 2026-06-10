@forelse ($wishlists as $wishlist)
    <div class="wishlist-modal-item d-flex align-items-center gap-3 p-3 mb-2 rounded-3 border wishlist-item"
        id="wishlist-item-{{ $wishlist->course_id }}" style="background: #fafafa; transition: all 0.2s;">
        {{-- Thumbnail --}}
        <div style="flex-shrink: 0; width: 90px; height: 62px; overflow: hidden; border-radius: 8px;">
            <img src="{{ asset($wishlist->course->thumbnail) }}" alt="{{ $wishlist->course->title }}"
                style="width: 90px; height: 62px; object-fit: cover; display: block;">
        </div>
        {{-- Info --}}
        <div class="flex-grow-1 overflow-hidden">
            <p class="mb-1 fw-semibold text-truncate" style="font-size: 13.5px; color: #1a1a2e;">
                {{ $wishlist->course->title }}
            </p>
            <small class="text-muted d-block mb-1" style="font-size: 11.5px;">
                <i class="far fa-user-tie me-1"></i>{{ $wishlist->course->instructor->name }}
            </small>
            <div class="d-flex align-items-center gap-2">
                {{-- Price --}}
                @if ($wishlist->course->price == 0)
                    <span class="badge" style="background: #d4edda; color: #155724; font-size: 11px;">Free</span>
                @elseif ($wishlist->course->discount > 0)
                    <span class="fw-bold" style="font-size: 13px; color: #e74c3c;">
                        ${{ number_format($wishlist->course->price - ($wishlist->course->price * $wishlist->course->discount) / 100, 2) }}
                    </span>
                    <del class="text-muted"
                        style="font-size: 11px;">${{ number_format($wishlist->course->price, 2) }}</del>
                @else
                    <span class="fw-bold" style="font-size: 13px; color: #2c3e50;">
                        ${{ number_format($wishlist->course->price, 2) }}
                    </span>
                @endif
                {{-- Rating --}}
                <span style="font-size: 11px; color: #f39c12;">
                    <i class="fas fa-star"></i>
                    {{ number_format($wishlist->course->reviews()->avg('rating') ?? 0, 1) }}
                </span>
            </div>
        </div>
        {{-- Actions --}}
        <div class="d-flex flex-column gap-2" style="flex-shrink: 0;">
            <a href="{{ route('courses.show', $wishlist->course->slug) }}"
                class="btn btn-sm btn-primary d-flex align-items-center justify-content-center gap-1"
                style="font-size: 11.5px; padding: 4px 10px; border-radius: 6px; white-space: nowrap;">
                <i class="far fa-eye"></i> View
            </a>
            <button
                class="btn btn-sm btn-outline-danger remove-wishlist-modal-btn d-flex align-items-center justify-content-center gap-1"
                data-course-id="{{ $wishlist->course_id }}"
                style="font-size: 11.5px; padding: 4px 10px; border-radius: 6px;">
                <i class="far fa-heart-broken"></i> Remove
            </button>
        </div>
    </div>
@empty
    <div class="text-center py-5">
        <i class="far fa-heart" style="font-size: 56px; color: #e0e0e0;"></i>
        <h6 class="mt-3 text-muted">Your wishlist is empty</h6>
        <p class="text-muted" style="font-size: 13px;">Browse courses and save your favorites here.</p>
        <a href="{{ route('courses') }}" class="btn btn-primary btn-sm mt-1">Browse Courses</a>
    </div>
@endforelse
