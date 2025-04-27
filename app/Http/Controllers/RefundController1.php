<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Supplier;
use App\Models\Agent;
use App\Models\Type;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\Refund;
use App\Models\Payment; 
use App\Models\Receiver;
use Illuminate\View\View;
use DateTime;
use Illuminate\Support\Facades\DB;

class RefundController extends Controller
{
   
    public function entry(Request $request){
        if(Auth::user()){
            try {
                DB::beginTransaction();
                $user = Auth::id();
                $refund = new Refund();
               
                $refund->ticket_no = $request->ticket;
                $refund->date = $request->refund_date;
                $refund->user = $user;
        
                $refund->agent = $request->agent;
                $refund->supplier = $request->supplier;
                $refund->passenger_name = $request->name;
        
                $refund->prev_agent_amount = $request->agent_fare;
                $refund->prev_supply_amount = $request->supplier_fare;
        
                $refund->now_agent_fere = $request->agent_refundfare;
                $refund->now_supplier_fare = $request->supplier_refundfare;
        
                $agentRefundFare = $request->input('agent_refundfare');
                $supplierRefundFare = $request->input('supplier_refundfare');
                $profit = $supplierRefundFare - $agentRefundFare;
        
                $refund->refund_profit = $profit;
            
                $ticket = Ticket::where(['ticket_no' => $request->ticket])->first();
                $ticket->is_refund = 1;
                $ticket->refund_profit = $profit;
            
                $agent = Agent::where('id', $request->agent)->first();
                $agent->amount -= $request->agent_fare;
                $agent->amount += $request->agent_refundfare;
                $current_agent_amount = $agent->amount;
            
                $supplier = Supplier::where('id', $request->supplier)->first();
                $supplier->amount -= $request->supplier_fare;
                $supplier->amount += $request->supplier_refundfare;
                $current_supplier_amount = $supplier->amount;
    
                $refund->current_agent_amount = $current_agent_amount;
                $refund->current_supplier_amount = $current_supplier_amount;
                $flag = $ticket->save() && $refund->save() && $supplier->save() && $agent->save();
            
                if ($flag) {
                    DB::commit();
                    return redirect()->route('refund_ticket')->with('success', 'Refund Ticket Added successfully');
                } else {
                    DB::rollBack();
                    return redirect()->route('refund_ticket')->with('error', 'Adding Refund Ticket failed');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                
                return redirect()->route('refund_ticket')->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }
        else{
            return view('welcome');
        }
       
    } 
}