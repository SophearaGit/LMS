<div class="tab-pane {{ request()->get('step') == 4 ? 'active' : '' }}" id="finish" role="tabpanel">
    <form method="POST" class="more_info_form course_form">
        @csrf
        <input type="hidden" name="course_id" value="{{ @$courseId }}">
        <input type="hidden" name="current_step" value="4">
        <div class="row">
            <div class="col-xl-12">
                <div class="add_course_more_info_input">
                    {{-- <label for="#">Message for Reviewer</label>
                    <textarea rows="7" placeholder="Message for Reviewer" name="message_for_reviewer">{!! @$course->message_for_reviewer !!}</textarea> --}}
                    <div class="mb-3">
                        <label class="form-label">Message for Reviewer</label>
                        <textarea class="form-control" data-bs-toggle="autosize" placeholder="Type something…"
                            style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start; height: 59.3333px;"
                            name="message_for_reviewer">{!! @$course->message_for_reviewer !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="add_course_more_info_input mb-0">
                    {{-- <label for="#">Status *</label>
                    <select class="select_2 select2-hidden-accessible" data-select2-id="select2-data-4-01cu"
                        tabindex="-1" aria-hidden="true" required name="status">
                        <option value="" data-select2-id="select2-data-6-9484"> Please Select </option>
                        <option value="active" @selected(@$course->status == 'active')>Active</option>
                        <option value="inactive" @selected(@$course->status == 'inactive')>Inactive</option>
                        <option value="draft" @selected(@$course->status == 'draft')>Draft</option>
                    </select> --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select type="text" class="form-select tomselected ts-hidden-accessible" id="select-users"
                            value="" tabindex="-1" name="status">
                            <option value=""> Please Select </option>
                            <option value="active" @selected(@$course->status == 'active')>Active</option>
                            <option value="inactive" @selected(@$course->status == 'inactive')>Inactive</option>
                            <option value="draft" @selected(@$course->status == 'draft')>Draft</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="add_course_more_info_input mb-0">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        // const base_url = $('meta[name="base_url"]').attr('content');
        // const update_url = base_url + '/instructor/courses/update-more-info';

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
