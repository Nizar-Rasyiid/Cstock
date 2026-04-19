<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class CompanyController extends Controller
{
    // Display a listing of the companies
    public function index()
    {
        $companies = Company::all();
        return view('pages.companies.index', compact('companies'));
    }

    // Show the form for creating a new company
    public function create()
    {
        return view('pages.companies.create');
    }

    // Store a newly created company in storage
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $company = Company::create($request->all());

        for ($i = 1; $i <= $request->users; $i++) {
            User::create([
                'name' => $company->name . ' ' . $i,
                'email' => 'user' . $i . strtolower(str_replace(' ', '', $company->name)) . '@gmail.com', // Email yang disesuaikan
                'password' => Hash::make('12345678'),
                'company_id' => $company->id,
                'is_active' => true,
            ]);
        }

        return redirect()->route('companies.index')->with('success', 'Company and Users created successfully.');
    }

    // Show the form for editing the specified company
    public function edit(Company $company)
    {
        return view('pages.companies.edit', compact('company'));
    }

    // Update the specified company in storage
    public function update(Request $request, Company $company)
    {
        $this->validateRequest($request, $company);

        $company->update($request->all());
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    // Remove the specified company from storage
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }

    // Validation logic
    protected function validateRequest(Request $request, Company $company = null)
    {
        $uniqueEmailRule = 'required|email|max:255|unique:companies,email';
        
        // If updating, allow the current email
        if ($company) {
            $uniqueEmailRule .= ',' . $company->id; // Use the company's ID
        }

        return $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => $uniqueEmailRule,
            'expired_membership' => 'required|date', // Validate as a required date
            'membership_price' => 'required|numeric|min:0', // Validate as required numeric, must be >= 0
        ]);
    }
}
