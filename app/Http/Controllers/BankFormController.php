<?php

namespace App\Http\Controllers;

use App\Models\BankForm;
use Illuminate\Http\Request;

class BankFormController extends Controller
{
    /**
     * Display a listing of the bank forms.
     *
     * This method can be used to list all bank forms, for example,
     * if you need an API endpoint outside of Filament.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all bank forms from the database
        $bankForms = BankForm::all();

        // Return the data as a JSON response (or pass to a view if needed)
        return response()->json($bankForms);
    }

    /**
     * Show the form for creating a new bank form.
     *
     * Although Filament manages admin forms, this method can be used
     * if you ever need a custom creation view.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return a view for creating a new bank form (if using Blade templates)
        // For now, this might remain unused if Filament handles form generation.
        return view('bankforms.create');
    }

    /**
     * Store a newly created bank form in storage.
     *
     * Processes the request from a custom form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate incoming request data.
        // Note: Adjust validation rules if you're handling file uploads.
        $validatedData = $request->validate([
            'bank_name' => 'required|string|max:255',
            'form_name' => 'required|string|max:255',
            'form_file' => 'required|string', // Typically a file upload field, simplified here.
        ]);

        // Create a new BankForm record using the validated data.
        $bankForm = BankForm::create($validatedData);

        // Return a JSON response with the created bank form data.
        return response()->json($bankForm, 201);
    }

    /**
     * Display the specified bank form.
     *
     * Shows details for a single bank form.
     *
     * @param  \App\Models\BankForm  $bankForm
     * @return \Illuminate\Http\Response
     */
    public function show(BankForm $bankForm)
    {
        // Return the bank form as a JSON response (or pass it to a view)
        return response()->json($bankForm);
    }

    /**
     * Show the form for editing the specified bank form.
     *
     * Provides a view for editing if you're using a custom interface.
     *
     * @param  \App\Models\BankForm  $bankForm
     * @return \Illuminate\Http\Response
     */
    public function edit(BankForm $bankForm)
    {
        // Return a view for editing the bank form (if needed)
        return view('bankforms.edit', compact('bankForm'));
    }

    /**
     * Update the specified bank form in storage.
     *
     * Processes updates from a custom form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankForm  $bankForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankForm $bankForm)
    {
        // Validate the incoming request data.
        // Using 'sometimes' allows partial updates.
        $validatedData = $request->validate([
            'bank_name' => 'sometimes|required|string|max:255',
            'form_name' => 'sometimes|required|string|max:255',
            'form_file' => 'sometimes|required|string',
        ]);

        // Update the bank form record with validated data.
        $bankForm->update($validatedData);

        // Return a JSON response with the updated bank form.
        return response()->json($bankForm);
    }

    /**
     * Remove the specified bank form from storage.
     *
     * Deletes the specified record from the database.
     *
     * @param  \App\Models\BankForm  $bankForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankForm $bankForm)
    {
        // Delete the bank form record from the database.
        $bankForm->delete();

        // Return a JSON response indicating successful deletion.
        return response()->json(null, 204);
    }
}
