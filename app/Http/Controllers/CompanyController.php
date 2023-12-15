<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create category
        $validateData = $request->validate([
            'company_name' => 'required|unique:companies|max:255',
            'category' => 'required|max:255', 
            'location' => 'required|max:255',
            'company_size' => 'required|max:255',
            'website_link' => 'required|unique:companies|max:255',
            'facebook_link' => 'nullable|max:255',
            'linkedin_link' => 'nullable|max:255',
            'description' => 'nullable|max:5000', // Assuming a maximum of 5000 characters, adjust as needed
        ]);
            $company = new Company;
            $company->company_name = $request->company_name;
            $company->category = $request->category;
            $company->location = $request->location;
            $company->company_size = $request->company_size;
            $company->website_link = $request->website_link;
            $company->facebook_link = $request->facebook_link;
            $company->linkedin_link = $request->linkedin_link;
            $company->description = $request->description;
            $company->save();
            return response()->json([
                'status' => true,
                'message' => 'company details added Successfully',
            ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
