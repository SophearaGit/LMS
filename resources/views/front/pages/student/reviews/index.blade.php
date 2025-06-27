@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <style>
        .nice-select:active,
        .nice-select.open,
        .nice-select:focus {
            border-color: #ececee;
        }
    </style>
@endpush
@section('content')
    @include('front.pages.student.partials.breadcrum-banner')
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('front.pages.student.components.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading">
                                <h5>Reviews</h5>
                                <p>
                                    Manage your reviews and its updates like live, draft, and insight.
                                </p>
                            </div>
                        </div>
                        <div class="wsus__dash_course_table">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="details">
                                                        COURSE NAME
                                                    </th>
                                                    <th class="sale">
                                                        RATING
                                                    </th>
                                                    <th class="invoice">
                                                        REVIEW
                                                    </th>
                                                    <th class="date">
                                                        STATUS
                                                    </th>
                                                    <th class="method">
                                                        ACTION
                                                    </th>
                                                </tr>
                                                @forelse ($reviews as $review)
                                                    <tr>
                                                        <td class="details">
                                                            <p class="rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $review->rating)
                                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                                    @else
                                                                        <i class="far fa-star" aria-hidden="true"></i>
                                                                    @endif
                                                                @endfor
                                                                <span>({{ number_format($review->rating, 1) }})</span>
                                                            </p>
                                                            <a class="title"
                                                                href="{{ route('courses.show', $review->course->slug) }}">Complete
                                                                {{ $review->course->title }}</a>
                                                        </td>
                                                        <td class="sale">
                                                            <p>{{ $review->rating }}</p>
                                                        </td>
                                                        <td class="invoice">
                                                            <p>
                                                                {{ Str::limit($review->review, 50, '...') }}
                                                            </p>
                                                        </td>
                                                        <td class="status">
                                                            @if ($review->status == 1)
                                                                <p class="active">Approved</p>
                                                            @elseif ($review->status == 0)
                                                                <p class="delete">Rejected</p>
                                                            @endif
                                                        </td>
                                                        <td class="action">
                                                            <a class="del delete-review"
                                                                href="{{ route('student.reviews.delete', $review->id) }}"><i
                                                                    class="fas fa-trash-alt" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            <p class="text-muted">No reviews found.</p>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.delete-review').on('click', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                _token: csrf_token,
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: "Deleting...",
                                    text: "Please wait while we delete your review.",
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your review has been deleted.",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Something went wrong. Please try again.",
                                    icon: "error"
                                });
                            },
                        });
                    }
                });
            });

            $('select').niceSelect();
        });
    </script>
@endpush
