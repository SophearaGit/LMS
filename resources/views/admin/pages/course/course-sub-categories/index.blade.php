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
                        <h3 class="card-title">Course Sub Categories of ({{ $courseCategory->name }})</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-categories.index') }}" class="btn btn-primary">
                                <i class="ti ti-chevrons-left"></i>&nbsp;
                                Back
                            </a>
                            <a href="{{ route('admin.course-sub-categories.create', $courseCategory->id) }}"
                                class="btn btn-primary">
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
                                        <th>Icon</th>
                                        <th>Name</th>
                                        <th>Trending</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subCategories as $item)
                                        <tr>
                                            <td>
                                                @if ($item->icon)
                                                    <i class="{{ $item->icon }} text-2xl"></i>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                @if ($item->show_at_trending)
                                                    <span class="badge bg-blue-lt">Yes</span>
                                                @else
                                                    <span class="badge bg-red-lt">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status)
                                                    <span class="badge bg-blue-lt">Active</span>
                                                @else
                                                    <span class="badge bg-red-lt">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.course-sub-categories.edit', [
                                                    'course_category' => $courseCategory->id,
                                                    'course_sub_category' => $item->id,
                                                ]) }}"
                                                    class="text-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.course-sub-categories.destroy', [
                                                    'course_category' => $courseCategory->id,
                                                    'course_sub_category' => $item->id,
                                                ]) }}"
                                                    class="text-danger delete-item">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- TABLE END --}}
                        <div class="mt-4">
                            {{ $subCategories->links() }}
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
        const csrf_token = $(`meta[name=csrf_token]`).attr('content');
        var delete_url = null;
        var notyf = new Notyf({
            duration: 9000,
        });

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
                    let errMsg = xhr.responseJSON;
                    notyf.error(errMsg.message);
                },
            });
        });
    </script>
@endpush
