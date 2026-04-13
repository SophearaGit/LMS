@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <i class="ti ti-calendar"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>
                                                    {{ config('settings.site_currency_icon') }} {{ $todayOrder }}
                                                </b>
                                            </div>
                                            <div class="text-secondary">
                                                Daily Orders
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <i class="ti ti-calendar"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>
                                                    {{ config('settings.site_currency_icon') }} {{ $thisWeekOrder }}
                                                </b>
                                            </div>
                                            <div class="text-secondary">
                                                Weekly Orders
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <i class="ti ti-calendar"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>
                                                    {{ config('settings.site_currency_icon') }} {{ $thisMonthOrder }}
                                                </b>
                                            </div>
                                            <div class="text-secondary">
                                                Monthly Orders
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <i class="ti ti-calendar"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>
                                                    {{ config('settings.site_currency_icon') }} {{ $thisYearOrder }}
                                                </b>
                                            </div>
                                            <div class="text-secondary">
                                                Yearly Orders
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <i class="ti ti-shopping-cart"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>
                                                    {{ $totalOrderCount }}
                                                </b>
                                            </div>
                                            <div class="text-secondary">
                                                Total Orders
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 ">
                            <a href="{{ route('admin.courses.index', ['status' => 'pending']) }}">
                                <div class="card card-sm bg-yellow-lt">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-warning text-white avatar">
                                                    <i class="ti ti-book"></i>
                                                </span>
                                            </div>
                                            <div class="col ">
                                                <div class="font-weight-medium">
                                                    <b>
                                                        <strong>
                                                            {{ $totalPendingCourse }}
                                                        </strong>
                                                    </b>
                                                </div>
                                                <div class="text-secondary">
                                                    <b>
                                                        <strong>
                                                            Pending Courses
                                                        </strong>
                                                    </b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a href="{{ route('admin.courses.index', ['status' => 'rejected']) }}">
                                <div class="card card-sm bg-red-lt">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-danger text-white avatar">
                                                    <i class="ti ti-book-off"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <b>
                                                        <strong>
                                                            {{ $totalRejectedCourse }}
                                                        </strong>
                                                    </b>
                                                </div>
                                                <div class="text-secondary">
                                                    <b>
                                                        <strong>
                                                            Rejected Courses
                                                        </strong>
                                                    </b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a href="{{ route('admin.courses.index', ['status' => 'approved']) }}">
                                <div class="card card-sm  bg-green-lt">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-success text-white avatar">
                                                    <i class="ti ti-books"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <b>
                                                        <strong>
                                                            {{ $totalCourseCount }}
                                                        </strong>
                                                    </b>
                                                </div>
                                                <div class="text-secondary">
                                                    <b>
                                                        <strong>
                                                            Total Courses
                                                        </strong>
                                                    </b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div>
                                        <canvas id="orderChart" style="height: 300px"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Courses</h3>
                                </div>
                                <div class="card-table table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Course</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recentCourses as $course)
                                                <tr>
                                                    {{-- <td>
                                                        <a href="{{ route('courses.show', $course->slug) }}"
                                                            target="_blank" class="ms-1" aria-label="Open website"> <i
                                                                class="ti ti-link fs-4"></i>
                                                            {{ Str::limit($course->title, 30) }}
                                                        </a>
                                                    </td> --}}
                                                    <td>
                                                        <a href="{{ $course->is_approved == 'pending' ? route('admin.courses.index') : route('courses.show', $course->slug) }}"
                                                            @if ($course->is_approved != 'pending') target="_blank" @endif
                                                            class="ms-1" aria-label="Open website">
                                                            <i class="ti ti-link fs-4"></i>
                                                            {{ Str::limit($course->title, 30) }}
                                                        </a>
                                                    </td>

                                                    <td class="text-secondary">
                                                        @if ($course->is_approved == 'pending')
                                                            <span class="badge bg-yellow-lt">Pending</span>
                                                        @elseif($course->is_approved == 'approved')
                                                            <span class="badge bg-green-lt">Approved</span>
                                                        @elseif($course->is_approved == 'rejected')
                                                            <span class="badge bg-red-lt">Rejected</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Blogs</h3>
                                </div>
                                <div class="card-table table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Blog</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recentBlogs as $blog)
                                                <tr>
                                                    {{-- <td>
                                                        <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                                            class="ms-1" aria-label="Open website">
                                                            <i class="ti ti-link fs-4"></i>
                                                            {{ Str::limit($blog->title, 30) }}
                                                        </a>
                                                    </td> --}}
                                                    <td>
                                                        <a href="{{ $blog->status == '1' ? route('blog.detail', $blog->slug) : route('admin.blog.edit', $blog->id) }}"
                                                            class="ms-1" aria-label="Open website"
                                                            @if ($blog->status == '1') target="_blanks" @endif>
                                                            <i class="ti ti-link fs-4"></i>
                                                            {{ Str::limit($blog->title, 30) }}
                                                        </a>
                                                    </td>
                                                    <td class="text-secondary">
                                                        @if ($blog->status == 1)
                                                            <span class="badge bg-green-lt">Active</span>
                                                        @elseif($blog->status == 0)
                                                            <span class="badge bg-red-lt">Inactive</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Orders</h3>
                                </div>
                                <div class="card-table table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Invoice ID</th>
                                                <th>Customer Name</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recentOrders as $order)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                                            class="ms-1" aria-label="Open website">
                                                            <i
                                                                class="ti ti-hash fs-4"></i>{{ Str::limit($order->invoice_id, 8, '...') }}
                                                            <br>
                                                            <small>
                                                                {{ $order->created_at->format('d M Y') }}
                                                            </small>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ $order->customer->name }} <br>
                                                        <small>
                                                            {{ $order->customer->email }}
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <b>
                                                            {{ config('settings.site_currency_icon') }}
                                                            {{ $order->total_amount }}
                                                        </b>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <h3 class="card-title">
                                            Recently Bought Courses
                                        </h3>
                                    </div>
                                    <div class="card-actions">
                                        <div class="dropdown">
                                            <a href="#" class="btn-action dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                    <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                    <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                </svg>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                <a href="{{ route('admin.report.excel') }}" class="dropdown-item">
                                                    Export Excel
                                                </a>
                                                <a href="{{ route('admin.report.pdf') }}" class="dropdown-item">
                                                    Download Pdf
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-table table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Course Title
                                                </th>
                                                <th>
                                                    Total Student
                                                </th>
                                                <th>
                                                    Total Revenue
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recentBoughtCourses as $course)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('courses.show', $course->slug) }}"
                                                            target="_blank" class="ms-1" aria-label="Open website"> <i
                                                                class="ti ti-link fs-4"></i>
                                                            {{ Str::limit($course->title, 30) }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ $course->enrollments()->count() }}
                                                    </td>
                                                    <td>
                                                        {{ config('settings.site_currency_icon') }}
                                                        {{ $course->total_revenue ?? '0' }}
                                                    </td>
                                                </tr>
                                            @empty
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
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('orderChart').getContext('2d');
        const orderChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                        label: 'Order Amount ({{ config('settings.site_currency_icon') }})',
                        data: @json(array_values($monthlyOrderSum)),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Order Count',
                        data: @json(array_values($monthlyOrderCount)),
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        type: 'line',
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                respsonsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Order Amount ({{ config('settings.site_currency_icon') }})'
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Order Count'
                        },
                        position: 'right',
                        grid: {
                            drawOnChartArea: false,
                        }
                    },

                }
            }
        });
    </script>
@endpush
