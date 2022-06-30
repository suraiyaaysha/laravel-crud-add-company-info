<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyCRUDController extends Controller
{
    // Display a listing of the resource.
    public function index() {
        $data['companies'] = Company::orderBy('id', 'desc')->paginate(5);
        return view('companies.index', $data);
    }

    // Show the form for creating a new resource.
    public function create() {
        return view('companies.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);
        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success', 'Company has been created successfully.');
    }

    // Display the specific resource.
    public function show(Company $company) {
        return view('companies.show', compact(company));
    }

    // Show the form for editing the specified resource.
    public function edit(Company $company) {
        return view('companies.edit', compact('company'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id) {
        $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'address'=> 'required',
        ]);
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success', 'Company has been updated successfully');
    }

    // Remove the specified resource from storage.
    public function destroy(Company $company) {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company has been deleted successfully');
    }

}
