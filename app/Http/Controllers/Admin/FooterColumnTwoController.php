<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterColumnTwo;
use Illuminate\Http\Request;

class FooterColumnTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Footer Column Two',
            'footerColumnTwos' => FooterColumnTwo::latest()->paginate(9),
        ];
        return view('admin.pages.footer.column-two.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'CAITD | Footer Column Two Create',
        ];
        return view('admin.pages.footer.column-two.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $columnTwo = new FooterColumnTwo();
        $columnTwo->title = $request->title;
        $columnTwo->url = $request->url;
        $columnTwo->status = $request->status;
        $columnTwo->save();

        notyf()->success('Footer Column Two created successfully.');
        return redirect()->route('admin.column-two.index');
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
    public function edit(FooterColumnTwo $column_two)
    {
        $data = [
            'pageTitle' => 'CAITD | Footer Column Two Edit',
            'column_two' => $column_two,
        ];
        return view('admin.pages.footer.column-two.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FooterColumnTwo $column_two)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        $column_two->title = $request->title;
        $column_two->url = $request->url;
        $column_two->status = $request->status;
        $column_two->save();
        notyf()->success('Footer Column Two updated successfully.');
        return redirect()->route('admin.column-two.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FooterColumnTwo $column_two)
    {
        try {
            $column_two->delete();
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
