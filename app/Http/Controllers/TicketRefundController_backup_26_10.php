<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Supplier;
use App\Models\Agent;
// use App\Models\Type;
use App\Models\Refund;
use Illuminate\View\View;
use DateTime;
use Illuminate\Support\Facades\View as ViewFacade;

class TicketRefundController extends Controller
{
    public function index()
    {
        if(Auth::user()){
            $user = Auth::id();
            $suppliers = Supplier::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $agents = Agent::where([['is_delete',0],['is_active',1],['user',$user]])->get();
           
            return view('report/refund_ticket/index', compact('suppliers', 'agents'));
        }
        else{
            return view('welcome');
        }
        
    }

    public function report(Request $request){
        if(Auth::user()){
            // dd($request->all());
            $agent = $request->input('agent');
            $supplier = $request->input('supplier');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $showProfit = $request->input('show_profit');
            $showSupplier = $request->input('show_supplier');
            $showAgent = $request->input('show_agent');

            // Formatting dates if needed
         
            if ($startDate) {
                $startDate = (new DateTime($startDate))->format('Y-m-d');
            }
    
            if ($endDate) {
                $endDate = (new DateTime($endDate))->format('Y-m-d');
            }

         // Building the query
         $query = Refund::where([
            ['refund.agent', '=', $agent],
            ['refund.supplier', '=', $supplier],
        ])
        ->leftJoin('tickets', function ($join) {
            $join->on('refund.ticket_no', '=', 'tickets.ticket_no');
        })
        ->leftJoin('supplier', function ($join) {
            $join->on('refund.supplier', '=', 'supplier.id');
        })
        ->leftJoin('agent', function ($join) {
            $join->on('refund.agent', '=', 'agent.id');
        });
        
        // Date filtering
        if ($startDate && $endDate) {
            $query->whereBetween('refund.date', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->where('refund.date', '>=', $startDate);
        } elseif ($endDate) {
            $query->where('refund.date', '<=', $endDate);
        }
        
        // Filter by authenticated user if needed
        $query->where('refund.user', Auth::id()); // Assuming there's a user column in the Refund model
        
        // Optionally select specific columns to avoid ambiguity
        $query->select('refund.*', 'tickets.passenger', 'agent.name as agent_name', 'supplier.name as supplier_name');
        
        // Add additional filters or selects based on your needs
        $refunds = $query->get();
        
        $html = ViewFacade::make('report/refund_ticket/report', [
              
            'start_date' => $startDate,
            'end_date' => $endDate,
            'showProfit' => $showProfit,
            'showSupplier' => $showSupplier,
            'showAgent' => $showAgent,
           
            'refunds' => $refunds,
         
        ])->render();
        $html = ViewFacade::make('report/refund_ticket/index', [
              
            'start_date' => $startDate,
            'end_date' => $endDate,
            'showProfit' => $showProfit,
            'showSupplier' => $showSupplier,
            'showAgent' => $showAgent,
           
            'refunds' => $refunds,
         
        ])->render();
        
        return response()->json(['html' => $html]);

            // dd($refunds, $agent);
        }
        else{
            return view('welcome');
        }
    }

    
    // public function edit($id)
    // {
    //     if(Auth::user()){
    //         $id = decrypt($id);
    //         $supplier = Supplier::findOrFail($id);
    //         return view('supplier.edit', compact('supplier'));
    //     }
    //     else{
    //         return view('welcome');
    //     }
        
    // }
    //     public function update(Request $request, $id)
    //     {
    //         // dd($request->all(), $id);

    //         if(Auth::user()){
    //             $validatedData = $request->validate([
    //                 'name' => 'required|string|max:255',
    //                 'phone' => 'required|string|max:20',
    //                 'description' => 'required|string',
    //             ]);
    
    //             if($validatedData){
    //                 $supplier = Supplier::find($id);
    //                 $supplier->name = $request->name;
    //                 $supplier->phone = $request->phone;
    //                 $supplier->description = $request->description;
                    
    
    //                 if($supplier->save()){
    //                     return redirect()->route('supplier.view')->with('success', 'Supplier updated successfully');
    //                 }
    //                 else{
    //                     return redirect()->route('supplier.view')->with('error', 'Supplier updated failed');
    //                 }
    //             }         
    
    //             return redirect()->route('supplier.view')->with('error', 'Supplier updated failed');
    //         }
    //         else{
    //             return view('welcome');
    //         }
           
    //     }

    // public function delete($id)
    // {
    //     if(Auth::user()){
    //         $supplier = Supplier::findOrFail($id);
    //         $supplier->is_delete = 1;
    //         if($supplier->save()){
    //             return redirect()->route('supplier.view')->with('success', 'Supplier deleted successfully');
    //         }
    //         else{
    //             return redirect()->route('supplier.view')->with('error', 'Supplier deleted failed');
    //         }
    //         return redirect()->route('supplier.view')->with('error', 'Supplier deleted failed');
    //     }
    //     else{
    //         return view('welcome');
    //     }
      
        
    // }
}

?>