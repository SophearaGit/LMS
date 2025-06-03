<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutUsSectionUpdateRequest;
use App\Models\AboutUsSection;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class AboutUsSectionController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | About Us Section',
            'aboutUsSectionItems' => AboutUsSection::first(),
        ];
        return view('admin.pages.section.aboutUs.index', $data);
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
    public function store(AboutUsSectionUpdateRequest $request)
    {

        $data = [
            'rounded_text' => $request->rounded_text,
            'lerner_count' => $request->lerner_count,
            'lerner_count_text' => $request->lerner_count_text,
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'video_url' => $request->video_url,
        ];

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'));
            if (!$request->old_image == '') {
                $this->deleteIfImageExist($request->old_image);
            }
            $data['image'] = $image;
        }

        if ($request->hasFile('lerner_image')) {
            $lernerImage = $this->uploadFile($request->file('lerner_image'));
            if (!$request->old_lerner_image == '') {
                $this->deleteIfImageExist($request->old_lerner_image);
            }
            $data['lerner_image'] = $lernerImage;
        }

        if ($request->hasFile('video_image')) {
            $videoImage = $this->uploadFile($request->file('video_image'));
            if (!$request->old_video_image == '') {
                $this->deleteIfImageExist($request->old_video_image);
            }
            $data['video_image'] = $videoImage;
        }

        AboutUsSection::updateOrCreate(
            ['id' => 1],
            $data
        );

        notyf()->success('About Us Section updated successfully');
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
