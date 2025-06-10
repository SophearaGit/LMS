<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class BrandSectionController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Brand Section',
            'brands' => Brand::latest()->paginate(15),
        ];
        return view('admin.pages.section.brand-section.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'CAITD | Create Brand Section',
        ];
        return view('admin.pages.section.brand-section.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:3000',
            'url' => 'nullable|url',
            'status' => 'boolean',
        ]);

        $imagePath = $this->uploadFile($request->file('image'));

        $brand = new Brand();
        $brand->image = $imagePath;
        $brand->url = $request->url;
        $brand->status = $request->status;
        $brand->save();

        notyf()->success('Brand created successfully.');
        return redirect()->route('admin.brand-section.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        $data = [
            'pageTitle' => 'CAITD | Edit Brand Section',
            'brand' => $brand,
        ];
        return view('admin.pages.section.brand-section.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3000',
            'url' => 'nullable|url',
            'status' => 'boolean',
        ]);

        $brand = Brand::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $this->deleteIfImageExist($brand->image);
            $brand->image = $imagePath;
        }

        $brand->url = $request->url;
        $brand->status = $request->status;
        $brand->save();

        notyf()->success('Brand updated successfully.');
        return redirect()->route('admin.brand-section.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        try {
            $this->deleteIfImageExist($brand->image);
            $brand->delete();
            notyf()->success('Brand deleted successfully.');
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
