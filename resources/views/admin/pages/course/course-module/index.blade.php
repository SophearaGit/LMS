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
                            <div class="dropdown">
                                <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">

                                    <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <form method="GET" action="{{ route('admin.courses.index') }}">
                                        <a class="dropdown-item"
                                            href="
                                            {{ route('admin.courses.index', ['status' => 'pending']) }}
                                        ">
                                            Pending
                                        </a>
                                        <a class="dropdown-item"
                                            href="
                                            {{ route('admin.courses.index', ['status' => 'approved']) }}
                                        ">
                                            Approved
                                        </a>
                                        <a class="dropdown-item"
                                            href="
                                            {{ route('admin.courses.index', ['status' => 'rejected']) }}
                                        ">
                                            Rejected
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @include('admin.pages.partials.breadcrumb') --}}
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
                                        <th colspan="2" class="text-center">Action</th>
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
                                                <select name="status" id=""
                                                    class="update_approval_status text-dark" data-id="{{ $item->id }}">
                                                    <option @selected($item->is_approved === 'pending') value="pending">Pending
                                                    </option>
                                                    <option @selected($item->is_approved === 'approved') value="approved">Approved
                                                    </option>
                                                    <option @selected($item->is_approved === 'rejected') value="rejected">Rejected
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.courses.edit_basic_info', ['id' => $item->id, 'step' => 1]) }}"
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
                                                <a href="{{ route('admin.courses.destroy', $item->id) }}"
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
    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-secondary">Do you really want to delete this course? This process cannot be undone.
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">Cancel</a>
                            </div>
                            <div class="col"><a href="#"
                                    class="btn btn-danger w-100 delete-confirm-btn">Delete</a></div>
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
        var delete_url = null;
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
                error: function(xhr, status, error) {},
            })
        }
        // DOM LOAD
        $(function() {
            $('.update_approval_status').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).val();
                updata_approval_status(id, status)
            })
            $('.delete-item').on('click', function(e) {
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
        });
    </script>
@endpush
