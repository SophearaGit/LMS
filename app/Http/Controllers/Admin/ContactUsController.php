<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Contact Us',
            'contacts' => Contact::latest()->paginate(15),
        ];
        return view('admin.pages.contact-us.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'CAITD | Create Contact Us',
        ];
        return view('admin.pages.contact-us.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'icon' => 'required|image|max:3000',
            'title' => 'required|string|max:255',
            'line_one' => 'required|string|max:255',
            'line_two' => 'nullable|string|max:255',
            'status' => 'boolean|in:0,1',
        ]);

        $imagePath = $this->uploadFile($request->file('icon'));

        $contact = new Contact();
        $contact->icon = $imagePath;
        $contact->title = $validatedData['title'];
        $contact->line_one = $validatedData['line_one'];
        $contact->line_two = $validatedData['line_two'];
        $contact->status = $validatedData['status'] ?? 1;
        $contact->save();

        notyf()->success('Contact Us created successfully.');
        return redirect()->route('admin.contact-us.index');
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
        $contact = Contact::findOrFail($id);
        $data = [
            'pageTitle' => 'CAITD | Edit Contact Us',
            'contact' => $contact,
        ];
        return view('admin.pages.contact-us.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = Contact::findOrFail($id);

        $validatedData = $request->validate([
            'icon' => 'nullable|image|max:3000',
            'title' => 'required|string|max:255',
            'line_one' => 'required|string|max:255',
            'line_two' => 'nullable|string|max:255',
            'status' => 'boolean|in:0,1',
        ]);

        if ($request->hasFile('icon')) {
            $imagePath = $this->uploadFile($request->file('icon'));
            $this->deleteIfImageExist($contact->icon);
            $contact->icon = $imagePath;
        }

        $contact->title = $validatedData['title'];
        $contact->line_one = $validatedData['line_one'];
        $contact->line_two = $validatedData['line_two'];
        $contact->status = $validatedData['status'] ?? 1;
        $contact->save();

        notyf()->success('Contact Us updated successfully.');
        return redirect()->route('admin.contact-us.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        try {
            $this->deleteIfImageExist($contact->icon);
            $contact->delete();
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
