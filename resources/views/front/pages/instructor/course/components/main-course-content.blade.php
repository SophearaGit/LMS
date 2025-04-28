<div class="tab-pane fade {{ request()->get('step') == 3 ? 'active show' : '' }}" id="pills-contact" role="tabpanel"
    aria-labelledby="pills-contact-tab" tabindex="0">
    <form action="" class="more_info_form course_form">
        @csrf
        <input type="hidden" name="course_id" value="{{ $courseId }}">
        <input type="hidden" name="current_step" value="3">
        <input type="hidden" name="next_step" value="4">
    </form>
    <div class="add_course_content">
        <div class="add_course_content_btn_area d-flex flex-wrap justify-content-between">
            <a class="common_btn add_course_chapter_btn" href="#" data-id="{{ $courseId }}">Add New
                Chapter</a>
            <a class="common_btn" href="#">Short Chapter</a>
        </div>
        <div class="accordion" id="accordionExample">
            @forelse ($chapters as $chapter)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $chapter->id }}" aria-expanded="true"
                            aria-controls="collapse-{{ $chapter->id }}">
                            <span>{{ $chapter->title }}</span>
                        </button>
                        <div class="add_course_content_action_btn">
                            <div class="dropdown">
                                <div class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="far fa-plus" aria-hidden="true"></i>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                    <li><a class="add-lesson-btn dropdown-item" href="javascript:;"
                                            data-course-id="{{ $courseId }}"
                                            data-chapter-id="{{ $chapter->id }}">Add
                                            Lesson</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Add Document</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Add Quiz</a></li>
                                </ul>
                            </div>
                            <a class="edit edit-chapter-btn" href="javascript:;" data-course-id="{{ $courseId }}"
                                data-chapter-id="{{ $chapter->id }}"><i class="far fa-edit" aria-hidden="true"></i></a>
                            <a class="del btn_dynamic_delete"
                                href="{{ route('instructor.course-content.delete-chapter', $chapter->id) }}"><i
                                    class="fas fa-trash-alt" aria-hidden="true"></i></a>
                        </div>
                    </h2>
                    <div id="collapse-{{ $chapter->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#accordionExample" style="">
                        <div class="accordion-body">
                            <ul class="item_list sortable_list">
                                @forelse ($chapter->lessons ?? [] as $lesson)
                                    <li data-lesson-id="{{ $lesson->id }}" data-chapter-id="{{ $chapter->id }}">
                                        <span>{{ $lesson->title }}</span>
                                        <div class="add_course_content_action_btn">
                                            <a class="edit_lesson" href="javascript:;"
                                                data-course-id="{{ $courseId }}"
                                                data-chapter-id="{{ $chapter->id }}"
                                                data-lesson-id="{{ $lesson->id }}"><i
                                                    class="far
                                                fa-edit"
                                                    aria-hidden="true"></i></a>
                                            <a class="del btn_dynamic_delete"
                                                href="{{ route('instructor.course-content.delete-lesson', $lesson->id) }}"><i
                                                    class="fas fa-trash-alt" aria-hidden="true"></i></a>
                                            <a class="arrow dragger" href="javascript:;"><i class="fas fa-arrows-alt"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                    </li>
                                @empty
                                    <div class="alert alert-light" role="alert">
                                        NO AVAILABLE LESSON YET!
                                    </div>
                                @endforelse
                            </ul>
                            {{-- <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapse-{{ $chapter->id }}" aria-expanded="false"
                                            aria-controls="flush-collapse-{{ $chapter->id }}">
                                            <span>Accordion Item #1</span>
                                        </button>
                                        <div class="add_course_content_action_btn">
                                            <div class="dropdown">
                                                <div class="btn btn-secondary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="far fa-plus" aria-hidden="true"></i>
                                                </div>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#">Add Lesson</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Add Document</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Add Quiz</a></li>
                                                </ul>
                                            </div>
                                            <a class="edit" href="#"><i class="far fa-edit"
                                                    aria-hidden="true"></i></a>
                                            <a class="del" href="#"><i class="fas fa-trash-alt"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                    </h2>
                                    <div id="flush-collapse-{{ $chapter->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for
                                            this accordion, which is intended to demonstrate
                                            the <code>.accordion-flush</code> class. This is
                                            the first item's accordion body.</div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-light mt-3" role="alert">
                    NO AVAILABLE CHAPTER YET!
                </div>
            @endforelse
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="/front/js/jquery-ui.min.js"></script>
    <script>
        const base_url = $('meta[name="base_url"]').attr('content');
        const get_course_content_url = base_url + `/instructor/course-content/:id/create-chapter`;
        const update_url = base_url + '/instructor/courses/update-more-info';

        let modalLoader = `
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        // DOWN BLOCK IS FOOR REQUESTING THE DYNAMIC MODAL
        $('.add_course_chapter_btn').on('click', function(e) {
            e.preventDefault();
            $('#dynamic_modal').modal('show');
            let course_id = $(this).data('id');
            $.ajax({
                method: 'GET',
                url: get_course_content_url.replace(':id', course_id),
                data: {},
                beforeSend: function() {
                    $('.dynamic-modal-content').html(modalLoader);
                },
                success: function(data) {
                    $('.dynamic-modal-content').html(data);
                },
                error: function(xhr, status, error) {

                },
            })
        })
        // DOWN HERE IS FOR SUBMITING THE FORM
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
        // GET DYNAMIC MODAL TO ADD LESSON TO CHAPTER
        $('.edit-chapter-btn').on('click', function() {
            $('#dynamic_modal').modal('show');
            let course_id = $(this).data('course-id');
            let chapter_id = $(this).data('chapter-id');
            let get_edit_chapter_url = base_url + '/instructor/course-content/:course_id/edit-chapter';

            $.ajax({
                method: 'GET',
                url: get_edit_chapter_url.replace('course_id', course_id),
                data: {
                    'course_id': course_id,
                    'chapter_id': chapter_id,
                },
                beforeSend: function() {
                    $('.dynamic-modal-content').html(modalLoader);
                },
                success: function(data) {
                    $('.dynamic-modal-content').html(data);
                },
                error: function(xhr, status, error) {

                },
            })
        })
        // GET DYNAMIC MODAL TO ADD LESSON TO CHAPTER
        $('.add-lesson-btn').on('click', function() {
            // e.preventDefault();
            $('#dynamic_modal').modal('show');
            let course_id = $(this).data('course-id');
            let chapter_id = $(this).data('chapter-id');

            $.ajax({
                method: 'GET',
                url: base_url + '/instructor/course-content/create-lesson',
                data: {
                    'course_id': course_id,
                    'chapter_id': chapter_id,
                },
                beforeSend: function() {
                    $('.dynamic-modal-content').html(modalLoader);
                },
                success: function(data) {
                    $('.dynamic-modal-content').html(data);
                },
                error: function(xhr, status, error) {

                },
            })
        })
        // EDIT LESSON PART
        $('.edit_lesson').on('click', function() {
            // e.preventDefault();
            $('#dynamic_modal').modal('show');
            let course_id = $(this).data('course-id');
            let chapter_id = $(this).data('chapter-id');
            let lesson_id = $(this).data('lesson-id');

            $.ajax({
                method: 'GET',
                url: base_url + '/instructor/course-content/edit-lesson',
                data: {
                    'course_id': course_id,
                    'chapter_id': chapter_id,
                    'lesson_id': lesson_id,
                },
                beforeSend: function() {
                    $('.dynamic-modal-content').html(modalLoader);
                },
                success: function(data) {
                    $('.dynamic-modal-content').html(data);
                },
                error: function(xhr, status, error) {

                },
            })
        })
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
        // const csrf_token = $('meta[name="csrf-token"]').attr('content');
        // SORTABLE LIST
        if ($('.sortable_list li').length) {
            $('.sortable_list').sortable({
                items: "li",
                containment: "parent",
                cursor: "move",
                handle: ".dragger",
                update: function(event, ui) {
                    let orderIds = $(this).sortable("toArray", {
                        attribute: "data-lesson-id"
                    })
                    let chapterIds = ui.item.data("chapter-id")
                    $.ajax({
                        method: "POST",
                        url: base_url + `/instructor/course-chapter/${chapterIds}/sort-lesson`,
                        data: {
                            _token: csrf_token,
                            order_ids: orderIds,
                        },
                        success: function(data) {
                            const notyf = new Notyf({
                                duration: 8000,
                                dismissible: true,
                                position: {
                                    x: 'right',
                                    y: 'bottom',
                                },
                            });
                            notyf.success(data.message);
                        },
                        error: function(xhr, status, error) {

                        },
                    })
                }
            });
        }

        // DELETE PART
        $('.btn_dynamic_delete').on('click', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "DELETE",
                        url: url,
                        data: "",
                        success: function(data) {},
                        error: function(xhr, status, data) {},
                    })
                }
            });
        })
    </script>
@endpush
