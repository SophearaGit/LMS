<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterColumnOne;
use Illuminate\Http\Request;

class FooterColumnOneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Footer Column One',
            'footerColumnOnes' => FooterColumnOne::latest()->paginate(9),
        ];
        return view('admin.pages.footer.column-one.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'CAITD | Footer Column One Create',
        ];
        return view('admin.pages.footer.column-one.create', $data);
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

        $columnOne = new FooterColumnOne();
        $columnOne->title = $request->title;
        $columnOne->url = $request->url;
        $columnOne->status = $request->status;
        $columnOne->save();

        notyf()->success('Footer Column One created successfully.');
        return redirect()->route('admin.column-one.index');
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
    public function edit(FooterColumnOne $column_one)
    {
        $data = [
            'pageTitle' => 'CAITD | Footer Column One Edit',
            'column_one' => $column_one,
        ];
        return view('admin.pages.footer.column-one.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FooterColumnOne $column_one)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        $column_one->title = $request->title;
        $column_one->url = $request->url;
        $column_one->status = $request->status;
        $column_one->save();
        notyf()->success('Footer Column One updated successfully.');
        return redirect()->route('admin.column-one.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FooterColumnOne $column_one)
    {
        try {
            $column_one->delete();
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
