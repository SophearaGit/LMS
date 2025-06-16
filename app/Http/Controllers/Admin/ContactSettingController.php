<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Contact Settings',
            'contactSetting' => ContactSetting::first(),
        ];
        return view('admin.pages.contact-us.contact-setting.index', $data);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3000',
            'map_url' => 'required|url',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            if ($request->old_image) {
                $this->deleteIfImageExist($request->old_image);
            }
            $validatedData['image'] = $imagePath;
        }

        ContactSetting::updateOrCreate(
            ['id' => 1],
            $validatedData
        );

        notyf()->success('Contact settings updated successfully.');
        return redirect()->route('admin.contact-setting.index');
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
