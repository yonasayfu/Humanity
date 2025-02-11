<?php
namespace App\Http\Controllers;

use App\Models\Supporter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupporterController extends Controller
{
    /**
     * Display all supporters.
     */
    public function index(Request $request)
    {
        $supporters = Supporter::orderBy('created_at', 'desc')->paginate(10);

        // Return API response if request expects JSON
        if ($request->wantsJson()) {
            return response()->json($supporters);
        }

        // Otherwise, return Inertia page
        return Inertia::render('Supporters/Index', [
            'supporters' => $supporters
        ]);
    }

    /**
     * Show the form to create a new supporter.
     */
    public function create()
    {
        return Inertia::render('Supporters/Create');
    }

    /**
     * Store a new supporter.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:government,NGO,private,individual',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'contribution_amount' => 'nullable|numeric|min:0',
            'photo_url' => 'nullable|url',
            'testimonial_content' => 'nullable|string',
        ]);

        $supporter = Supporter::create($validated);

        // Return JSON response for API
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Supporter created successfully!', 'supporter' => $supporter], 201);
        }

        // Otherwise, redirect to Inertia page
        return redirect()->route('supporters.index')->with('success', 'Supporter added successfully!');
    }

    /**
     * Display a single supporter.
     */
    public function show(Request $request, Supporter $supporter)
    {
        // Return JSON response for API
        if ($request->wantsJson()) {
            return response()->json($supporter);
        }

        // Otherwise, return Inertia page
        return Inertia::render('Supporters/Show', [
            'supporter' => $supporter
        ]);
    }

    /**
     * Show the edit form for a supporter.
     */
    public function edit(Supporter $supporter)
    {
        return Inertia::render('Supporters/Edit', [
            'supporter' => $supporter
        ]);
    }

    /**
     * Update a supporter.
     */
    public function update(Request $request, Supporter $supporter)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|in:government,NGO,private,individual',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'contribution_amount' => 'nullable|numeric|min:0',
            'photo_url' => 'nullable|url',
            'testimonial_content' => 'nullable|string',
        ]);

        $supporter->update($validated);

        // Return JSON response for API
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Supporter updated successfully!', 'supporter' => $supporter]);
        }

        // Otherwise, redirect to Inertia page
        return redirect()->route('supporters.index')->with('success', 'Supporter updated successfully!');
    }

    /**
     * Delete a supporter.
     */
    public function destroy(Request $request, Supporter $supporter)
    {
        $supporter->delete();

        // Return JSON response for API
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Supporter deleted successfully!']);
        }

        // Otherwise, redirect to Inertia page
        return redirect()->route('supporters.index')->with('success', 'Supporter deleted successfully!');
    }
}
