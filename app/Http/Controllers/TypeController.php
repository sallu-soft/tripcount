<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Type;
use Illuminate\Support\Facades\Auth; // Add this line


class TypeController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::id();
    //     $types = Type::where([['is_delete',0],['is_active',1],['user',$user]])->paginate(2);
    //     return view('type/index', compact('types'));
    // }
    public function index(Request $request)
    {
        if(Auth::user()){
            $user = Auth::id();
            $query = Type::where([['is_delete',0],['is_active',1],['user',$user]]);
    
            // Add search functionality
            if ($request->has('search')) {
                $query->where('name', 'like', '%' . $request->input('search') . '%');
            }
    
            $types = $query->paginate(10); // Change 10 to the number of items you want per page
    
            return view('type.index', compact('types'));
        }
        else{
            return view('welcome');
        }
      
    }
    public function store(Request $request)
    {
        if(Auth::user()){
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
    
            ]);
            $validatedData['user'] = Auth::id();
            Type::create($validatedData);
            return redirect()->route('type.index')->with('success', 'Type added successfully');
        }
        else{
            return view('welcome');
        }
        
    }

    public function edit($id)
    {
        if(Auth::user()){
            $id = decrypt($id);
            $type = Type::findOrFail($id);
            return view('type.edit', compact('type'));
        }
        else{
            return view('welcome');
        }
       
    }
    public function update(Request $request, $id)
    {
        if(Auth::user()){
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
    
            if ($validatedData) {
                $type = Type::find($id);
                $type->name = $request->name;
                if ($type->save()) {
                    return redirect()->route('type.index')->with('success', 'Type updated successfully');
                } else {
                    return redirect()->route('type.index')->with('error', 'Type updated failed');
                }
            }
    
            return redirect()->route('type.index')->with('error', 'Type updated failed');
        }
        else{
            return view('welcome');
        }
        // dd($request->all(), $id);
        
    }

    public function delete($id)
    {
        if(Auth::user()){
            $type = Type::findOrFail($id);
            $type->is_delete = 1;
            if ($type->save()) {
                return redirect()->route('type.index')->with('success', 'Type deleted successfully');
            } else {
                return redirect()->route('type.index')->with('error', 'Type deleted failed');
            }
            return redirect()->route('type.index')->with('error', 'Type deleted failed');
        }
        else{
            return view('welcome');
        }
      
    }
}
