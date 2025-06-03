<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\HeroUpdateRequest;
use App\Models\Hero;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class HeroController extends Controller
{

    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=[
            'pageTitle' => 'CAITD | Hero Section',
            'heroItems' => Hero::first(),
        ];

        return view('admin.pages.section.hero.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HeroUpdateRequest $request)
    {
        $data = [
            'label' => $request->label,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'btn_txt' => $request->btn_txt,
            'btn_url' => $request->btn_url,
            'vid_btn_txt' => $request->vid_btn_txt,
            'vid_btn_url' => $request->vid_btn_url,
            'banner_item_title' => $request->banner_item_title,
            'banner_item_subtitle' => $request->banner_item_subtitle,
            'round_txt' => $request->round_txt,
        ];

        if($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'));
            $this->deleteIfImageExist($request->old_image);
            $data['image'] = $image;
        };

        Hero::updateOrCreate(
            ['id' => 1],
            $data
        );

        notyf()->success('Hero section updated successfully.');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
