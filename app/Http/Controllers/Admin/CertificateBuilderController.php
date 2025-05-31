<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CertificateBuilderStoreRequest;
use App\Models\CertificateBuilder;
use App\Models\CertificateBuilderItem;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class CertificateBuilderController extends Controller
{

    use FileUpload;

    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Certificate Builder',
            'certificate' => CertificateBuilder::first(),
            'certificateItems' => CertificateBuilderItem::all(),
        ];
        return view('admin.pages.certificate-builder.index', $data);
    }

    // store
    public function store(CertificateBuilderStoreRequest $request)
    {
        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
        ];

        if ($request->hasFile('background')) {
            $background = $this->uploadFile($request->file('background'));
            $data['background'] = $background;
        }
        if ($request->hasFile('signature')) {
            $signature = $this->uploadFile($request->file('signature'));
            $data['signature'] = $signature;
        }


        CertificateBuilder::updateOrCreate(
            ['id' => 1],
            $data
        );

        notyf()->success('Certificate Builder saved successfully.');
        return redirect()->back();
    }

    // updatePosition
    public function updatePosition(Request $request)
    {
        $request->validate([
            'element_id' => 'required|in:title,subtitle,description,signature',
        ]);
        CertificateBuilderItem::updateOrCreate([
            'element_id' => $request->element_id,
        ], [
            'x_position' => $request->position_x,
            'y_position' => $request->position_y,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Position updated successfully.',
        ]);

    }
}
