<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Custom Pages',
            'customPageItems' => CustomPage::paginate(10),
        ];
        return view('admin.pages.custom-page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'CAITD | Create Custom Page',
        ];
        return view('admin.pages.custom-page.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:custom_pages',
            // 'slug' => 'required|string|max:255|unique:custom_pages,slug',
            'description' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'show_at_nav' => 'boolean',
            'status' => 'boolean',
        ]);

        $customPage = new CustomPage();
        $customPage->title = $request->title;
        $customPage->slug = Str::slug($request->title, '-');
        $customPage->description = $request->description;
        $customPage->seo_title = $request->seo_title;
        $customPage->seo_description = $request->seo_description;
        $customPage->show_at_nav = $request->show_at_nav ?? 0;
        $customPage->status = $request->status ?? 0;
        $customPage->save();

        notyf()->success('Custom page created successfully.');
        return to_route('admin.custom-page.index');
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
    public function edit(Custompage $custom_page)
    {
        $data = [
            'pageTitle' => 'CAITD | Edit Custom Page',
            'customPage' => $custom_page,
        ];
        return view('admin.pages.custom-page.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Custompage $custom_page)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:custom_pages,title,' . $custom_page->id,
            // 'slug' => 'required|string|max:255|unique:custom_pages,slug,' . $custom_page->id,
            'description' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'show_at_nav' => 'boolean',
            'status' => 'boolean',
        ]);

        $custom_page->title = $request->title;
        $custom_page->slug = Str::slug($request->title, '-');
        $custom_page->description = $request->description;
        $custom_page->seo_title = $request->seo_title;
        $custom_page->seo_description = $request->seo_description;
        $custom_page->status = $request->status ?? 0;
        $custom_page->show_at_nav = $request->show_at_nav ?? 0;
        $custom_page->save();

        notyf()->success('Custom page updated successfully.');
        return to_route('admin.custom-page.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Custompage $custom_page)
    {
        try {
            $custom_page->delete();
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
