<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{

    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Social Links',
            'socialLinks' => SocialLink::latest()->paginate(15),
        ];
        return view('admin.pages.social-links.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'CAITD | Create Social Link',
        ];
        return view('admin.pages.social-links.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'link' => 'required|url|max:255',
        ]);

        $imagePath = $this->uploadFile($request->file('icon'));

        $socialLink = new SocialLink();
        $socialLink->icon = $imagePath;
        $socialLink->link = $request->link;
        $socialLink->status = $request->status;
        $socialLink->save();

        notyf()->success('Social link created successfully.');
        return redirect()->route('admin.social-links.index');
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
    public function edit(SocialLink $socialLink)
    {
        $data = [
            'pageTitle' => 'CAITD | Edit Social Link',
            'socialLink' => $socialLink,
        ];
        return view('admin.pages.social-links.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialLink $socialLink)
    {
        $request->validate([
            'icon' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'link' => 'required|url|max:255',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('icon')) {
            $imagePath = $this->uploadFile($request->file('icon'));
            $this->deleteIfImageExist($socialLink->icon);
            $socialLink->icon = $imagePath;
        }

        $socialLink->link = $request->link;
        $socialLink->status = $request->status;
        $socialLink->save();

        notyf()->success('Social link updated successfully.');
        return redirect()->route('admin.social-links.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialLink $socialLink)
    {
        try {
            $this->deleteIfImageExist($socialLink->icon);
            $socialLink->delete();
            notyf()->success('Deleted Successfully!');
            return response([
                'message' => 'Deleted Successfully!'
            ], 200);
        } catch (\Exception $e) {
            logger($e);
            notyf()->error('Something went wrong');
            return response([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
