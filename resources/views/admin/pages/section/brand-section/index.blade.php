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
                        <h3 class="card-title">Brands</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.brand-section.create') }}" class="btn btn-primary">
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
                                        <th>Image</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($brands as $brand)
                                        <tr>
                                            <td>
                                                <div class="d-flex py-1 align-items-center">
                                                    <span class="avatar me-2"
                                                        style="background-image: url({{ $brand->image }})"></span>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $brand->url }}
                                            </td>
                                            <td>
                                                @if ($brand->status == 1)
                                                    <span class="badge bg-green-lt">Active</span>
                                                @else
                                                    <span class="badge bg-red-lt">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.brand-section.edit', $brand->id) }}"
                                                    class="text-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.brand-section.destroy', $brand->id) }}"
                                                    class="text-danger delete-brand">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- TABLE END --}}
                        <div class="mt-4">
                            {{-- {{ $courseLevels->links() }} --}}
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

        $('.delete-brand').on('click', function(e) {
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
