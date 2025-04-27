<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Supplier;
use App\Models\Agent;
use App\Models\Deportee;
use App\Models\Type;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\VoidTicket;
use Illuminate\View\View;
use DateTime;
use Illuminate\Support\Facades\DB;

class DeporteeController extends Controller
{
    public function view(Request $request) {
        $user = Auth::id();
        $suppliers = Supplier::where([['is_delete',0],['is_active',1],['user',$user]])->get();
        $agents = Agent::where([['is_delete',0],['is_active',1],['user',$user]])->get();
        
        $query = Deportee::where([['is_delete',0],['is_active',1],['user',$user]]);

        // Add search functionality
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('ticket_no', 'like', '%' . $searchTerm . '%')
                      ->orWhere('invoice_date', 'like', '%' . $searchTerm . '%')
                      ->orWhere('invoice', 'like', '%' . $searchTerm . '%');
            });
        }

        $deportee = $query->paginate(10);
        foreach($deportee as $order){
           
            $order->agent = Agent::where('id', $order->agent)->value('name');
            $order->supplier = Supplier::where('id', $order->supplier)->value('name');
        }
        // dd($orders);
        // dd($suppliers);
        return view('deportee.index', compact('suppliers','deportee','agents',));
    }
    

    public function deportee_ticket_entry(Request $request)
    {
        // Validation rules can be adjusted based on your requirements
        // dd($request);
        $user = Auth::id();
        $ticket = new Deportee();
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
        $ticket->agent_deportee_price = $request['agent_deportee_price'];
        $ticket->supplier_deportee_price = $request['supplier_deportee_price'];
        $ticket->flight_no = $request['flight_no'];
        $ticket->remark = $request['remark'];
        $ticket->user = $user;
        // dd($ticket);
        try {
            // Save the ticket to the database
            $ticket->save();
    
            return redirect()->route('deportee.index')->with('success', 'Deportee Ticket Added successfully');
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return redirect()->route('deportee.index')->with('error', 'Adding Deportee Ticket failed: ' . $e->getMessage());
        }
    }
    public function getlastiddeportee(){
        try {
            $lastId = Deportee::latest('id')->value('id');
            return response()->json(['lastId' => $lastId]);
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during the process
            return response()->json(['error' => 'Error fetching last ID'], 500);
        }     
    }
    


}