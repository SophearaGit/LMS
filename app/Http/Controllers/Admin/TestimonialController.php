<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{

    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Testimonials',
            'testimonials' => Testimonial::paginate(10),
        ];
        return view('admin.pages.section.testimonial-section.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'CAITD | Create Testimonial',
        ];
        return view('admin.pages.section.testimonial-section.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
            'user_image' => 'required|image|mimes:jpg,jpeg,png|max:3000',
            'user_name' => 'required|string|max:100',
            'user_title' => 'required|string|max:100',
        ]);

        $image = $this->uploadFile($request->file('user_image'));
        $data['user_image'] = $image;

        $testimonial = new Testimonial();
        $testimonial->rating = $data['rating'];
        $testimonial->review = $data['review'];
        $testimonial->user_image = $data['user_image'];
        $testimonial->user_name = $data['user_name'];
        $testimonial->user_title = $data['user_title'];
        $testimonial->save();

        notyf()->success('Testimonial created successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial_section)
    {
        $data = [
            'pageTitle' => 'CAITD | Edit Testimonial',
            'testimonial' => $testimonial_section,
        ];
        return view('admin.pages.section.testimonial-section.edit', data: $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial_section)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
            'user_image' => 'nullable|image|mimes:jpg,jpeg,png|max:3000',
            'user_name' => 'required|string|max:100',
            'user_title' => 'required|string|max:100',
        ]);

        if ($request->hasFile('user_image')) {
            $image = $this->uploadFile($request->file('user_image'));
            $this->deleteIfImageExist($testimonial_section->user_image);
            $data['user_image'] = $image;
        }

        $testimonial_section->update($data);

        notyf()->success('Testimonial updated successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial_section)
    {
        try {
            $this->deleteIfImageExist($testimonial_section->user_image);
            $testimonial_section->delete();
            notyf()->success('Testimonial deleted successfully.');
            return response([
                'message' => 'Deleted Successfully!'
            ], 200);

        } catch (\Exception $e) {
            logger($e);
            notyf()->error('Something went wrong while deleting the brand.');
            return response([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
