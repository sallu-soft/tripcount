<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wakala;
use App\Models\Agent;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class WakalaController extends Controller
{
    // In your WakalaController
    public function datatable()
    {
        return DataTables::of(Wakala::query()
                ->with(['agentRelation', 'supplierRelation'])
                ->where('user', auth()->id())
                ->select(['wakalas.*']))
            ->addColumn('agent_name', function($wakala) {
                return $wakala->agentRelation->name ?? 'N/A';
            })
            ->addColumn('supplier_name', function($wakala) {
                return $wakala->supplierRelation->name ?? 'N/A';
            })
            ->addColumn('action', function($wakala) {
                return '';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    public function index()
    {
       
        $wakalas = Wakala::where('user', auth()->id())->latest()->paginate(10); // Returns LengthAwarePaginator
        // Get agents as ID => Name pairs (more efficient for dropdowns)
        $agents = Agent::where('user', Auth::id())
            ->where('is_delete', 0)
            ->where('is_active', 1)
            ->get();

        // Get suppliers as ID => Name pairs
        $suppliers = Supplier::where('user', Auth::id())
            ->where('is_delete', 0)
            ->where('is_active', 1)
            ->get();

        $latestWakala = Wakala::where('user', Auth::id())->latest()->first();
        $nextInvoiceNumber = $this->generateInvoiceNumber();
        
        if ($latestWakala) {
            $latestId = $latestWakala->id;
            $nextId = $latestId + 1;
            $nextInvoiceNumber = 'WAKL-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        }
       
        return view('wakalas.index', compact('wakalas', 'agents', 'suppliers', 'nextInvoiceNumber'));
    }

    protected function generateInvoiceNumber()
    {
        $latest = Wakala::where('user', auth()->id())->latest()->first();
        return 'WAKL-' . str_pad(($latest->id ?? 0) + 1, 4, '0', STR_PAD_LEFT);
    }

    public function create()
    {
        return view('wakalas.create');
    }

    public function store(Request $request)
    {
        // Manual validation
        $errors = [];
        
        // Required fields validation
        $requiredFields = [
            'invoice', 'date', 'visa', 'id_no', 'agent', 
            'supplier', 'quantity', 'buying_price', 
            'multi_currency', 'total_price', 'selling_price'
        ];
        
        foreach ($requiredFields as $field) {
            if (empty($request->$field)) {
                $errors[$field] = "The {$field} field is required.";
            }
        }

        // Validate supplier format
        if (!str_contains($request->supplier, '_')) {
            $errors['supplier'] = "Invalid supplier format";
        } else {
            $parts = explode('_', $request->supplier);
            if (count($parts) !== 2) {
                $errors['supplier'] = "Invalid supplier format";
            }
        }

        // Numeric validation
        if (!is_numeric($request->quantity) || $request->quantity < 1) {
            $errors['quantity'] = "Quantity must be a number greater than 0";
        }

        if (!is_numeric($request->buying_price) || $request->buying_price <= 0) {
            $errors['buying_price'] = "Buying price must be a positive number";
        }

        if (!is_numeric($request->total_price) || $request->total_price <= 0) {
            $errors['total_price'] = "Total price must be a positive number";
        }

        if (!empty($errors)) {
            return response()->json([
                'success' => false,
                'errors' => $errors
            ], 422); // 422 is Unprocessable Entity
        }

        // Proceed with creating the record
        try {
            
            $wakala = new Wakala();
        
            // Set the attributes individually
            $wakala->invoice = $request->invoice;
            $wakala->date = $request->date;
            $wakala->visa = $request->visa;
            $wakala->id_no = $request->id_no;
            $wakala->agent = $request->agent;
            $wakala->agent_supplier = $parts[0];
            $wakala->supplier = $parts[1];
            $wakala->quantity = $request->quantity;
            $wakala->buying_price = $request->buying_price;
            $wakala->multi_currency = $request->multi_currency;
            $wakala->total_price = $request->total_price;
            $wakala->selling_price = $request->selling_price;
            $wakala->country = $request->country;
            $wakala->sales_by = $request->sales_by;
            $wakala->user = Auth::id();
            $wakala->created_at = now();
            $wakala->updated_at = now();
    
            // Save the model
            $wakala->save();

            return response()->json([
                'success' => true,
                'message' => 'Wakala record created successfully!',
                'invoice' => $request->invoice
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to create record: '.$e->getMessage()
            ], 500); // 500 is Internal Server Error
        }
    }

    public function show(Wakala $wakala)
    {
        // dd($wakala->agent);
        $wakala->agentname = Agent::where('id',$wakala->agent)->value('name');
        if($wakala->agent_supplier == 'supplier'){
            $wakala->suppliername = Supplier::where('id',$wakala->supplier)->value('name');
        }
        else{
            $wakala->suppliername = Agent::where('id',$wakala->supplier)->value('name');
        }
        return response()->json($wakala);
    }

    public function edit(Wakala $wakala)
    {
        // dd($wakala);
        // Verify ownership
        if ($wakala->user != auth()->id()) {
            abort(403);
        }
    
        $agents = Agent::where('user', auth()->id())
        ->where('is_delete', 0)  // Fixed typo here
        ->where('is_active', 1)
        ->pluck('name', 'id');

        $suppliers = Supplier::where('user', auth()->id())
        ->where('is_delete', 0)  // Fixed typo here
        ->where('is_active', 1)
        ->pluck('name', 'id');
        
        return view('wakalas.edit', [
            'wakala' => $wakala,
            'agents' => $agents,
            'suppliers' => $suppliers
        ]);
    }

    public function update(Request $request, Wakala $wakala)
    {
        // dd($request->all());
        // Manual validation
        $errors = [];

        // Required fields validation
        $requiredFields = [
            'invoice', 'date', 'visa', 'id_no', 'agent', 
            'supplier', 'quantity', 'buying_price', 
            'multi_currency', 'total_price', 'selling_price'
        ];
        
        foreach ($requiredFields as $field) {
            if (empty($request->$field)) {
                $errors[$field] = "The {$field} field is required.";
            }
        }

        // Validate supplier format
        if (!str_contains($request->supplier, '_')) {
            $errors['supplier'] = "Invalid supplier format";
        } else {
            $parts = explode('_', $request->supplier);
            if (count($parts) !== 2) {
                $errors['supplier'] = "Invalid supplier format";
            }
        }

        // Numeric validation
        if (!is_numeric($request->quantity) || $request->quantity < 1) {
            $errors['quantity'] = "Quantity must be a number greater than 0";
        }

        if (!is_numeric($request->buying_price) || $request->buying_price <= 0) {
            $errors['buying_price'] = "Buying price must be a positive number";
        }

        if (!is_numeric($request->total_price) || $request->total_price <= 0) {
            $errors['total_price'] = "Total price must be a positive number";
        }

        if (!empty($errors)) {
            return response()->json([
                'success' => false,
                'errors' => $errors
            ], 422); // 422 Unprocessable Entity
        }

        // Proceed with updating the record
        try {
            // Update attributes individually
            $wakala->invoice = $request->invoice;
            $wakala->date = $request->date;
            $wakala->visa = $request->visa;
            $wakala->id_no = $request->id_no;
            $wakala->agent = $request->agent;
            $wakala->agent_supplier = $parts[0];
            $wakala->supplier = $parts[1];
            $wakala->quantity = $request->quantity;
            $wakala->buying_price = $request->buying_price;
            $wakala->multi_currency = $request->multi_currency;
            $wakala->total_price = $request->total_price;
            $wakala->selling_price = $request->selling_price;
            $wakala->country = $request->country;
            $wakala->sales_by = $request->sales_by;
            $wakala->updated_at = now();

            $wakala->save();

            return response()->json([
                'success' => true,
                'message' => 'Wakala record updated successfully!',
                'invoice' => $request->invoice
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to update record: '.$e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }


    public function destroy(Wakala $wakala)
    {
        $wakala->delete();
        return redirect()->route('order.view')->with('success', 'Wakala record deleted successfully.');
    }
}