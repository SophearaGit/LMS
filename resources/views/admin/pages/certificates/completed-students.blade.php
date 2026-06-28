@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Certificates
                        </div>
                        <h2 class="page-title">
                            Completed Students
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                {{-- Statistics --}}
                <div class="row row-deck row-cards mb-3">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Completed Students</div>
                                </div>
                                <div class="h1 mb-0 mt-2">
                                    {{ $completedStudents ?? 0 }}
                                </div>
                                <div class="text-secondary mt-2">
                                    Students eligible for certificates
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="subheader">
                                    Certificates Issued
                                </div>
                                <div class="h1 mb-0 mt-2">
                                    {{ number_format($issuedCertificates) }}
                                </div>
                                <div class="text-secondary mt-2">
                                    Unique certificates generated
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="subheader">
                                    Certificate Downloads
                                </div>
                                <div class="h1 mb-0 mt-2">
                                    {{ number_format($certificateDownloads) }}
                                </div>
                                <div class="text-secondary mt-2">
                                    Total PDF downloads
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Table --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Completed Students
                        </h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <form method="GET">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control" placeholder="Search student...">
                                </div>
                                <div class="col-md-3">
                                    <select name="course" class="form-select">
                                        <option value="">All Courses</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}" @selected(request('course') == $course->id)>
                                                {{ $course->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="instructor" class="form-select">
                                        <option value="">All Instructors</option>
                                        @foreach ($instructors as $instructor)
                                            <option value="{{ $instructor->id }}" @selected(request('instructor') == $instructor->id)>
                                                {{ $instructor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex gap-2">
                                    <button class="btn btn-primary w-100">
                                        <i class="ti ti-search me-1"></i>
                                        Search
                                    </button>
                                    <a href="{{ route('admin.certificates.completed-students') }}"
                                        class="btn btn-outline-secondary">
                                        <i class="ti ti-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Course</th>
                                    <th>Instructor</th>
                                    <th>Status</th>
                                    <th>Completed</th>
                                    <th>Downloads</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url('{{ asset($student->user->image ?? asset('default-images/avatar/student.png')) }}')">
                                                </span>
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">
                                                        {{ $student->user->name }}
                                                    </div>
                                                    <div class="text-secondary">
                                                        {{ $student->user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $student->course->title }}
                                        </td>
                                        <td>
                                            {{ $student->course->instructor->name ?? '-' }}
                                        </td>
                                        <td>
                                            <span class="badge bg-green-lt">
                                                Completed
                                            </span>
                                        </td>
                                        <td>
                                            {{ $student->updated_at->format('d M Y') }}
                                        </td>
                                        <td>
                                            @if ($student->certificate)
                                                <div class="d-flex flex-column">
                                                    <span class="badge bg-green-lt mb-1">
                                                        Issued
                                                    </span>
                                                    <small class="text-secondary">
                                                        Downloaded
                                                        <strong>{{ $student->certificate->download_count }}</strong>
                                                        {{ Str::plural('time', $student->certificate->download_count) }}
                                                    </small>
                                                </div>
                                            @else
                                                <span class="badge bg-yellow-lt">
                                                    Not Issued
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.certificates.download', [
                                                'course' => $student->course_id,
                                                'user' => $student->user_id,
                                            ]) }}"
                                                class="btn btn-icon btn-outline-success" title="Download Certificate"
                                                target="_blank">
                                                <i class="ti ti-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <img src="{{ asset('admin/static/illustrations/undraw_no_data.svg') }}"
                                                width="170" class="mb-3">
                                            <h3>No completed students found</h3>
                                            <div class="text-secondary">
                                                Students who finish a course will appear here.
                                            </div>
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
@endsection
