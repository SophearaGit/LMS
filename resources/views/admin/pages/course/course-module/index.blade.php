@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <style>
        /* responsive css */
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
                        <h3 class="card-title">Courses</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-levels.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus"></i>&nbsp;
                                Add new
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- TABLE START --}}
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Instructor</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($courses as $item)
                                        <tr>
                                            <td>
                                                {{ $item->title }}
                                            </td>
                                            <td>
                                                {{ $item->price }}💲
                                            </td>
                                            <td>
                                                {{ $item->instructor->name }}
                                            </td>
                                            <td>
                                                @if ($item->is_approved == 'pending')
                                                    <span class="badge bg-yellow-lt">Pending</span>
                                                @elseif ($item->is_approved == 'approved')
                                                    <span class="badge bg-green-lt">Approved</span>
                                                @elseif ($item->is_approved == 'rejected')
                                                    <span class="badge bg-red-lt">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                <select name="status" id="" class="update_approval_status"
                                                    data-id="{{ $item->id }}">
                                                    <option @selected($item->is_approved === 'pending') value="pending">Pending
                                                    </option>
                                                    <option @selected($item->is_approved === 'approved') value="approved">Approve
                                                    </option>
                                                    <option @selected($item->is_approved === 'rejected') value="rejected">Reject
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.course-levels.edit', $item->id) }}"
                                                    class="text-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.course-levels.destroy', $item->id) }}"
                                                    class="text-danger delete-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- TABLE END --}}
                        <div class="mt-4">
                            {{ $courses->links() }}
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

        // VARIABLES
        const csrf_token = $(`meta[name=csrf_token]`).attr('content');
        const base_url = $('meta[name="base_url"]').attr('content');

        // FUNCTIONS
        function updata_approval_status(id, status) {
            $.ajax({
                method: "PUT",
                url: base_url + `/admin/courses/${id}/update-approval`,
                data: {
                    _token: csrf_token,
                    status: status,
                },
                success: function(data) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {

                },
            })
        }

        // DOM LOAD
        $(function() {
            $('.update_approval_status').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).val();
                updata_approval_status(id, status)
            })
        });
    </script>
@endpush
