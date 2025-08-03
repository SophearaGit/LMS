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
    <div class="container-xl">
        <div class="card mt-3">
            <div class="row g-0">
                <form class="">
                    @csrf
                    <div class="col-12 col-md-9=12 d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">
                                Database Clear
                            </h2>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        <div class="d-flex">
                                            <div>
                                                <i class="ti ti-alert-circle me-3" style="font-size: 35px"></i>
                                            </div>
                                            <div>
                                                <h4 class="alert-title">
                                                    Are you sure you want to clear the database?
                                                </h4>
                                                <div class="text-secondary">
                                                    This action will remove all data from the database. Please ensure you
                                                    have a backup before proceeding.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <a href="{{ route('admin.database_clear.clear') }}" class="btn btn-primary btn_clear_db"
                                    type="submit">
                                    <i class="ti ti-skull mb-1" style="font-size: 20px;"></i>&nbsp;
                                    Clear Database
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/front/js/jquery-3.7.1.min.js"></script>
    <script>
        const csrf_token = $(`meta[name=csrf_token]`).attr('content');
        var delete_url = null;

        $('.btn_clear_db').on('click', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            delete_url = url;
            $('#modal-danger').modal('show');
            $('#del_msg').text('Do you really want to clear the database? This action cannot be undone.');
            $('.delete-confirm-btn').text('Clear Database');
        });

        $('.delete-confirm-btn').on('click', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const $btnCancel = $('.btn_cancel');
            const $colBohBtnCancel = $('.col_boh_cancel');
            const $modal = $('#modal-danger');
            $btnCancel.remove();
            $colBohBtnCancel.remove();
            $btn
                .addClass('disabled')
                .css({
                    'pointer-events': 'none',
                    'opacity': 0.6
                })
                .text('Clearing... Please wait until the page reloads.');

            $.ajax({
                method: 'DELETE',
                url: delete_url,
                data: {
                    _token: csrf_token
                },
                success() {
                    location.reload();
                    notyf.success('Database cleared successfully.');
                },
                error(xhr) {
                    const errMsg = xhr.responseJSON?.message || 'Something went wrong';
                    notyf.error(errMsg);
                    $btn.prop('disabled', false).text('Try Again');
                }
            });
        });
    </script>
@endpush
