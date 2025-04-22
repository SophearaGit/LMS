<div class="tab-pane fade {{ Route::is('instructor.courses.edit_basic_info', ['id' => $courseId, 'step' => 1]) || Route::is('instructor.courses.create') ? 'show active' : '' }}"
    id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
    <div class="add_course_basic_info">
        <form action="{{ route('instructor.courses.store_basic_info') }}" method="POST" enctype="multipart/form-data"
            class="basic_info_form course_form">
            @csrf
            <input type="hidden" name="current_step" value="1">
            <input type="hidden" name="next_step" value="2">
            <div class="row">
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Title *</label>
                        <input type="text" placeholder="Title" name="title">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Seo description</label>
                        <input type="text" placeholder="Seo description" name="seo_description">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Thumbnail *</label>
                        <input type="file" name="thumbnail">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Demo Video Storage <b>(optional)</b></label>
                        <select class="select_js" style="display: none;" name="demo_video_storage">
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
                        <label for="#">Path</label>
                        <input type="file" name="demo_video_source">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Price *</label>
                        <input type="text" placeholder="Price" name="price">
                        <p>Put 0 for free</p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_basic_info_imput">
                        <label for="#">Discount Price</label>
                        <input type="text" placeholder="Price" name="discount">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_basic_info_imput mb-0">
                        <label for="#">Description</label>
                        <textarea rows="8" placeholder="Description" name="description"></textarea>
                        <button type="submit" class="common_btn mt_20">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
    tabindex="0">
    <div class="add_course_content">
        <div class="add_course_content_btn_area d-flex flex-wrap justify-content-between">
            <a class="common_btn" href="#">Add New Chapter</a>
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
                            <div class="btn btn-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-plus" aria-hidden="true"></i>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Add Lesson</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Add
                                        Document</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Add Quiz</a>
                                </li>
                            </ul>
                        </div>
                        <a class="edit" href="#"><i class="far fa-edit" aria-hidden="true"></i></a>
                        <a class="del" href="#"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                    </div>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show"
                    data-bs-parent="#accordionExample">
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
                            <div class="btn btn-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-plus" aria-hidden="true"></i>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Add Lesson</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Add
                                        Document</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Add Quiz</a>
                                </li>
                            </ul>
                        </div>
                        <a class="edit" href="#"><i class="far fa-edit" aria-hidden="true"></i></a>
                        <a class="del" href="#"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                    </div>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
                            <div class="btn btn-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-plus" aria-hidden="true"></i>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Add Lesson</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Add
                                        Document</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Add Quiz</a>
                                </li>
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
</div> --}}
{{-- <div class="tab-pane fade" id="pills-contact2" role="tabpanel" aria-labelledby="pills-contact-tab2"
    tabindex="0">
    <div class="dashboard_add_course_finish">
        <form action="#">
            <div class="row">
                <div class="col-xl-12">
                    <div class="add_course_more_info_input">
                        <label for="#">Message for Reviewer</label>
                        <textarea rows="7" placeholder="Message for Reviewer"></textarea>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="add_course_more_info_input mb-0">
                        <label for="#">Status *</label>
                        <select class="select_2 select2-hidden-accessible" data-select2-id="select2-data-4-tekm"
                            tabindex="-1" aria-hidden="true">
                            <option value="" data-select2-id="select2-data-6-6qrx">
                                Please Select </option>
                            <option value="">Red</option>
                            <option value="">Black</option>
                            <option value="">Orange</option>
                            <option value="">Rose Gold</option>
                            <option value="">Pink</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr"
                            data-select2-id="select2-data-5-gch5" style="width: auto;"><span
                                class="selection"><span class="select2-selection select2-selection--single"
                                    role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                    aria-disabled="false" aria-labelledby="select2-lyan-container"
                                    aria-controls="select2-lyan-container"><span
                                        class="select2-selection__rendered" id="select2-lyan-container"
                                        role="textbox" aria-readonly="true" title=" Please Select ">
                                        Please Select </span><span class="select2-selection__arrow"
                                        role="presentation"><b role="presentation"></b></span></span></span><span
                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                        <button type="submit" class="common_btn mt_25">save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> --}}
@push('scripts')
    <script>
        const base_url = $('meta[name="base_url"]').attr('content');
        const basic_info_url = base_url + '/instructor/courses/store-basic-info';

        $('.basic_info_form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                method: 'POST',
                url: basic_info_url,
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

                },
                complete: function() {

                }
            });
        });
    </script>


@endpush
