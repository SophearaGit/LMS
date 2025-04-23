<div class="tab-pane fade {{ request()->get('step') == 2 ? 'show active' : '' }}" id="pills-profile" role="tabpanel"
    aria-labelledby="pills-profile-tab" tabindex="0">
    <div class="add_course_more_info">
        <form action="" class="more_info_form course_form">
            @csrf
            <input type="hidden" name="course_id" value="{{ $courseId }}">
            <input type="hidden" name="current_step" value="2">
            <input type="hidden" name="next_step" value="3">
            <div class="row">
                <div class="col-xl-6">
                    <div class="add_course_more_info_input">
                        <label for="#">Capacity</label>
                        <input type="text" placeholder="Capacity" name="capacity" value="{{ $course?->capacity }}">
                        <p>leave blank for unlimited</p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_more_info_input">
                        <label for="#">Course Duration (Minutes)*</label>
                        <input type="text" placeholder="300" name="duration" value="{{ $course->duration }}">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_more_info_checkbox">
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
                    </div>
                </div>
                <div class="col-12">
                    <div class="add_course_more_info_input">
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
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="add_course_more_info_radio_box">
                        <h3>Level</h3>
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
                <div class="col-xl-4">
                    <div class="add_course_more_info_radio_box">
                        <h3>Language</h3>
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
                <div class="col-xl-12">
                    <button type="submit" class="common_btn">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        const base_url = $('meta[name="base_url"]').attr('content');
        const update_url = base_url + '/instructor/courses/update-more-info';

        $('.more_info_form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                method: 'POST',
                url: update_url,
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
                        duration: 8000,
                        dismissible: true,
                        position: {
                            x: 'right',
                            y: 'top',
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
@endpush
