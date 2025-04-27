<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AirlineController extends Controller
{
    public function index(){
        if(Auth::user()){
            $airlines = Airline::get();
            // dd($airlines);
            return view('airlines.index', compact('airlines'));
        }
        else{
            return view('welcome');
        }
        
    }
    public function findAirlineFree(Request $request)
    {
        if(Auth::user()){
            $airline_code = $request->code;
            $airline_name = '';
            $isFree = !Airline::where('ID', $airline_code)->exists();
            if (!$isFree) {
                $airline_name = Airline::where('ID', $airline_code)->value('Full');
            }
            return response()->json(['is_free' => $isFree, 'airline_name' => $airline_name]);
        }
        else{
            return view('welcome');
        }
       
    }
    public function store(Request $request){

        if(Auth::user()){
                // dd($request->all());
            $airline = new Airline();
            $airline->ID = $request->code;
            $airline->Short = $request->short_name;
            $airline->Full = $request->full_name;
            $airline->save();
            return redirect()->route('airline.view')->with('success', 'Airline added successfully');
        }
        else{
            return view('welcome');
        }
       
    }
    public function edit($id)
    {
        if(Auth::user()){
            $id = decrypt($id);
            $airline = Airline::findOrFail($id);
            return view('airlines.edit', compact('airline'));
        }
        else{
            return view('welcome');
        }
        
    }
    public function update($id, Request $request)
    {
        if(Auth::user()){
            try {
                // Enable query logging
                DB::enableQueryLog();
            
                // Retrieve the airline record to update
                $airline = Airline::findOrFail($id);
            
                // Ensure that the ID attribute is set correctly
                $airline->id = $id;
            
                // Update the attributes of the airline record
                $airline->Short = $request->short_name;
                $airline->Full = $request->full_name;
            
                // Save the updated airline record
                $airline->save();
            
                // Get the executed queries from the query log
                $queries = DB::getQueryLog();
                // dd($queries); // Check the executed queries
            
                return redirect()->route('airline.view')->with('success', 'Airline updated successfully');
            } catch (\Exception $e) {
                // Handle any errors that occur during the update process
                return redirect()->back()->with('error', 'Failed to update airline: ' . $e->getMessage());
            }
        }
        else{
            return view('welcome');
        }
        
        
    }
    public function delete($id)
    {
        if(Auth::user()){
            DB::enableQueryLog();
        
            // Retrieve the airline record to update
            $airline = Airline::findOrFail($id);
        
            // Ensure that the ID attribute is set correctly
            $airline->id = $id;
            $airline->delete();
            $queries = DB::getQueryLog();
            // dd($queries); // Check the executed queries
            
            if ($airline->delete()) {
                return redirect()->route('airline.view')->with('success', 'Airline deleted successfully');
            } else {
                return redirect()->route('airline.view')->with('error', 'Failed to delete airline');
            }
        }
        else{
            return view('welcome');
        }
       
    }

    


}
