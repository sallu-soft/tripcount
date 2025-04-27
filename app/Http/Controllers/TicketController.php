<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Supplier;
use App\Models\Agent;
use App\Models\Airline;
use App\Models\AIT;
use App\Models\Receiver;
use App\Models\Type;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\Refund;
use Illuminate\View\View;
use DateTime;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        if(Auth::user()){
            $user = Auth::id();
            $suppliers = Supplier::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $agents = Agent::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $types = Type::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $tickets = Ticket::where([['is_delete',0],['is_active',1],['user', $user]])->get();
            $airlines = Airline::get();
    
            $suppliersID = Supplier::pluck('name', 'id');
            $agentsID = Agent::pluck('name', 'id');
            // dd($orders);
            // dd($suppliers);
            // dd($tickets);
            return view('ticket/index', compact('suppliers', 'agents', 'types', 'tickets','airlines', 'suppliersID', 'agentsID'));
        }
        else{
            return view('welcome');
        }
       
    }

    public function searchAirline(Request $request)
    {
        $ticketCode = $request->input('ticketCode');

        if (is_numeric($ticketCode) && (int) $ticketCode == $ticketCode) {
              
            $find = DB::table('airlines')->where('ID', $ticketCode)->first();
            if($find){
                return response()->json(['message' => 'Success', 'airline' => $find]);
            }
            return response()->json(['message' => 'Failed No such AirLine']);

        } else {
                
            $find = DB::table('airlines')->where('Full', $ticketCode)->first();
            if($find){
                return response()->json(['message' => 'Success', 'airline' => $find]);
            }
            return response()->json(['message' => 'Failed No such AirLine']);
        }
      
    }
    
    private function allValuesExist($array) {
        foreach ($array as $value) {
            if (!isset($value) || empty($value)) {
                return false;
            }
        }
        return true;
    }

    public function checkResult(Request $request) {
        $result = $request->input('result');
    
        // Get all ticket numbers for the authenticated user
        $allticketno = Ticket::where([
            ['user', Auth::id()],
            ['is_delete', 0], 
            ['is_active', 1]
        ])->pluck('ticket_no')->toArray();
    
        // Check if the 'result' exists in the ticket numbers
        $exists = in_array($result, $allticketno);
    
        if ($exists) {
            // Find duplicate ticket numbers if 'result' is present
            $duplicateTicketNos = array_keys(array_count_values($allticketno), 2); // Finds duplicates
        } else {
            $duplicateTicketNos = [];
        }
    
        // Return JSON response with the result and duplicates
        return response()->json([
            'exists' => $exists,
            'duplicates' => $exists ? $duplicateTicketNos : []
        ]);
    }
    
    public function store(Request $request)
    {
        if (Auth::user()) {
            $ticketNoKeys = array_keys($request['ticket_no']);
            $passengerNameKeys = array_keys($request['passenger_name']);
            $invoiceNumberKeys = array_keys($request['invoice_no']);
            $user = Auth::id();
            $flag = false;

            // Check if the keys in "passenger_name", "ticket_no", and "invoice_no" match and if they have values
            if ($ticketNoKeys === $passengerNameKeys && $this->allValuesExist($request['passenger_name']) && $ticketNoKeys === $invoiceNumberKeys) {
                try {
                    DB::beginTransaction();  // Start a database transaction

                    foreach ($request['ticket_no'] as $index => $ticketNumber) {
                        // Determine whether supplier is from the supplier table or agent table
                        $who = $request['supplier'];
                        if (strpos($who, 'agent_') === 0) {
                            // Supplier is an agent
                            $type = 'agent';
                            $who_id = str_replace('agent_', '', $who);
                        } else {
                            // Supplier is a regular supplier
                            $type = 'supplier';
                            $who_id = $who;
                        }

                        // Proceed with ticket creation
                        $ticket = new Ticket();
                        $ticket->flight_date = $request['flight_date'];
                        $ticket->return = $request['return_date'];
                        $ticket->class = $request['class'];
                        $ticket->class_code = $request['class_code'];
                        $ticket->person = $request['person'];
                        $ticket->invoice_date = $request['invoice_date'];
                        $ticket->date = $request['invoice_date'];
                        $ticket->invoice = $request['invoice_no'][$index];
                        $ticket->ticket_no = $ticketNumber;
                        $ticket->sector = $request['sector'];

                        // Split the sector into s_from and e_to
                        $sectorParts = explode('-', $request['sector']);
                        $ticket->s_from = $sectorParts[0];
                        $ticket->e_to = end($sectorParts);

                        $ticket->stuff = $request['stuff'];
                        $ticket->passenger = $request['passenger_name'][$index];
                        $ticket->airline_name = $request['airlines_name'];
                        $ticket->airline_code = $request['airlines_code'];
                        $ticket->pnr = $request['pnr'];
                        $ticket->ticket_code = $request['ticket_code'];
                        $ticket->agent = $request['agent'];

                        // Set supplier or agent based on the type
                        if ($type === 'supplier') {
                            $ticket->supplier = $who_id;
                        }
                        $ticket->who = $request['supplier'];  // Original supplier or agent info

                        $ticket->agent_price = $request['agent_price'];
                        $ticket->supplier_price = $request['supplier_price'];
                        $ticket->flight_no = $request['flight_no'];
                        $ticket->remark = $request['remark'];

                        // Calculate profit
                        $ticket->profit = floatval($request['agent_price']) - floatval($request['supplier_price']);
                        $ticket->user = $user;
                        $ticket->ait = $request['ait'];

                        // Update agent balance
                        $agent_acc = Agent::find($request['agent']);
                        if (!$agent_acc) {
                            return redirect()->back()->with('error', 'Agent not found.');
                        }
                        $agent_previous_amount = $agent_acc->amount;
                        $agent_new_amount = floatval($agent_previous_amount) + floatval($request['agent_price']);
                        $agent_acc->amount = $agent_new_amount;
                        $agent_acc->save();

                        $ticket->agent_previous_amount = $agent_previous_amount;
                        $ticket->agent_new_amount = $agent_new_amount;

                        // Update supplier or agent balance based on the type
                        if ($type === 'supplier') {
                            $supplier = Supplier::find($who_id);
                        } else {
                            $supplier = Agent::find($who_id);
                        }

                        if (!$supplier) {
                            return redirect()->back()->with('error', 'Supplier not found.');
                        }
                        $supplier_prev_amount = $supplier->amount;
                        $supplier_new_amount = floatval($supplier_prev_amount) + floatval($request['supplier_price']);
                        $supplier->amount = $supplier_new_amount;
                        $supplier->save();

                        $ticket->supplier_prev_amount = $supplier_prev_amount;
                        $ticket->supplier_new_amount = $supplier_new_amount;

                        // Save the ticket
                        $flag = $ticket->save();
                    }

                    if ($flag) {
                        // If AIT is provided, save AIT information
                        if ($request['ait']) {
                            $ait = new AIT();
                            $ait->ticket_invoice = $request['invoice_no'];
                            $ait->ait_amount = $request['ait'];
                            $ait->total_amount = $request['ait'] * count($request['ticket_no']);
                            $ait->sector = $request['sector'];
                            $ait->user = $user;
                            $ait->airline_name = $request['airlines_name'];
                            $ait->save();
                        }

                        // Commit the transaction
                        DB::commit();
                        return redirect()->route('ticket.view')->with('success', 'Tickets added successfully.');
                    } else {
                        return redirect()->route('ticket.view')->with('error', 'Something went wrong.');
                    }

                } catch (\Exception $e) {
                    // Rollback the transaction on error
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Error adding tickets: ' . $e->getMessage());
                }
            } else {
                return redirect()->back()->with('error', 'Mismatch between passenger names and ticket numbers.');
            }
        } else {
            return view('welcome');
        }
    }



   
    public function store_single(Request $request)
    {
        if(Auth::user()){
            $user = Auth::id();

            try {
                DB::beginTransaction();

                // Get supplier value
                $who = $request['supplier'];
                
                // Check if the value contains "agent_"
                if (strpos($who, 'agent_') === 0) {
                    // This is an agent
                    $type = 'agent';
                    $who_id = str_replace('agent_', '', $who);
                } else {
                    // This is a supplier
                    $type = 'supplier';
                    $who_id = $who;
                }

                $ticket = new Ticket();
                $ticket->flight_date = $request['flight_date'];
                $ticket->return = $request['return_date'];
                $ticket->class = $request['class'];
                $ticket->class_code = $request['class_code'];
                $ticket->person = $request['person'];
                $ticket->invoice_date = $request['invoice_date'];
                $ticket->date = $request['invoice_date'];
                $ticket->invoice = $request['invoice_no'];
                $ticket->ticket_no = $request['ticket_no'];
                $ticket->sector = $request['sector'];

                // Split the sector into parts
                $sector = $request['sector'];
                $parts = explode('-', $sector);
                $ticket->s_from = $parts[0]; // First part
                $ticket->e_to = end($parts); // Last part

                $ticket->stuff = $request['stuff'];
                $ticket->passenger = $request['passenger_name'];
                $ticket->airline_name = $request['airlines_name'];
                $ticket->airline_code = $request['airlines_code'];
                $ticket->pnr = $request['pnr'];

                $ticket->ticket_code = $request['ticket_code'];
                $ticket->agent = $request['agent'];

                // Assign supplier or agent based on type
                if ($type === 'supplier') {
                    $ticket->supplier = $who_id; // Real supplier ID
                }
                $ticket->who = $request['supplier']; // Store original who value (agent or supplier)
                $ticket->agent_price = $request['agent_price'];
                $ticket->supplier_price = $request['supplier_price'];
                $ticket->flight_no = $request['flight_no'];
                $ticket->remark = $request['remark'];
                $ticket->discount = $request['discount'];
                
                // Calculate profit
                $profit = floatval($request['agent_price']) - floatval($request['supplier_price']);
                $ticket->profit = $profit;
                $ticket->user = $user;
                $ticket->ait = $request['ait'];

                // Update agent's balance
                $agent_acc = Agent::find($request['agent']);
                $agent_previous_amount = $agent_acc->amount;
                $agent_new_amount = floatval($agent_previous_amount) + floatval($request['agent_price']);
                $agent_acc->amount = $agent_new_amount;

                // Update supplier or agent based on type
                if ($type === 'supplier') {
                    $supplier_acc = Supplier::find($who_id);
                } else {
                    $supplier_acc = Agent::find($who_id);
                }

                $supplier_prev_amount = $supplier_acc->amount;
                $supplier_new_amount = floatval($supplier_prev_amount) + floatval($request['supplier_price']);
                $supplier_acc->amount = $supplier_new_amount;

                // Track previous and new amounts for both agent and supplier
                $ticket->agent_previous_amount = $agent_previous_amount;
                $ticket->agent_new_amount = $agent_new_amount;
                $ticket->supplier_prev_amount = $supplier_prev_amount;
                $ticket->supplier_new_amount = $supplier_new_amount;

                // Save ticket and update accounts
                if($ticket->save()) {
                    $agent_acc->save();
                    $supplier_acc->save();

                    // Handle AIT
                    if($request['ait']) {
                        $ait = new AIT();
                        $ait->ticket_invoice = $request['invoice_no'];
                        $ait->ait_amount = $request['ait_amount'];
                        $ait->total_amount = $request['ait'];
                        $ait->sector = $request['sector'];
                        $ait->user = $user;
                        $ait->airline_name = $request['airlines_name'];

                        $ait->save();
                    }

                    // Commit the transaction
                    DB::commit();
                    return redirect()->route('ticket.view')->with('success', 'Tickets added successfully');
                } else {
                    return redirect()->route('ticket.view')->with('error', 'Something went wrong');
                }

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Error adding tickets: ' . $e->getMessage());
            }
        } else {
            return view('welcome');
        }
    }

    public function edit($id)
    {
        if(Auth::user()){
                // $id = decrypt($id);
            $user = Auth::id();
            $ticket = Ticket::findOrFail($id);
            $suppliers = Supplier::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $agents = Agent::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            return view('ticket.edit', compact('ticket', 'suppliers', 'agents'));
        }
        else{
            return view('welcome');
        }
      
    }
   
    public function update(Request $request)
    {
        if (Auth::user()) {
            DB::beginTransaction();
            try {
                // dd($request->all());
                if ($request['ticket_id'] != null) {

                      // Get supplier value
                    $who = $request['supplier'];
                    $who_id = '';
                    // Check if the value contains "agent_"
                    if (strpos($who, 'agent_') === 0) {
                        // This is an agent
                        $type = 'agent';
                        $who_id = str_replace('agent_', '', $who);
                    } else {
                        // This is a supplier
                        $type = 'supplier';
                        $who_id = $who;
                    }
                    $ticket = Ticket::findOrFail($request['ticket_id']); 


                    $ticket->agent = $request['agent'];
                    // Assign supplier or agent based on type
                    if ($type == 'supplier') {
                        $ticket->supplier = $who_id; // Ensure $who_id is a valid integer
                    } else {
                        $ticket->supplier = null; // Use null instead of an empty string
                    }
                    
                    $ticket->who = $request['supplier']; // Store original who value (agent or supplier)                    $ticket->invoice_date = $request['invoice_date'];
                    $ticket->stuff = $request['stuff'];
                    $ticket->flight_date = $request['flight_date'];
                    $ticket->sector = $request['sector'];
                    $ticket->flight_no = $request['flight_no'];
                    $ticket->passenger = $request['passenger_name'];
                    $ticket->agent_price = $request['agent_price'];
                    $ticket->supplier_price = $request['supplier_price'];
                    $ticket->airline_code = $request['airlines_code'];
                    $ticket->airline_name = $request['airlines_name'];
                    $ticket->ticket_code = $request['ticket_code'];
                    $ticket->ticket_no = $request['ticket_no'];
                    $ticket->discount = $request['discount'];
                    $ticket->remark = $request['remark'];

                    $profit = floatval($request['agent_price']) - floatval($request['supplier_price']);
                    $ticket->profit = $profit;

                    $agent = Agent::where('id', $request['agent'])->first();

                    // Update supplier or agent based on type
                    // dd($who_id, $type);
                    if ($type === 'supplier') {
                        $supplier = Supplier::where('id', $request['supplier'])->first();
                    } else {
                        $supplier = Agent::where('id', $who_id)->first();
                    }

                    $agent->amount -= $request['prev_agent_price'];
                    $agent->amount += $request['agent_price'];

                    $supplier->amount -= $request['prev_supplier_price'];
                    $supplier->amount += $request['supplier_price'];

                    $agent->save();
                    $supplier->save();
                    $ticket->save();

                    DB::commit();
                    return redirect()->route('ticket.view')->with('Success', 'Ticket updated ');
                }

                DB::rollBack();
                return redirect()->route('ticket.view')->with('error', 'Ticket update failed');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('ticket.view')->with('error', 'Ticket update failed: ' . $e->getMessage());
            }
        } else {
            return view('welcome');
        }
    }

    public function delete($id)
    {
        if(Auth::user()){
            $ticket = Ticket::findOrFail($id);
            $ticket->is_delete = 1;
            if($ticket->save()){
                return redirect()->route('ticket.view')->with('success', 'Ticket deleted successfully');
            }
            else{
                return redirect()->route('ticket.view')->with('error', 'Ticket deleted failed');
            }
            return redirect()->route('ticket.view')->with('error', 'Ticket deleted failed');
        }
        else{
            return view('welcome');
        }
        
    }

    public function view($id){
        if(Auth::user()){
            $ticket = Ticket::findOrFail($id); 
            $agent = Agent::where('id', $ticket->agent)->first();
            return view('ticket.view', compact('ticket', 'agent'));
        }
        else{
            return view('welcome');
        }
    }

    // public function refundindex(){
    //     return view('ticket.refund');
    // }
    public function refundindex(Request $request)
    {
        if(Auth::user()){
            $user = Auth::id();
        $suppliers = Supplier::where([['is_delete',0],['is_active',1],['user',$user]])->get();
        $agents = Agent::where([['is_delete',0],['is_active',1],['user',$user]])->get();
        
        $query = Refund::where([]);

        // Add search functionality
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('ticket_no', 'like', '%' . $searchTerm . '%')
                      ->orWhere('passenger_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('date', 'like', '%' . $searchTerm . '%');
            });
        }
        $refund_ticket = $query->paginate(10);
        foreach($refund_ticket as $order){
           
            $order->agent = Agent::where('id', $order->agent)->value('name');
            $order->supplier = Supplier::where('id', $order->supplier)->value('name');
        }
        
        return view('ticket.refund', compact('refund_ticket'));
        }
        else{
            return view('welcome');
        }
        
    }

    public function searchTicket(Request $request){
        if(Auth::user()){
            $ticketNumber = $request->ticketNumber;
            $ticket = Ticket::where('ticket_no', $ticketNumber)->first();

            if ($ticket) {
                // Ticket found
                $agent = Agent::where('id', $ticket->agent)->value('name');
                $supplier = Supplier::where('id', $ticket->supplier)->value('name');
                return response()->json(['status' => 'success', 'ticket' => $ticket, 'agent' => $agent, 'supplier' => $supplier]);
            } else {
                // Ticket not found
                return response()->json(['status' => 'error', 'message' => 'Ticket not found']);
            }
        }
        else{
            return view('welcome');
        }
        
    }

    public function receiveAmount(Request $request)
    {
        if(Auth::user()){
                 // $receiver = DB::table($request->agent_supplier)->where('id', $request->agent_supplier_id)->first();
        $tableName = $request->agent_supplier;

        $receiver = DB::table($tableName)->where('id', $request->agent_supplier_id)->first();
    
        if (!$receiver) {
            return response()->json(['error' => 'Receiver not found'], 404);
        }
    
        $receiver_previous_amount = $receiver->amount;
        $current_amount = floatval($receiver->amount) - floatval($request->amount);
    
      
        // Retrieve previous and current amounts
        $receiver_previous_amount = $receiver->amount;
        $current_amount = floatval($receiver->amount) - floatval($request->amount);

        // Create a new instance of the Receiver model
        $receiver_mdl = new Receiver();

        // Set properties for the Receiver model
        // dd($request->all());
        $receiver_mdl->receive_from = $request->agent_supplier;
        $receiver_mdl->agent_supplier_id = $request->agent_supplier_id;
        $receiver_mdl->method = $request->payment_mode;
        $receiver_mdl->remark = $request->remark;
        $receiver_mdl->invoice = $request->reff_no;
        $receiver_mdl->amount = $request->amount;
        $receiver_mdl->user = Auth::id();
        $receiver_mdl->date = now()->format('Y-m-d'); // Use Laravel's now() for date formatting
        $receiver_mdl->previous_amount = $receiver_previous_amount;
        $receiver_mdl->current_amount = $current_amount;

        // Save the new Receiver record
        $receiver_mdl->save();

        // $receiver->amount = $current_amount;
        // $receiver->save();
          // Update the record in the database
        DB::table($tableName)
          ->where('id', $request->agent_supplier_id)
          ->update(['amount' => $current_amount]);


        // Optionally, you might want to return a response indicating success or failure
        return response()->json(['message' => 'Amount received successfully']);
        }
        else{
            return view('welcome');
        }
       
    }


    public function getAgentSupplier(Request $request){
        if(Auth::user()){
            $who = $request->input('who');
            $allowedTables = ['agent', 'supplier']; // Update with your allowed table names
            if (!in_array($who, $allowedTables)) {
                return response()->json(['error' => 'Invalid table name'], 400);
            }
        
            $list_all = DB::table($who)
                            ->where('is_delete', 0)
                            ->where('is_active', 1)
                            ->where('user', Auth::id())
                            ->get();
        
            return response()->json($list_all);
        }
        else{
            return view('welcome');
        }
        
    }

    // public function getlastid(){
    //     try {
    //         $lastId = Ticket::latest('id')->value('id');
    //         return response()->json(['lastId' => $lastId]);
    //     } catch (\Exception $e) {
    //         // Handle any exceptions that might occur during the process
    //         return response()->json(['error' => 'Error fetching last ID'], 500);
    //     }     
    // }

    public function getlastid(){
        if(Auth::user()){
            try {
                $lastId = Ticket::latest('id')->value('id');
                $newInvoice = 0;
    
                if ($lastId) {
                    $ticket = Ticket::find($lastId);
                    if ($ticket) {
                        $invoice = $ticket->invoice;
                        $parts = explode("-", $invoice);
                        $partAfterHyphen = end($parts); // Extract part after hyphen
                        $newPartAfterHyphen = floatval($partAfterHyphen) + 1; // Increment invoice number
                        $newInvoice = $parts[0] . "-" . str_pad($newPartAfterHyphen, strlen($partAfterHyphen), '0', STR_PAD_LEFT); // Concatenate back to original format
                        
                    } else {
                       
                    }
                }
                else{
                    $lastId = 0;
                    $newInvoice = "INVT-0000001";
                }
          
                return response()->json(['lastId' => $lastId, 'invoice' => $newInvoice]);
    
            } catch (\Exception $e) {
               
                return response()->json(['error' => 'Error fetching last ID'], 500);
            }  
        }
        else{
            return view('welcome');
        }
          
    }
    public function deportee() {
        if(Auth::user()){
            $user = Auth::id();
            $suppliers = Supplier::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $agents = Agent::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $types = Type::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $tickets = Ticket::where([['is_delete',0],['is_active',1],['user', $user]])->get();
            foreach($tickets as $order){
               
                $order->agent = Agent::where('id', $order->agent)->value('name');
                $order->supplier = Supplier::where('id', $order->supplier)->value('name');
            }
            // dd($orders);
            // dd($suppliers);
            return view('deportee.index', compact('suppliers', 'agents', 'types', 'tickets'));
        }
        else{
            return view('welcome');
        }
      
    }
    
    
}

?>