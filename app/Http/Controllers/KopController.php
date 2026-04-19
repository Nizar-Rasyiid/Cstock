<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kop;
use Auth;
use Storage;

class KopController extends Controller
{
    
    public function index(){
        $data['kop'] = Kop::where('company_id', Auth::user()->company_id)->first();
        return view('pages/kop/index', $data);
    }

    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate logo file
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
        ]);

        // Handle file upload if a logo is provided
        $logoPath = null;
        if ($request->hasFile('logo')) {
            // Store the logo in the 'logos' directory
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        // Update or create the Kop instance for the current company
        $kop = Kop::updateOrCreate(
            ['company_id' => Auth::user()->company_id],
            [
                'company_logo' => $logoPath, // Store the path to the uploaded logo
                'company_name' => $request->input('company_name'),
                'company_address' => $request->input('address'),
                'company_email' => $request->input('email'),
                'company_phone' => $request->input('phone'),
            ]
        );

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Kop Surat updated successfully.');
    }


    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = $file->store('uploads', 'public');
    
            return response()->json([
                'url' => Storage::url($path)
            ]);
        }
    
        return response()->json(['error' => 'Upload failed'], 400);
    }

}
