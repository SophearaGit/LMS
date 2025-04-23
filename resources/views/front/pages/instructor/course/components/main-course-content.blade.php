<div class="tab-pane fade {{ request()->get('step') == 3 ? 'active show' : '' }}" id="pills-contact" role="tabpanel"
    aria-labelledby="pills-contact-tab" tabindex="0">
    <div class="add_course_content">
        <div class="add_course_content_btn_area d-flex flex-wrap justify-content-between">
            <a class="common_btn add_course_chapter_btn" href="#" data-id="{{ $courseId }}">Add New Chapter</a>
            <a class="common_btn" href="#">Short Chapter</a>
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span>Introduction</span>
                    </button>
                    <div class="add_course_content_action_btn">
                        <div class="dropdown">
                            <div class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="far fa-plus" aria-hidden="true"></i>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                <li><a class="dropdown-item" href="#">Add Lesson</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Add Document</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Add Quiz</a></li>
                            </ul>
                        </div>
                        <a class="edit" href="#"><i class="far fa-edit" aria-hidden="true"></i></a>
                        <a class="del" href="#"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                    </div>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample"
                    style="">
                    <div class="accordion-body">
                        <ul class="item_list">
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit" aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit" aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit" aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit" aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                        </ul>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                        aria-expanded="false" aria-controls="flush-collapseOne">
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
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for
                                        this accordion, which is intended to demonstrate
                                        the <code>.accordion-flush</code> class. This is
                                        the first item's accordion body.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <span>Data Structures and Algorithms in Python</span>
                    </button>
                    <div class="add_course_content_action_btn">
                        <div class="dropdown">
                            <div class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
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
                        <a class="edit" href="#"><i class="far fa-edit" aria-hidden="true"></i></a>
                        <a class="del" href="#"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                    </div>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample"
                    style="">
                    <div class="accordion-body">
                        <ul class="item_list">
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                        </ul>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                        aria-expanded="false" aria-controls="flush-collapseTwo">
                                        <span>Accordion Item #2</span>
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for
                                        this accordion, which is intended to demonstrate
                                        the <code>.accordion-flush</code> class. This is
                                        the second item's accordion body. Let's imagine
                                        this being filled with some actual content.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree2" aria-expanded="false" aria-controls="collapseThree2">
                        <span>Data Analysis with Pandas</span>
                    </button>
                    <div class="add_course_content_action_btn">
                        <div class="dropdown">
                            <div class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
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
                        <a class="edit" href="#"><i class="far fa-edit" aria-hidden="true"></i></a>
                        <a class="del" href="#"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                    </div>
                </h2>
                <div id="collapseThree2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul class="item_list">
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            <li>
                                <span>Aut autem dolorem debitis mollitia.</span>
                                <div class="add_course_content_action_btn">
                                    <a class="edit" href="#"><i class="far fa-edit"
                                            aria-hidden="true"></i></a>
                                    <a class="del" href="#"><i class="fas fa-trash-alt"
                                            aria-hidden="true"></i></a>
                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                        </ul>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                        aria-expanded="false" aria-controls="flush-collapseThree">
                                        <span>Accordion Item #3</span>
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for
                                        this accordion, which is intended to demonstrate
                                        the <code>.accordion-flush</code> class. This is
                                        the third item's accordion body. Nothing more
                                        exciting happening here in terms of content, but
                                        just filling up the space to make it look, at
                                        least at first glance, a bit more representative
                                        of how this would look in a real-world
                                        application.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        const base_url = $('meta[name="base_url"]').attr('content');
        const get_course_content_url = base_url + `/instructor/course-content/:id/create-chapter`;

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
    </script>
@endpush
