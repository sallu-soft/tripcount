<?php

namespace App\Http\Controllers;

use App\Models\ADM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Supplier;
use App\Models\Agent;
use App\Models\Type;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\Refund;
use Illuminate\View\View;
use DateTime;
use Illuminate\Support\Facades\DB;

class ADMController extends Controller
{
    public function view(Request $request)
    {
        $user = Auth::id();
        $suppliers = Supplier::where([['is_delete',0],['is_active',1],['user',$user]])->get();
        $agents = Agent::where([['is_delete',0],['is_active',1],['user',$user]])->get();
        
        $query = ADM::where([['is_delete',0],['is_active',1],['user',$user]]);

        // Add search functionality
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('ticket_no', 'like', '%' . $searchTerm . '%')
                      ->orWhere('invoice_date', 'like', '%' . $searchTerm . '%')
                      ->orWhere('invoice', 'like', '%' . $searchTerm . '%');
            });
        }

        $adm = $query->paginate(10);
        foreach($adm as $order){
           
            $order->agent = Agent::where('id', $order->agent)->value('name');
            $order->supplier = Supplier::where('id', $order->supplier)->value('name');
        }
        // dd($orders);
        // dd($suppliers);
        return view('ticket.adm', compact('suppliers', 'agents', 'adm',));
    }
    public function adm_entry(Request $request)
    {
        // Validation rules can be adjusted based on your requirements
        // dd($request);
        $user = Auth::id();
        $ticket = new ADM();
        $ticket->flight_date = $request['flight_date'];
        $ticket->invoice_date = $request['invoice_date'];
        $ticket->invoice = $request['invoice_no'];
        $ticket->ticket_no = $request['ticket_no'];
        $ticket->sector = $request['sector'];
        $ticket->stuff = $request['stuff'];
        $ticket->passenger = $request['passenger_name'];
        $ticket->airline_name = $request['airlines_name'];
        $ticket->airline_code = $request['airlines_code'];
        $ticket->ticket_code = $request['ticket_code'];
        $ticket->agent = $request['agent'];
        $ticket->supplier = $request['supplier'];
        $ticket->agent_adm_price = $request['agent_adm_price'];
        $ticket->supplier_adm_price = $request['supplier_adm_price'];
        $ticket->flight_no = $request['flight_no'];
        $ticket->remark = $request['remark'];
        $ticket->user = $user;
        
        try {
            // Save the ticket to the database
            $ticket->save();
    
            return redirect()->route('adm.view')->with('success', 'ADM Ticket Added successfully');
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return redirect()->route('adm.view')->with('error', 'Adding ADM Ticket failed: ' . $e->getMessage());
        }
    }
    public function getlastidadm(){
        try {
            $lastId = ADM::latest('id')->value('id');
            return response()->json(['lastId' => $lastId]);
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during the process
            return response()->json(['error' => 'Error fetching last ID'], 500);
        }     
    }
 
}