<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CourseStoreBasicInfoRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use App\Traites\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    use FileUpload;
    /**
     * SHOW INSTRUCTOR COURSE PAGE
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'EduCore | Courses',
            'courses' => Course::all(),
        ];
        return view('front.pages.instructor.course.index', $data);
    }
    /**
     * SHOW INSTRUCTOR COURSE CREATE PAGE
     */
    public function create(Request $request)
    {
        $data = [
            'pageTitle' => 'EduCore | Create Course',
            'courseId' => $request->id,
            'step' => $request->next_step,
        ];
        return view('front.pages.instructor.course.create', $data);
    }
    /**
     * STORE BASIC INFO
     */
    public function storeBasicInfo(CourseStoreBasicInfoRequest $request)
    {
        $thumbnailPath = $this->uploadFile($request->file('thumbnail'));
        $course = new Course();
        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->seo_description = $request->seo_description;
        $course->thumbnail = $thumbnailPath;
        $course->demo_video_storage = $request->demo_video_storage;
        $course->demo_video_source = $request->demo_video_source;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->description = $request->description;
        $course->instructor_id = Auth::guard('web')->user()->id;
        $course->save();
        // save course id on session
        Session::put('course_create_id', $course->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated successfully',
            'redirect' => route('instructor.courses.edit_basic_info', ['id' => $course->id, 'step' => $request->next_step])
        ]);
    }
    /**
     * SHOW INSTRUCTOR COURSE EDIT BASIC INFO PAGE
     */
    public function editBasicInfo(Request $request)
    {
        switch ($request->step) {
            case '1':
                $data = [
                    'pageTitle' => 'EduCore | Edit Course',
                    'courseId' => $request->id,
                    'step' => $request->next_step,
                    'course' => Course::findOrFail($request->id),
                ];
                return view('front.pages.instructor.course.edit', $data);
            case '2':
                # code...
                $data = [
                    'pageTitle' => 'EduCore | Edit Course',
                    'courseId' => $request->id,
                    'step' => $request->next_step,
                    'categories_for_select' => CourseCategory::where('status', 1)->get(),
                    'course_level_for_check' => CourseLevel::all(),
                    'course_language_for_check' => CourseLanguage::all(),
                    'course' => Course::findOrFail($request->id),
                ];
                return view('front.pages.instructor.course.create', $data);
            default:
                # code...
                break;
        }
    }
    /**
     * UPDATE MORE INFO
     */
    public function updateMoreInfo(Request $request)
    {
        switch ($request->current_step) {
            case '1':
                $request->validate([
                    'title' => 'required|string|max:255',
                    'seo_description' => 'nullable|string|max:255',
                    'video_demo_storage' => 'nullable|in:youtube,vimeo,external_link,upload|max:255',
                    'price' => 'required|numeric|min:0',
                    'discount' => 'nullable|numeric|min:0|max:100',
                    'description' => 'required|string',
                    'thumbnail' => 'nullable|image|max:3000',
                    'demo_video_source' => 'nullable',
                ]);
                $course = Course::findOrFail($request->course_id);
                if ($request->hasFile('thumbnail')) {
                    $thumbnailPath = $this->uploadFile($request->file('thumbnail'));
                    $this->deleteIfImageExist($course->thumbnail);
                    $course->thumbnail = $thumbnailPath;
                }
                $course->title = $request->title;
                $course->slug = Str::slug($request->title);
                $course->seo_description = $request->seo_description;
                $course->demo_video_storage = $request->demo_video_storage;
                $course->demo_video_source = $request->demo_video_source;
                $course->price = $request->price;
                $course->discount = $request->discount;
                $course->description = $request->description;
                $course->instructor_id = Auth::guard('web')->user()->id;
                $course->save();
                // save course id on session
                Session::put('course_create_id', $course->id);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Updated successfully',
                    'redirect' => route('instructor.courses.edit_basic_info', ['id' => $course->id, 'step' => $request->next_step])
                ]);
            case '2':
                $request->validate([
                    'capacity' => 'nullable|numeric',
                    'duration' => 'required|numeric',
                    'qna' => 'nullable|boolean',
                    'certificate' => 'nullable|boolean',
                    'category' => 'required|integer|exists:course_categories,id',
                    'level' => 'required|integer|exists:course_levels,id',
                    'language' => 'required|integer|exists:course_languages,id',
                ]);
                $course = Course::findOrFail($request->course_id);
                $course->capacity = $request->capacity;
                $course->duration = $request->duration;
                $course->qna = $request->qna ? 1 : 0;
                $course->certificate = $request->certificate ? 1 : 0;
                $course->category_id = $request->category;
                $course->course_level_id = $request->level;
                $course->course_language_id = $request->language;
                $course->save();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Updated successfully',
                    'redirect' => route('instructor.courses.edit_basic_info', ['id' => $course->id, 'step' => $request->next_step])
                ]);
            default:
                # code...
                break;
        }
    }

}
