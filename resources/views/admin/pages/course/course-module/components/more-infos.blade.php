<div class="tab-pane {{ request()->get('step') == 2 ? 'active' : '' }}" id="more-infos" role="tabpanel">
    <form class="more_infos_form course_form">
        @csrf
        <input type="hidden" name="course_id" value="{{ $courseId }}">
        <input type="hidden" name="current_step" value="2">
        <input type="hidden" name="next_step" value="3">
        <div class="row">
            <div class="col-xl-6">
                {{-- <div class="add_course_more_info_input">
                    <label for="#">Capacity</label>
                    <input type="text" placeholder="Capacity" name="capacity" value="{{ $course?->capacity }}">
                    <p>leave blank for unlimited</p>
                </div> --}}
                <div class="mb-3">
                    <label class="form-label">Capacity</label>
                    <input type="text" class="form-control" name="capacity" placeholder="Enter capacity here."
                        value="{{ $course?->capacity }}">
                    <small class="form-hint">Leave blank for unlimited.</small>
                </div>
            </div>
            <div class="col-xl-6">
                {{-- <div class="add_course_more_info_input">
                    <label for="#">Course Duration (Minutes)*</label>
                    <input type="text" placeholder="300" name="duration" value="{{ $course->duration }}">
                </div> --}}
                <div class="mb-3">
                    <label class="form-label">Course Duration (Minutes)</label>
                    <input type="text" class="form-control" name="duration" placeholder="300"
                        value="{{ $course?->duration }}">
                </div>
            </div>
            <div class="col-xl-6">
                {{-- <div class="add_course_more_info_checkbox">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault"
                            name="qna" @checked($course?->qna === 1)>
                        <label class="form-check-label" for="flexCheckDefault">Q&amp;A</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault2"
                            name="certificate" @checked($course?->certificate === 1)>
                        <label class="form-check-label" for="flexCheckDefault2">Completion Certificate</label>
                    </div>
                </div> --}}
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault"
                            name="qna" @checked($course?->qna === 1)>
                        <span class="form-check-label">
                            Q&amp;A
                        </span>
                        <span class="form-check-description">

                        </span>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault2"
                            name="certificate" @checked($course?->certificate === 1)>
                        <span class="form-check-label">
                            Completion Certificate
                        </span>
                        <span class="form-check-description">
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12">
                {{-- <div class="add_course_more_info_input">
                    <label for="#">Category *</label>
                    <select class="select_2 select2-hidden-accessible" data-select2-id="select2-data-1-s3pg"
                        tabindex="-1" aria-hidden="true" name="category">
                        <option value="" data-select2-id="select2-data-3-nvh3">
                            Please Select </option>
                        @foreach ($categories_for_select as $item)
                            @if ($item->subCategories->isNotEmpty())
                                <optgroup label="{{ $item->name }}">
                                    @foreach ($item->subCategories as $subItem)
                                        <option @selected($course?->category_id === $subItem->id) value="{{ $subItem->id }}">
                                            {{ $subItem->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endif
                        @endforeach
                    </select><span class="select2 select2-container select2-container--default" dir="ltr"
                        data-select2-id="select2-data-2-s4d0" style="width: auto;"><span class="selection">
                </div> --}}
                <div class="mb-3">
                    <div class="form-label">Category</div>
                    <select class="form-select storage select2" name="category">
                        <option value=""> Please Select </option>
                        @foreach ($categories_for_select as $item)
                            @if ($item->subCategories->isNotEmpty())
                                <optgroup label="{{ $item->name }}">
                                    @foreach ($item->subCategories as $subItem)
                                        <option @selected($course?->category_id === $subItem->id) value="{{ $subItem->id }}">
                                            {{ $subItem->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xl-4">
                {{-- <div class="add_course_more_info_radio_box">
                    <h3>Level</h3>
                    @foreach ($course_level_for_check as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="id-{{ $item->id }}" name="level"
                                value="{{ $item->id }}" @checked($item->id == $course->course_level_id)>
                            <label class="form-check-label" for="id-{{ $item->id }}">
                                {{ $item->name }}
                            </label>
                        </div>
                    @endforeach
                </div> --}}
                <div class="mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Level</h3>
                        </div>
                        <div class="card-body">
                            @foreach ($course_level_for_check as $item)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="id-{{ $item->id }}"
                                        name="level" value="{{ $item->id }}" @checked($item->id == $course->course_level_id)>
                                    <label class="form-check-label" for="id-{{ $item->id }}">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                {{-- <div class="add_course_more_info_radio_box">
                    <h3>Language</h3>
                    @foreach ($course_language_for_check as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="id-{{ $item->id }}" name="language"
                                value="{{ $item->id }}" @checked($item->id == $course->course_language_id)>
                            <label class="form-check-label" for="id-{{ $item->id }}">
                                {{ $item->name }}
                            </label>
                        </div>
                    @endforeach
                </div> --}}
                <div class="mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Language</h3>
                        </div>
                        <div class="card-body">
                            @foreach ($course_language_for_check as $item)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="id-{{ $item->id }}"
                                        name="language" value="{{ $item->id }}" @checked($item->id == $course->course_language_id)>
                                    <label class="form-check-label" for="id-{{ $item->id }}">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                    {{-- <button type="submit" class="common_btn">Save</button> --}}
                </div>
            </div>
        </div>
    </form>
</div>
{{-- LIBS --}}
<script src="/admin/assets/dist/js/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // SELECT 2 INITIALIZATION
    $('.select2').select2();
    // SUBMIT FORM BASIC-INFOS VIA AJAX
    const base_admin_url = $('meta[name="base_url"]').attr('content');
    const more_infos_url = base_admin_url + '/admin/courses/update-more-info';

    $('.more_infos_form').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: more_infos_url,
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
