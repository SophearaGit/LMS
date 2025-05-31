<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">lesson</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        {{-- @php
            dd(@$lesson);
        @endphp --}}
    </div>
    <div class="modal-body">
        <form
            action="{{ @$on_edit == true
                ? route('admin.course-content.update-lesson', @$lesson?->id)
                : route('admin.course-content.store-lesson') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="hidden" name="course_id" value="{{ $course_id }}">
                <input type="hidden" name="chapter_id" value="{{ $chapter_id }}">
                <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" required
                            value="{{ @$lesson?->title }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="source" class="form-label">Source</label>
                        <select class="form-select storage" aria-label="Default select example" name="storage" required>
                            <option selected>Select</option>
                            @foreach (config('course.video_source') as $item => $name)
                                <option value="{{ $item }}" @selected($item == @$lesson?->storage)>{{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="add_course_basic_info_imput">
                            <div class="upload_source {{ @$lesson?->storage == 'upload' ? '' : 'd-none' }} mt-2">
                                <label for="#" class=""><strong>Path</strong></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control inps_path" type="text" name="file_path"
                                        value="{{ @$lesson?->file_path }}">
                                </div>
                            </div>
                            <div class="link_source {{ @$lesson?->storage != 'upload' ? '' : 'd-none' }} mt-2">
                                <label for="#" class="form-lebel">Path</label>
                                <input type="text" name="url" placeholder="Please provide link here."
                                    class="form-control inps_path" value="{{ @$lesson?->file_path }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="file_type" class="form-label">File Type</label>
                        <select class="form-select" aria-label="Default select example" name="file_type">
                            <option selected>Select</option>
                            @foreach (config('course.file_types') as $item => $name)
                                <option value="{{ $item }}" @selected($item == @$lesson?->file_type)>{{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="text" class="form-control" name="duration" id="duration"
                            value="{{ @$lesson?->duration }}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-check-label" for="is_preview">Is Prview</label>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_preview"
                                    name="is_preview" value="1" @checked(@$lesson?->is_preview)>&nbsp;
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-check-label" for="downloadable">Downloadable</label>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="downloadable"
                                    name="downloadable" value="1" @checked(@$lesson?->downloadable)>&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3 ">
                        <textarea style="height: 200px" class="form-control" placeholder="Leave a comment here" id=""
                            name="description">{!! @$lesson?->description !!}</textarea>
                        <label for="">Description</label>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">{{ @$on_edit == true ? 'Update' : 'Create' }}</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#lfm').filemanager('file', {
        prefix: '/admin/laravel-filemanager'
    });
    // CHANGE INPUT BASE ON STORAGE
    $(document).ready(function() {
        $(document).on('change', '.storage', function() {
            let storage_val = $(this).val();
            $('.inps_path').val('');
            if (storage_val == 'upload') {
                $('.upload_source').removeClass('d-none');
                $('.link_source').addClass('d-none');
            } else {
                $('.upload_source').addClass('d-none');
                $('.link_source').removeClass('d-none');
            }
        });
    })
</script>
