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

        .certificate-body {
            height: 600px;
            width: 930px;
            background-image: url('{{ $certificate?->background }}');
            background-size: cover;
            background-position: center;
            text-align: center
        }

        .certificate-body div {
            /* display: inline-block; */
            cursor: move;
        }

        .certificate-body .title {
            font-size: 20px;
            font-weight: 600;
        }

        .certificate-body .subtitle {
            font-size: 18px;
            font-weight: 400;
        }

        .certificate-body .signature img {
            width: 120px;
            height: 100px;
        }

        @foreach ($certificateItems as $item)
            #{{ $item->element_id }} {
                left: {{ $item->x_position }}px;
                top: {{ $item->y_position }}px;
            }
        @endforeach;
    </style>
@endpush
@section('content')
    <div class="container-xl mt-4">
        <div class="row row-cards">
            <div class="col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-capitalize">certificate content</h3>

                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary">
                            <h4 class="alert-heading">
                                Default Variables
                            </h4>
                            <p>[student_name], [course_name], [date], [plateform_name], [instructor_name]</p>
                        </div>
                        <form action="{{ route('admin.certificate-builder.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter title here." value="{{ $certificate?->title }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <label for="subtitle" class="form-label">Subtitle</label>
                                <input type="text" class="form-control" id="subtitle" name="subtitle"
                                    placeholder="Enter subtitle here." value="{{ $certificate?->subtitle }}">
                                <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter description here.">{!! $certificate?->description !!}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <label for="background" class="form-label">Background Image</label>
                                @if ($certificate->background)
                                    <div class="row mb-1">
                                        <div class="col-6">
                                            <x-image-preview :image="$certificate->background" />
                                        </div>
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="background" name="background">
                                <x-input-error :messages="$errors->get('background')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <label for="signature" class="form-label">Signature Image</label>
                                @if ($certificate->signature)
                                    <div class="row mb-1">
                                        <div class="col-6">
                                            <x-image-preview :image="$certificate->signature" />
                                        </div>
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="signature" name="signature">
                                <x-input-error :messages="$errors->get('signature')" class="mt-2" />
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-capitalize">certificate builder</h3>

                    </div>
                    <div class="card-body">
                        <div class="certificate-body">
                            <div id="title" class="title draggable-element">{{ $certificate?->title }}</div>
                            <div id="subtitle" class="subtitle draggable-element">{{ $certificate?->subtitle }}</div>
                            <div id="description" class="description draggable-element">{!! $certificate?->description !!}</div>
                            <div id="signature" class="signature draggable-element">
                                <img src="{{ $certificate?->signature }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/front/js/jquery-3.7.1.min.js"></script>
    <script src="/admin/assets/dist/js/jquery-ui.min.js"></script>
    <script>
        const csrf_token = $(`meta[name=csrf_token]`).attr('content');
        const base_url = $(`meta[name=base_url]`).attr('content');

        var delete_url = null;

        $('.delete-payoutGateway').on('click', function(e) {
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

        $(function() {
            $('.draggable-element').draggable({
                containment: ".certificate-body",
                stop: function(event, ui) {
                    var dragElId = $(this).attr('id');
                    var posX = ui.position.left;
                    var posY = ui.position.top;

                    $.ajax({
                        method: 'POST',
                        url: `${base_url}/admin/certificate-builder/update-position`,
                        data: {
                            _token: csrf_token,
                            element_id: dragElId,
                            position_x: posX,
                            position_y: posY,
                        },
                        beforeSend: function() {},
                        success: function(data) {},
                        error: function(xhr, status, error) {}
                    })
                }
            });
        });
    </script>
@endpush
