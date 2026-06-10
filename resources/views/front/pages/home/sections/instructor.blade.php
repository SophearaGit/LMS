<section class="wsus__become_instructor mt_120 xs_mt_100">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-6 col-md-6 wow fadeInLeft">
                <div class="wsus__become_instructor_text">
                    <div class="wsus__section_heading heading_left mb_20">
                        <h5>{{ $becomeInstructorSectionItems?->label }}</h5>
                        <h2>{{ $becomeInstructorSectionItems?->title }}</h2>
                    </div>
                    {!! $becomeInstructorSectionItems?->description !!}
                    {{-- <a class="common_btn"href="{{ $becomeInstructorSectionItems?->btn_txt_url }}">{{ $becomeInstructorSectionItems?->btn_txt }}
          <i class="far fa-arrow-right"></i>
          </a> --}}
                    @if (auth()->user() != null)
                        @if (auth()->user()->role === 'student')
                            <a class="common_btn" href="/student/profile#section_become_instruction">
                                {{-- {{ $becomeInstructorSectionItems?->btn_txt }} --}}
                                Become an Instructor
                                <i class="far fa-arrow-right"></i>
                            </a>
                        @elseif (auth()->user()->role === 'instructor')
                            <a class="common_btn" href="/instructor/dashboard">
                                {{-- {{ $becomeInstructorSectionItems?->btn_txt }} --}}
                                Manage Your Courses
                                <i class="far fa-arrow-right"></i>
                            </a>
                        @endif
                    @endif
                    @if (auth()->user() == null)
                        <a class="common_btn" href="/register">
                            Make Money Teaching Online
                            <i class="far fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-xl-5 col-md-6 wow fadeInRight">
                <div class="wsus__become_instructor_img">
                    <img src="{{ $becomeInstructorSectionItems?->img }}" alt="Instructor" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>
</section>
