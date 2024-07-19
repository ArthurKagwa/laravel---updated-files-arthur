<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\School;
class SchoolController extends Controller
{
   
    public function create()
    {
        return view('pages.school');
    }
     public function show()
    {
        
    }

    public function store(Request $request)
{
   try {
        // Validate input
        $attributes = request()->validate([
        'school_name' => 'required|max:50',
            'school_regNo' => 'required|unique:school_representative|max:15',
            'school_district' => 'required|max:50',

            'rep_fname' => 'required|max:25',
            'rep_lname' => 'required|max:25',
            'rep_email' => 'required|email|max:50',
            
            
            
        
        ]);
   
        
        // Create a new school record
         $school_representative = new School();
            $school_representative->school_name = $request->input('school_name');
            $school_representative->school_regNo = $request->input('school_regNo');
            $school_representative->school_district = $request->input('school_district');
            $school_representative->rep_fname = $request->input('rep_fname');
            $school_representative->rep_lname = $request->input('rep_lname');
            $school_representative->rep_email = $request->input('rep_email');
            $school_representative->save();
        

    
    
            return back()->with('success','School created successfully!');
        } catch (\Exception $e) {
            \Log::error('Database error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while creating the school.');
        }
    }
  

}
