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
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <i class="ti ti-book"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>
                                                    {{ $totalPendingCourse }}
                                                </b>
                                            </div>
                                            <div class="text-secondary">
                                                Pending Courses
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
                                                <i class="ti ti-book-off"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>
                                                    {{ $totalRejectedCourse }}
                                                </b>
                                            </div>
                                            <div class="text-secondary">
                                                Rejected Courses
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
                                                <i class="ti ti-books"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                <b>
                                                    {{ $totalCourseCount }}
                                                </b>
                                            </div>
                                            <div class="text-secondary">
                                                Total Courses
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        {{-- <div class="col-sm-12 col-lg-4">
                            <div class="card card-md sticky-top">
                                <div class="card-stamp card-stamp-lg">
                                    <div class="card-stamp-icon bg-primary">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/ghost -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7">
                                            </path>
                                            <path d="M10 10l.01 0"></path>
                                            <path d="M14 10l.01 0"></path>
                                            <path d="M10 14a3.5 3.5 0 0 0 4 0"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-10">
                                            <h3 class="h1">Tabler Icons</h3>
                                            <div class="markdown">
                                                All icons come from the Tabler Icons set and are MIT-licensed. Visit
                                                <a href="https://tabler.io/icons" target="_blank" rel="noopener">Tabler
                                                    Icons Website</a>, download any of the 5880 icons in SVG, PNG
                                                or&nbsp;React and use them in your favourite design tools.
                                            </div>
                                            <div class="mt-3">
                                                <a href="https://tabler.io/icons" class="btn btn-primary" target="_blank"
                                                    rel="noopener">
                                                    <!-- Download SVG icon from http://tabler.io/icons/icon/download -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-1">
                                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                                        <path d="M7 11l5 5l5 -5"></path>
                                                        <path d="M12 4l0 12"></path>
                                                    </svg>
                                                    Download icons
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
                                                    <td>
                                                        <a href="{{ route('courses.show', $course->slug) }}"
                                                            target="_blank" class="ms-1" aria-label="Open website">
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
                                                    <td>
                                                        <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                                            class="ms-1" aria-label="Open website">
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
