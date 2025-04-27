<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Supplier;
use App\Models\Agent;
use App\Models\Type;
use App\Models\Order;
use Illuminate\View\View;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class OrderController extends Controller
{
    public function index()
    {
        if(Auth::user()){
            $user = Auth::id();
            $suppliers = Supplier::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $agents = Agent::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $types = Type::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $orders = Order::where([['is_delete',0],['is_active',1],['user', $user]])->get();
     
            return view('order/index', compact('suppliers', 'agents', 'types', 'orders'));
        }
        else{
            return view('welcome');
        }
       
    }


    public function orderExists($type, $passport_no)
    {
        // Check if an order with the same type and passport number exists
        return Order::where('type', $type)
                    ->where('passport_no', 'LIKE', "%{$passport_no}%")
                    ->exists();
    }
   
    public function store(Request $request)
    {
        if (Auth::user()) {
            // dd($request->all());
            try {
                // Access request data directly without validation
                $data = $request->all();
                $condition = false;

                foreach ($data['passport_no'] as $passport) {
                    // Retrieve orders with the same type
                    $orders = Order::where('type', $data['type'])->get();

                    // Loop through the orders and check if any contain the current passport number
                    foreach ($orders as $order) {
                        $db_passports = explode(',', $order->passport_no); // Split the stored passport numbers
                        if (in_array($passport, $db_passports)) {
                            $condition = true;
                            break; // Exit loop if a match is found
                        }
                    }
                }

                if ($condition) {
                    return redirect()->route('order.view')->with('error', 'An order with the same type and passport number already exists.');
                }

                DB::beginTransaction();

                $who = $data['supplier'];
                $parts = explode('_', $who);

                $type = $parts[0]; // "supplier"
                $who_id = $parts[1]; // "81"

                // Create new order
                $order = new Order();
                $order->name = implode(',', $data['name']); // Concatenate multiple names into a single string
                $order->date = $data['date'];
                $order->type = $data['type'];
                $order->agent = $data['agent'];
                $order->passport_no = implode(',', $data['passport_no']); // Concatenate multiple passport numbers
                $order->contact_amount = $data['contact_amount'];
                $order->payable_amount = $data['payable_amount'];
                $order->country = $data['country'];
                if ($type == 'supplier') {
                    $order->supplier = $who_id;
                }
                $order->who = $data['supplier'];
                $order->remark = $data['remark'];
                $order->invoice = $data['invoice'];

                // Calculate profit
                if ($request->has('other_expense')) {
                    $profit = $request->contact_amount - ($request->payable_amount + $request->other_expense);
                } else {
                    $profit = $request->contact_amount - $request->payable_amount;
                }
                $order->profit = $profit;

                // Get current user ID
                $data['user'] = Auth::id();
                $order->user = $data['user'];

                // Update agent's amount
                $agent = Agent::find($data['agent']);
                if (!$agent) {
                    return redirect()->route('order.view')->with('error', 'Agent not found');
                }
                $agent_prev_amount = $agent->amount;
                $agent_new_amount = floatval($agent->amount) + floatval($request->contact_amount);

                $data['agent_prev_amount'] = $agent_prev_amount;
                $data['agent_new_amount'] = $agent_new_amount;

                $order->agent_previous_amount = $agent_prev_amount;
                $order->agent_new_amount = $agent_new_amount;

                $agent->amount += $request->contact_amount;
                $agent->save();

                // Update supplier's amount
                // $supplier = Supplier::find($who_id);
                 // Check if the supplier exists
                if($type == 'supplier') {                   
                    $supplier = Supplier::find($who_id);
                }
                else{
                    $supplier = Agent::find($who_id);
                }
                if (!$supplier) {
                    return redirect()->route('order.view')->with('error', 'Supplier not found');
                }
                $supplier_prev_amount = $supplier->amount;
                $supplier_new_amount = floatval($supplier->amount) + floatval($request->payable_amount);

                $data['supplier_prev_amount'] = $supplier_prev_amount;
                $data['supplier_new_amount'] = $supplier_new_amount;

                $order->supplier_previous_amount = $data['supplier_prev_amount'];
                $order->supplier_new_amount = $data['supplier_new_amount'];

                $supplier->amount += $request->payable_amount;
                $supplier->save();

                // Save the order
                $isdone = $order->save();
                if ($isdone) {
                    DB::commit(); // Commit the transaction if saving is successful
                    return redirect()->route('order.view')->with('success', 'Order added successfully');
                }
            } catch (\Throwable $e) {
                DB::rollBack(); // Roll back the transaction if an exception occurs
                return redirect()->route('order.view')->with('error', $e->getMessage());
            }
        } else {
            return view('welcome');
        }
    }

    
    
    public function store_multiple(Request $request)
    {
        if (Auth::user()) {
            try {
                DB::beginTransaction();
                $passengerCount = count($request->passenger);
                
                for ($i = 0; $i < $passengerCount; $i++) {
                    if ($this->orderExists($request->invoice_type, $request->passport[$i])) {
                        return redirect()->route('order.view')
                            ->with('error', 'An order with the same type and passport number ' . $request->passport[$i] . ' already exists.');
                    }
                    
                    $who = $request->supplier;
                    $parts = explode('_', $who);

                    $type = $parts[0]; // "supplier"
                    $who_id = $parts[1]; // "81"

                    $order = new Order();
                    $order->name = $request->passenger[$i]; // Assuming $request->passenger is an array
                    $order->date = $request->invoice_date;
                    $order->type = $request->invoice_type;
                    $order->agent = $request->agent;
                    $order->passport_no = $request->passport[$i]; // Assuming $request->passport is an array
                    $order->contact_amount = $request->agent_price;
                    $order->payable_amount = $request->supplier_price;
                    $order->country = $request->country;
                    if ($type == 'supplier') {
                        $order->supplier = $who_id;
                    }
                    $order->who = $request->supplier;
                    $order->remark = $request->remark;
                    $order->invoice = $request->invoice_no;
                
                    // Calculate profit
                    if ($request->has('other_expense')) {
                        $profit = $request->agent_price - ($request->supplier_price + $request->other_expense);
                    } else {
                        $profit = $request->agent_price - $request->supplier_price;
                    }
                    $order->profit = $profit;
                    $order->user = Auth::id();
            
                    // Update agent's amount
                    $agent = Agent::find($request->agent);
                    if (!$agent) {
                        return redirect()->route('order.view')->with('error', 'Agent not found.');
                    }
        
                    $agent_prev_amount = $agent->amount;
                    $agent_new_amount = floatval($agent->amount) + floatval($request->agent_price);
        
                    $order->agent_previous_amount = $agent_prev_amount;
                    $order->agent_new_amount = $agent_new_amount;
        
                    $agent->amount += $request->agent_price;
                    $agent->save();
                    
                    // Update supplier's amount
                    // $supplier = Supplier::find($who_id);
                     // Check if the supplier exists
                    if($type == 'supplier') {                   
                        $supplier = Supplier::find($who_id);
                    }
                    else{
                        $supplier = Agent::find($who_id);
                    }
                    if (!$supplier) {
                        return redirect()->route('order.view')->with('error', 'Supplier not found.');
                    }
        
                    $supplier_prev_amount = $supplier->amount;
                    $supplier_new_amount = floatval($supplier->amount) + floatval($request->supplier_price);
        
                    $order->supplier_previous_amount = $supplier_prev_amount;
                    $order->supplier_new_amount = $supplier_new_amount;
        
                    $supplier->amount += $request->supplier_price;
                    $supplier->save();

                    $isdone = $order->save();
                }

                if ($isdone) {
                    DB::commit(); // Commit the transaction if saving is successful
                    return redirect()->route('order.view')->with('success', 'Order added successfully');
                }
            } catch (\Throwable $e) {
                DB::rollBack(); // Roll back the transaction if an exception occurs
                return redirect()->route('order.view')->with('error', $e->getMessage());
            }
        } else {
            return view('welcome');
        }
    }


    public function getlastid(){
      if(Auth::user()){
        try {
            $lastId = Order::latest('id')->value('id');
            $newInvoice = 0;

            if ($lastId) {
                $order = Order::find($lastId);
                if ($order) {
                    $invoice = $order->invoice;
                    $parts = explode("-", $invoice);
                    $partAfterHyphen = end($parts); // Extract part after hyphen
                    $newPartAfterHyphen = floatval($partAfterHyphen) + 1; // Increment invoice number
                    $newInvoice = $parts[0] . "-" . str_pad($newPartAfterHyphen, strlen($partAfterHyphen), '0', STR_PAD_LEFT); // Concatenate back to original format
                    
                } else {
                   
                }
            }
            else{
                $lastId = 0;
                $newInvoice = "VS-00001";
            }
       
            return response()->json(['lastId' => $lastId, 'invoice' => $newInvoice]);

        } catch (\Exception $e) {
            // Handle any exceptions that might occur during the process
            return response()->json(['error' => 'Error fetching last ID'], 500);
        }     
      }
      else{
        return view('welcome');
      }
    }

    public function edit($id)
    {
        if(Auth::user()){
            $id = decrypt($id);
            $user = Auth::id();
            $suppliers = Supplier::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $agents = Agent::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $types = Type::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $order = Order::findOrFail($id);
            return view('order.edit', compact('order','suppliers','types', 'agents'));
        }
        else{
            return view('welcome');
        }
        
    }


    public function update(Request $request, $id)
    {
        if (Auth::user()) {
            $order = Order::findOrFail($id); // Fetch the current order

            $data = $request->all();

            // Check if the passport number or type has been changed
            $originalPassport = $order->passport_no;
            $originalType = $order->type;

            $newPassport = $request->input('passport_no');
            $newType = $request->input('type');

            // Ensure newPassport is an array or a single string
            if (!is_array($newPassport)) {
                $newPassport = explode(',', $newPassport); // Convert to an array if it's a string
            }

            if ($originalPassport !== implode(',', $newPassport) || $originalType !== $newType) {
                // Perform duplicate check only if passport or type has changed
                foreach ($newPassport as $passport) {
                    $duplicate = Order::where('type', $newType)
                        ->where('id', '!=', $id) // Exclude the current order
                        ->whereRaw("FIND_IN_SET(?, passport_no)", [$passport]) // Check in the comma-separated list
                        ->exists();

                    if ($duplicate) {
                        return redirect()->route('order.view')->with('error', 'An order with the same type and passport number already exists.');
                    }
                }
            }

            // Update the order
            $who = $request->input('supplier');
            $parts = explode('_', $who);

            if(count($parts) < 2){
                $type = 'supplier';
                $who_id = $parts[0];
            }
            else{
                $type = $parts[0]; // "supplier"
                $who_id = $parts[1]; // "81"
        
            }
            // dd($type, $who_id);           // Debug and check the input and its parts count

        
            $order->name = $request->input('name');
            $order->date = (new DateTime($request->input('date')))->format('Y-m-d');
            $order->type = $newType;
            $order->agent = $request->input('agent');
            $order->passport_no = implode(',', $newPassport); // Store as a comma-separated string
            $order->contact_amount = $request->input('contact_amount');
            $order->payable_amount = $request->input('payable_amount');
            $order->country = $request->input('country');

            if ($type == 'supplier') {
                $order->supplier = $who_id;
            }
            else{
                $order->supplier = null;

            }

            $order->who = $request->input('supplier');
            $order->remark = $request->input('remark');
            $order->invoice = $request->input('invoice');

            if ($request->has('other_expense')) {
                $profit = $request->input('contact_amount') - ($request->input('payable_amount') + $request->input('other_expense'));
            } else {
                $profit = $request->input('contact_amount') - $request->input('payable_amount');
            }

            $order->profit = $profit;
            $order->user = Auth::id();

            if ($order->save()) {
                return redirect()->route('order.view')->with('success', 'Order updated successfully');
            } else {
                return redirect()->route('order.view')->with('error', 'Order update failed');
            }
        } else {
            return view('welcome');
        }
    }
        public function view($id){
            if(Auth::user()){
                $order = Order::findOrFail($id); 
                $agent = Agent::where('id', $order->agent)->first();
                $type = Type::where('id', $order->type)->value('name');
                return view('order.view', compact('order', 'agent','type'));
            }
            else{
                return view('welcome');
            }
          
        }
        public function delete($id)
        {
            if(Auth::user()){
                DB::beginTransaction();
            
                try {
                    // Fetch the order and check if it exists
                    $order = Order::findOrFail($id);
                    $order->is_delete = 1; // Soft delete (or change this based on your deletion logic)
                
                    // Update the agent's amount
                    $agent = Agent::find($order->agent);
                    if ($agent) {
                        $agent->amount -= $order->contact_amount;
                        $agent->save();
                    }
                
                    // Update the supplier's amount
                    $supplier = Supplier::find($order->supplier);
                    if ($supplier) {
                        $supplier->amount -= $order->payable_amount;
                        $supplier->save();
                    }
                
                    // Save the order after marking it as deleted
                    if ($order->save()) {
                        DB::commit(); // Commit the transaction
                        return redirect()->route('order.view')->with('success', "Order #{$order->id} deleted successfully");
                    } else {
                        DB::rollBack(); // Rollback the transaction if saving the order fails
                        return redirect()->route('order.view')->with('error', 'Order deletion failed');
                    }
                } catch (\Exception $e) {
                    DB::rollBack(); // Rollback the transaction in case of any exception
                    return redirect()->route('order.view')->with('error', 'Order deletion failed: ' . $e->getMessage());
                }
            } else {
                return view('welcome');
            }
        }

}

?>