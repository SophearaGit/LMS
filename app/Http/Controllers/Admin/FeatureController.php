<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeatureUpdateRequest;
use App\Models\Feature;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class FeatureController extends Controller
{

    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Feature Section',
            'featureItems' => Feature::all(),
        ];

        return view('admin.pages.section.feature.index', $data);
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
    public function store(FeatureUpdateRequest $request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('icon')) {
            $icon = $this->uploadFile($request->file('icon'));

            if (!$request->old_icon == '') {
                $this->deleteIfImageExist($request->old_icon);
            }

            $data['icon'] = $icon;
        }
        ;

        Feature::updateOrCreate(
            ['id' => $request->feature],
            $data
        );

        notyf()->success('Feature updated successfully');
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
