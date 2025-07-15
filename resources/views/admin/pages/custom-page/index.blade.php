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
                        <h3 class="card-title">Custom Pages</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.custom-page.create') }}" class="btn btn-primary">
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
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Show At Navigation</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customPageItems as $customPageItem)
                                        <tr>
                                            <td>
                                                {{ $customPageItem->title }}
                                            </td>
                                            <td>
                                                <code class="text-danger">
                                                    {{ url('/') }}/page/{{ $customPageItem->slug }}
                                                </code>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $customPageItem->show_at_nav === 1 ? 'green' : 'red' }}-lt">
                                                    {{ $customPageItem->show_at_nav === 1 ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $customPageItem->status === 1 ? 'green' : 'red' }}-lt">
                                                    {{ $customPageItem->status === 1 ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.custom-page.edit', $customPageItem->id) }}"
                                                    class="text-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.custom-page.destroy', $customPageItem->id) }}"
                                                    class="text-danger delete-customPageItem">
                                                    <i class="ti ti-trash"></i>
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

        $('.delete-customPageItem').on('click', function(e) {
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
