<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoSectionUpdateRequest;
use App\Models\VideoSection;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class VideoSectionController extends Controller
{

    use FileUpload;

    /**
     * Display the video section management page.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Video Section Management',
            'videoSectionItems' => VideoSection::first(),
        ];
        return view('admin.pages.section.video-section.index', $data);
    }

    /**
     * Store a newly created video section in storage.
     */
    public function store(VideoSectionUpdateRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('background_image')) {
            $image = $this->uploadFile($request->file('background_image'));
            if (!$request->old_image == '') {
                $this->deleteIfImageExist($request->old_image);
            }
            $data['background_image'] = $image;
        }

        VideoSection::updateOrCreate(
            ['id' => 1],
            $data
        );

        notyf()->success('Video section updated successfully.');
        return redirect()->back();
    }


}
