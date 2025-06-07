<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BecomeInstructorSectionUpdateRequest;
use App\Models\BecomeInstructorSection;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class BecomeInstructorSectionController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Become Instructor Section',
            'sectionItems' => BecomeInstructorSection::first(),
        ];
        return view('admin.pages.section.becomeInstructor.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BecomeInstructorSectionUpdateRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('img')) {
            $img = $this->uploadFile($request->file('img'));
            if (!$request->old_img == '') {
                $this->deleteIfImageExist($request->old_img);
            }
            $data['img'] = $img;
        }

        BecomeInstructorSection::updateOrCreate(['id' => 1], $data);

        notyf()->success('Become Instructor Section updated successfully.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
