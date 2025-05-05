{{-- <div class="tab-pane fade {{ request()->get('step') == 3 ? 'active show' : '' }}" id="pills-contact" role="tabpanel"
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
            <a class="common_btn short_chapter_btn" data-course-id="{{ $courseId }}" href="javascript:;">Short
                Chapter</a>
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
                                </ul>
                            </div>
                            <a class="edit edit-chapter-btn" href="javascript:;" data-course-id="{{ $courseId }}"
                                data-chapter-id="{{ $chapter->id }}"><i class="far fa-edit"
                                    aria-hidden="true"></i></a>
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
                                                data-course-id="{{ $course->id }}"
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

        $('.short_chapter_btn').on('click', function(e) {
            e.preventDefault();

            $('#dynamic_modal').modal('show');
            $('#dynamic_modal').attr('data-bs-backdrop', 'static');

            let course_id = $(this).data('course-id');
            $.ajax({
                method: 'GET',
                url: base_url + `/instructor/course-content/${course_id}/sort-chapter`,
                data: {},
                beforeSend: function() {
                    $('.dynamic-modal-content').html(modalLoader);
                },
                success: function(data) {
                    $('.dynamic-modal-content').html(data);
                },
                error: function(xhr, status, error) {
                    notyf.error(error);
                },
            })
        })
    </script>
@endpush --}}

<style>
    .add_course_content_action_btn {
        margin-top: 10px;
        display: inline-flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 5px 10px;
        position: absolute;
        top: 6px;
        right: 50px;
        z-index: 9;
    }

    .add_course_content .accordion-header {
        position: relative;
    }

    .add_course_content .item_list li {
        color: var(--colorBlack);
        font-size: 18px;
        font-weight: 500;
        border-radius: 8px;
        border: 1px solid var(--borderColor);
        padding: 13px 50px 13px 55px;
        position: relative;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        -ms-border-radius: 8px;
        -o-border-radius: 8px;
    }

    .add_course_content .item_list li span {
        color: var(--colorBlack);
        font-size: 18px;
        font-weight: 500;
    }

    .add_course_content .item_list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .accordion-item .accordion-body {
        padding: 10px 20px;
        color: var(--paraColor);
        font-size: 15px;
        font-weight: 400;
        line-height: 26px;
    }

    .item_list.sortable_list {
        list-style-type: none;
    }

    .item_list.sortable_list li span {
        font-size: 15px;
    }

    .item_list.sortable_list li {
        border: 1px solid gainsboro;
    }

    .add_course_content .item_list li::before {
        position: absolute;
        content: "📽️";
        font-family: "";
        font-size: 16px;
        font-weight: 600;
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        background: var(--colorPrimary);
        color: var(--colorWhite);
        top: 7px;
        left: 12px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;
    }
</style>


<div class="tab-pane {{ request()->get('step') == 3 ? 'active' : '' }}" id="basic-infos" role="tabpanel">
    <form action="" class="course_content_form course_form">
        @csrf
        <input type="hidden" name="course_id" value="{{ $courseId }}">
        <input type="hidden" name="current_step" value="3">
        <input type="hidden" name="next_step" value="4">
    </form>
    <div class="add_course_content">
        <div class="add_course_content_btn_area d-flex flex-wrap justify-content-between mb-3">
            <a href="javascript:;" class="btn btn-primary btn-pill add_course_chapter_btn"
                data-id="{{ $courseId }}">
                Add New
                Chapter
            </a>
            <a href="javascript:;" class="btn btn-primary btn-pill short_chapter_btn"
                data-course-id="{{ $courseId }}">
                Short
                Chapter
            </a>
        </div>
        <div class="accordion" id="accordion-example">
            @forelse ($chapters as $chapter)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $chapter->id }}" aria-expanded="false">
                            {{ $chapter->title }}
                        </button>
                        <div class="add_course_content_action_btn mt-1">
                            <div class="dropdown">
                                <div class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ti ti-plus" aria-hidden="true"></i>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                    <li><a class="add-lesson-btn dropdown-item" href="javascript:;"
                                            data-course-id="{{ $courseId }}"
                                            data-chapter-id="{{ $chapter->id }}">Add
                                            Lesson</a>
                                    </li>
                                </ul>
                            </div>
                            <a class="edit edit-chapter-btn" href="javascript:;" data-course-id="{{ $courseId }}"
                                data-chapter-id="{{ $chapter->id }}"><i class="ti ti-edit" aria-hidden="true"></i></a>
                            <a class="del delete-item"
                                href="{{ route('admin.course-content.delete-chapter', $chapter->id) }}"><i
                                    class="ti ti-trash text-danger" aria-hidden="true"></i></a>
                        </div>
                    </h2>
                    <div id="collapse-{{ $chapter->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#accordion-example" style="">
                        <div class="accordion-body p-3">
                            <ul class="item_list sortable_list">
                                @forelse ($chapter->lessons ?? [] as $lesson)
                                    <li data-lesson-id="{{ $lesson->id }}" data-chapter-id="{{ $chapter->id }}">
                                        <span>{{ $lesson->title }}</span>
                                        <div class="add_course_content_action_btn" style="right: 10px;">
                                            <a class="edit_lesson" href="javascript:;"
                                                data-course-id="{{ $course->id }}"
                                                data-chapter-id="{{ $chapter->id }}"
                                                data-lesson-id="{{ $lesson->id }}"><i
                                                    class="ti
                                                ti-edit text-black"
                                                    aria-hidden="true"></i></a>
                                            <a class="del delete-item"
                                                href="{{ route('admin.course-content.delete-lesson', $lesson->id) }}"><i
                                                    class="ti ti-trash text-danger" aria-hidden="true"></i></a>
                                            <a class="arrow dragger" href="javascript:;"><i
                                                    class="ti ti-arrows-move text-primary" aria-hidden="true"></i></a>
                                        </div>
                                    </li>
                                @empty
                                    <span class="text-danger"> NO AVAILABLE LESSON YET!</span>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <span class="text-danger"> NO AVAILABLE CHAPTER YET!</span>
            @endforelse
        </div>
    </div>
</div>
{{-- LIBS --}}
<script src="/admin/assets/dist/js/jquery-3.7.1.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/admin/assets/dist/js/jquery-ui.min.js"></script>

<script>
    // VARIABLE URL NEEDED
    const base_admin_url = $('meta[name="base_url"]').attr('content');

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

    // LOADER MODAL
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
    // ADD CHAPTER
    $('.add_course_chapter_btn').on('click', function(e) {
        e.preventDefault();
        $('#dynamic_modal').modal('show');
        let course_id = $(this).data('id');
        $.ajax({
            method: 'GET',
            url: base_admin_url + `/admin/course-content/${course_id}/create-chapter`,
            data: {

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
    // ADD LESSON
    $('.add-lesson-btn').on('click', function() {
        // e.preventDefault();
        $('#dynamic_modal').modal('show');
        let course_id = $(this).data('course-id');
        let chapter_id = $(this).data('chapter-id');

        $.ajax({
            method: 'GET',
            url: base_admin_url + '/admin/course-content/create-lesson',
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
    // EDIT LESSON
    $('.edit_lesson').on('click', function() {
        // e.preventDefault();
        $('#dynamic_modal').modal('show');
        let course_id = $(this).data('course-id');
        let chapter_id = $(this).data('chapter-id');
        let lesson_id = $(this).data('lesson-id');

        $.ajax({
            method: 'GET',
            url: base_admin_url + '/admin/course-content/edit-lesson',
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
    // SHORT CHAPTER
    $('.short_chapter_btn').on('click', function(e) {
        e.preventDefault();

        $('#dynamic_modal').modal('show');
        $('#dynamic_modal').attr('data-bs-backdrop', 'static');

        let course_id = $(this).data('course-id');
        $.ajax({
            method: 'GET',
            url: base_admin_url + `/admin/course-content/${course_id}/sort-chapter`,
            data: {},
            beforeSend: function() {
                $('.dynamic-modal-content').html(modalLoader);
            },
            success: function(data) {
                $('.dynamic-modal-content').html(data);
            },
            error: function(xhr, status, error) {
                notyf.error(error);
            },
        })
    })
    // SORT LESSON
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
                    url: base_admin_url + `/admin/course-chapter/${chapterIds}/sort-lesson`,
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
    // GET DYNAMIC MODAL TO ADD LESSON TO CHAPTER
    $('.edit-chapter-btn').on('click', function() {
        $('#dynamic_modal').modal('show');
        let course_id = $(this).data('course-id');
        let chapter_id = $(this).data('chapter-id');
        $.ajax({
            method: 'GET',
            url: base_admin_url + `/admin/course-content/${course_id}/edit-chapter`,
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
</script>
