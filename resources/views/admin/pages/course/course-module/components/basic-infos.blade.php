<div class="tab-pane {{ request()->get('step') == 1 || Route::is('admin.courses.create') ? 'active' : '' }}"
    id="basic-infos" role="tabpanel">
    <form class="basic_infos_form course-tab">
        @csrf
        <input type="hidden" name="current_step" value="1">
        <input type="hidden" name="next_step" value="2">
        <div class="row">
            <div class="col-xl-6">
                <div class="mb-3">
                    <div class="form-label">Instructor</div>
                    <select class="form-select storage select2" name="instructor_id">
                        <option value=""> Please Select </option>
                        @foreach ($instructors as $instructor)
                            <option value="{{ $instructor->id }}">{{ $instructor->name }} - {{ $instructor->email }}
                            </option>
                        @endforeach
                    </select>
                    <small class="form-hint">Select to assign this course to specific instructor.</small>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter title here.">
                </div>
            </div>
            <div class="col-xl-12">
                <div class="mb-3">
                    <label class="form-label">Seo description</label>
                    <input type="text" class="form-control" name="seo_description"
                        placeholder="Enter seo description here.">
                </div>
            </div>
            <div class="col-xl-12">
                <div class="mb-3">
                    <label class="form-label">Thumbnail</label>
                    <input type="file" class="form-control" name="thumbnail">
                </div>
            </div>
            <div class="col-xl-6">
                <div class="mb-3">
                    <div class="form-label">Demo Video Storage <b>(optional)</b></div>
                    <select class="form-select storage select2" name="demo_video_storage">
                        <option value=""> Please Select </option>
                        <option value="upload">Upload</option>
                        <option value="youtube">Youtube</option>
                        <option value="vimeo">Vimeo</option>
                        <option value="external_link">External Link</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="add_course_basic_info_imput">
                    <div class="upload_source">
                        <label class="form-label">Path</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                    Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control inps_path" type="text" name="filepath">
                        </div>
                    </div>
                    <div class="link_source d-none">
                        <div class="mb-3">
                            <label class="form-label">Path</label>
                            <input type="text" class="form-control inps_path" name="demo_video_source"
                                placeholder="Provide video link here.">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Enter price here.">
                    <small class="form-hint">Put 0 for free course.</small>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="mb-3">
                    <label class="form-label">Discount Price</label>
                    <input type="text" class="form-control" name="discount" placeholder="Enter discount price here.">
                </div>
            </div>
            <div class="col-xl-12">
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="8" placeholder="Enter description here."></textarea>
                </div>
            </div>
            <div class="col-xl-12">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
</div>
{{-- LIBS --}}
<script src="/admin/assets/dist/js/jquery-3.7.1.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // LARAVEL FILE MANAGEER INITIALIZATION
    $('#lfm').filemanager('file', {
        prefix: '/admin/laravel-filemanager'
    });
    // SELECT 2 INITIALIZATION
    $('.select2').select2();
    // CHANGE INPUT PATH BASE ON SELECTED STORAGE
    $('.storage').on('change', function() {
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
    // SUBMIT FORM BASIC-INFOS VIA AJAX
    const base_admin_url = $('meta[name="base_url"]').attr('content');
    const basic_infos_url = base_admin_url + '/admin/courses/store-basic-info';

    $('.basic_infos_form').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: basic_infos_url,
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {

            },
            success: function(data) {
                if (data.status == 'success') {
                    window.location.href = data.redirect;
                }
            },
            error: function(xhr, status, error) {
                let errors = xhr.responseJSON.errors;
                const notyf = new Notyf({
                    duration: 7000,
                    dismissible: true,
                    position: {
                        x: 'right',
                        y: 'bottom',
                    },
                });
                $.each(errors, function(key, value) {
                    notyf.error(value[0])
                })
            },
            complete: function() {

            }
        });
    });
</script>
