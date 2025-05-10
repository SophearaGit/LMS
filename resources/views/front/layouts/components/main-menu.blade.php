<nav class="navbar navbar-expand-lg main_menu main_menu_3">
    <a class="navbar-brand" href="index_3.html">
        <img src="/front/images/logo.png" alt="EduCore" class="img-fluid">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        {{-- <div class="menu_category">
            <div class="icon">
                <img src="/front/images/grid_icon.png" alt="Category" class="img-fluid">
            </div>
            Category
            <ul>
                <li>
                    <a href="#">
                        <span>
                            <img src="/front/images/menu_category_icon_1.png" alt="Category" class="img-fluid">
                        </span>
                        Development
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="/front/images/menu_category_icon_2.png" alt="Category" class="img-fluid">
                        </span>
                        Business
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="/front/images/menu_category_icon_3.png" alt="Category" class="img-fluid">
                        </span>
                        Marketing
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="/front/images/menu_category_icon_4.png" alt="Category" class="img-fluid">
                        </span>
                        Lifestyle
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="/front/images/menu_category_icon_5.png" alt="Category" class="img-fluid">
                        </span>
                        Health & Fitness
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="/front/images/menu_category_icon_6.png" alt="Category" class="img-fluid">
                        </span>
                        Design
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="/front/images/menu_category_icon_7.png" alt="Category" class="img-fluid">
                        </span>
                        Academics
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
            </ul>
        </div> --}}
        <ul class="navbar-nav m-auto">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('courses') ? 'active' : '' }} "
                    href="{{ route('courses') }}">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Courses <i class="far fa-angle-down"></i></a>
                <ul class="droap_menu">
                    <li><a href="courses.html">Courses</a></li>
                    <li><a href="courses_details.html">Course details</a></li>
                    <li><a href="course_video.html">Course video</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">pages <i class="far fa-angle-down"></i></a>
                <ul class="droap_menu">
                    <li><a href="category.html">Categories</a></li>
                    <li><a href="cart_view.html">cart view</a></li>
                    <li><a href="checkout.html">checkout</a></li>
                    <li><a href="payment.html">payment</a></li>
                    <li><a href="pricing.html">pricing</a></li>
                    <li><a href="student_reviews.html">student review</a></li>
                    <li><a href="instructor.html">Instructor</a></li>
                    <li><a href="instructor_details.html">Instructor details</a></li>
                    <li><a href="instructor_finder.html">Instructor finder</a></li>
                    <li><a href="error.html">error</a></li>
                    <li><a href="faq.html">faq</a></li>
                    <li><a href="sign_in.html">sign in</a></li>
                    <li><a href="sign_up.html">sign up</a></li>
                    <li><a href="forum.html">forum</a></li>
                    <li><a href="forum_categories.html">forum Categories</a></li>
                    <li><a href="forum_create_topic.html">forum create topic</a></li>
                    <li><a href="forum_single_topic.html">forum single topic</a></li>
                    <li><a href="dashboard.html">Dashboard</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">blog <i class="far fa-angle-down"></i></a>
                <ul class="droap_menu">
                    <li><a href="blogs.html">blog grid view</a></li>
                    <li><a href="blog_list.html">blog list view</a></li>
                    <li><a href="blog_details.html">blog details</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.html">contact us</a>
            </li>
        </ul>

        <div class="right_menu">
            <div class="menu_search_btn">
                <img src="/front/images/search_icon.png" alt="Search" class="img-fluid">
            </div>
            <ul>
                <li>
                    <a class="menu_signin" href="{{ route('cart.index') }}">
                        <span>
                            <img src="/front/images/cart_icon_black.png" alt="user" class="img-fluid">
                        </span>
                        <b>06</b>
                    </a>
                </li>
                <li>
                    <a class="admin" href="{{ route('admin.login') }}">
                        <span>
                            <img src="/front/images/user_icon_black.png" alt="user" class="img-fluid">
                        </span>
                        admin
                    </a>
                </li>
                <li>
                    <a class="common_btn" href="{{ route('login') }}">Sign In</a>
                </li>
            </ul>
        </div>

    </div>
</nav>
<div class="wsus__menu_3_search_area">
    <form action="#">
        <input type="text" placeholder="Search School, Online.....">
        <button class="common_btn" type="submit">Search</button>
        <span class="close_search"><i class="far fa-times"></i></span>
    </form>
</div>
