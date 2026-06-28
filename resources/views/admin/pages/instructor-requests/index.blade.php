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
                        <h3 class="card-title">Instructor Requests</h3>
                        {{-- <div class="card-actions">
                            <form action="{{ route('admin.instructor-requests.index') }}" method="GET">
                                <p>Sort by Status:</p>
                                <select name="status" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                                    <option value="approved" @selected(request('status') == 'approved')>Approved</option>
                                    <option value="rejected" @selected(request('status') == 'rejected')>Rejected</option>
                                </select>
                            </form>
                        </div> --}}
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
                                    {{-- all --}}
                                    <a class="dropdown-item" href="{{ route('admin.instructor-requests.index') }}">
                                        All
                                    </a>
                                    <a class="dropdown-item text-warning"
                                        href="
                                        {{ route('admin.instructor-requests.index', ['status' => 'pending']) }}
                                    ">
                                        Pending
                                    </a>
                                    <a class="dropdown-item text-success"
                                        href="
                                        {{ route('admin.instructor-requests.index', ['status' => 'approved']) }}">
                                        Approved
                                    </a>
                                    <a class="dropdown-item text-danger"
                                        href="
                                        {{ route('admin.instructor-requests.index', ['status' => 'rejected']) }}">
                                        Rejected
                                    </a>
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
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Document</th>
                                        <th>Action</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($instructorRequests as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->email }}
                                            </td>
                                            <td>
                                                @if ($item->approval_status === 'pending')
                                                    <span class="badge bg-yellow text-yellow-fg">
                                                        {{ $item->approval_status }}
                                                    </span>
                                                @elseif($item->approval_status === 'rejected')
                                                    <span class="badge bg-red text-red-fg">
                                                        {{ $item->approval_status }}
                                                    </span>
                                                @elseif($item->approval_status === 'approved')
                                                    <span class="badge bg-green text-green-fg">
                                                        {{ $item->approval_status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.instructor_doc_downloads', $item->id) }}"
                                                    class="text-muted">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                        <path d="M7 11l5 5l5 -5" />
                                                        <path d="M12 4l0 12" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.instructor-requests.update', $item->id) }}"
                                                    method="POST" class="status-{{ $item->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" id="status"
                                                        aria-label="Default select example"
                                                        onchange="$('.status-{{ $item->id }}').submit();">
                                                        <option @selected($item->approval_status === 'pending') value="pending">Pending
                                                        </option>
                                                        <option @selected($item->approval_status === 'approved') value="approved">Approve
                                                        </option>
                                                        <option @selected($item->approval_status === 'rejected') value="rejected">Reject
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No instructor requests found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- TABLE END --}}
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
    </script>
@endpush
