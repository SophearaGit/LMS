@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <style>
        @media (min-width: 1400px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl,
            .container-xxl {
                max-width: 100%;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container-xl mt-4">
        <div class="row row-cards">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Reviews</h3>
                        <div class="card-actions">
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- TABLE START --}}
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Reviewer</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reviews as $review)
                                        <tr>
                                            <td>
                                                <div class="d-flex py-1 align-items-center">
                                                    <span class="avatar me-2"
                                                        style="background-image: url({{ asset($review->course->thumbnail) }})"></span>
                                                    <div class="flex-fill">
                                                        <div class="font-weight-medium">{{ $review->course->title }}
                                                        </div>
                                                        <div class="text-secondary">
                                                            Instructor: {{ $review->course->instructor->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex py-1 align-items-center">
                                                    <span class="avatar me-2"
                                                        style="background-image: url({{ asset($review->user->image) }})"></span>
                                                    <div class="flex-fill">
                                                        <div class="font-weight-medium">{{ $review->user->name }}
                                                        </div>
                                                        <div class="text-secondary">
                                                            {{ $review->user->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review?->rating)
                                                        <i class="ti ti-star text-warning"></i>
                                                    @endif
                                                @endfor
                                            </td>
                                            <td title="{{ $review->review }}" class="cursor-pointer">
                                                {{ Str::limit($review->review, 30) }}
                                            </td>

                                            <td>
                                                @if ($review->status == 0)
                                                    <span class="badge bg-red-lt">
                                                        Rejected
                                                    </span>
                                                @elseif($review->status == 1)
                                                    <span class="badge bg-green-lt">
                                                        Approved
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.review.update', $review->id) }}"
                                                    method="POST" class="status-{{ $review->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" id="status"
                                                        aria-label="Default select example"
                                                        onchange="$('.status-{{ $review->id }}').submit();">
                                                        <option @selected($review->status == 0) value="0">Rejected
                                                        </option>
                                                        <option @selected($review->status == 1) value="1">Approved
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.review.destroy', $review->id) }}"
                                                    class="text-danger delete-review">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- TABLE END --}}
                        <div class="mt-4">
                            {{ $reviews->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/front/js/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').niceSelect();
        });

        const csrf_token = $(`meta[name=csrf_token]`).attr('content');
        var delete_url = null;

        $('.delete-review').on('click', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            delete_url = url;
            $('#modal-danger').modal('show');
        });

        $('.delete-confirm-btn').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                method: 'DELETE',
                url: delete_url,
                data: {
                    _token: csrf_token
                },
                beforeSend: function() {
                    $('.delete-confirm-btn').text('Deleting...');
                },
                success: function(data) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    let errMsg = xhr.responseJSON.message;
                    notyf.error(errMsg);
                }
            });
        });
    </script>
@endpush
