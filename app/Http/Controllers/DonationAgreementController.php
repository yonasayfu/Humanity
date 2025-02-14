<?php

namespace App\Http\Controllers;

use App\Models\DonationAgreement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DonationAgreementController extends Controller
{
    /**
     * Display a listing of donation agreements.
     */
    public function index(Request $request)
    {
        $agreements = DonationAgreement::all();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($agreements);
        }

        // Return an Inertia page for web users
        return Inertia::render('DonationAgreements/Index', [
            'agreements' => $agreements,
        ]);
    }

    /**
     * Show the form for creating a new donation agreement.
     */
    public function create(Request $request)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(['message' => 'Provide the required fields for a new donation agreement.'], 200);
        }

        // Return an Inertia page for creating a new donation agreement
        return Inertia::render('DonationAgreements/Create');
    }

    /**
     * Store a newly created donation agreement in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supporter_id' => 'required|exists:supporters,id',
            'bank_id' => 'required|exists:bank_forms,id',
            'donation_type' => 'required|string',
            'donation_amount' => 'required|numeric',
            'recurring_interval' => 'nullable|string',
            'signed_agreement_pdf' => 'required|string', // For real apps, handle file uploads appropriately
        ]);

        $donationAgreement = DonationAgreement::create($validatedData);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($donationAgreement, 201);
        }

        // Redirect via Inertia (which uses a standard Laravel redirect)
        return redirect()->route('donation-agreements.index')
                         ->with('success', 'Donation Agreement created successfully.');
    }

    /**
     * Display the specified donation agreement.
     */
    public function show(Request $request, DonationAgreement $donationAgreement)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($donationAgreement);
        }

        // Return an Inertia page for showing a donation agreement
        return Inertia::render('DonationAgreements/Show', [
            'donationAgreement' => $donationAgreement,
        ]);
    }

    /**
     * Show the form for editing the specified donation agreement.
     */
    public function edit(Request $request, DonationAgreement $donationAgreement)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'Provide updated data for the donation agreement.',
                'donationAgreement' => $donationAgreement,
            ], 200);
        }

        // Return an Inertia page for editing the donation agreement
        return Inertia::render('DonationAgreements/Edit', [
            'donationAgreement' => $donationAgreement,
        ]);
    }

    /**
     * Update the specified donation agreement in storage.
     */
    public function update(Request $request, DonationAgreement $donationAgreement)
    {
        $validatedData = $request->validate([
            'supporter_id' => 'sometimes|required|exists:supporters,id',
            'bank_id' => 'sometimes|required|exists:bank_forms,id',
            'donation_type' => 'sometimes|required|string',
            'donation_amount' => 'sometimes|required|numeric',
            'recurring_interval' => 'nullable|string',
            'signed_agreement_pdf' => 'sometimes|required|string',
        ]);

        $donationAgreement->update($validatedData);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($donationAgreement);
        }

        return redirect()->route('donation-agreements.index')
                         ->with('success', 'Donation Agreement updated successfully.');
    }

    /**
     * Remove the specified donation agreement from storage.
     */
    public function destroy(Request $request, DonationAgreement $donationAgreement)
    {
        $donationAgreement->delete();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()->route('donation-agreements.index')
                         ->with('success', 'Donation Agreement deleted successfully.');
    }
}
