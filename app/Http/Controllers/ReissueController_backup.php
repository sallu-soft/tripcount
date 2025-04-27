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
use App\Models\ReissueTicket;
use Illuminate\View\View;
use DateTime;
use Illuminate\Support\Facades\DB;

class ReissueController extends Controller
{
    public function view(Request $request)
    {
        $user = Auth::id();
       
        $query = ReissueTicket::where([['user',$user]]);

        // Add search functionality
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('ticket_no', 'like', '%' . $searchTerm . '%')
                      ->orWhere('date', 'like', '%' . $searchTerm . '%');
            });
        }

        $reissue_tickets = $query->paginate(10);
        
        return view('ticket.reissue', compact('reissue_tickets'));
    }
    public function reissue_entry(Request $request)
    {
        try {
            DB::beginTransaction();

            $flag = $this->reissueTicket($request);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error or handle it as needed
            return redirect()->back()->with('error', 'Error voiding ticket: ' . $e->getMessage());
        }

        $message = $flag ? 'Reissue Ticket added successfully' : 'Adding Reissue Ticket failed';
        $type = $flag ? 'success' : 'error';

        return redirect()->route('reissue.view')->with($type, $message);
    }

    private function reissueTicket(Request $request)
    {
        $ticket = Ticket::where('ticket_no', $request->ticket)->first();

        if (!$ticket) {
            return false; // Ticket not found
        }
        // dd($request->all());
        $reissueticket = new ReissueTicket();
        $reissueticket->ticket_no = $request->ticket;
        $reissueticket->ticket_code = $request->ticket_code;
        $reissueticket->passenger_name = $request->name;
        $reissueticket->date = $request->reissue_date;
        $reissueticket->agent = $request->agent;
        $reissueticket->supplier = $request->supplier;
        $reissueticket->prev_agent_amount = $request->agent_fare;
        $reissueticket->prev_supply_amount = $request->supplier_fare;
        $reissueticket->now_agent_fere = $request->agent_reissuefare;
        $reissueticket->now_supplier_fare = $request->supplier_reissuefare;
        $reissueticket->user = Auth::id();

        $agentReissueFare = $request->input('agent_reissuefare');
        $supplierReissueFare = $request->input('supplier_reissuefare');
        $profit = $agentReissueFare - $supplierReissueFare;

        $reissueticket->reissue_profit = $profit;

     
        $ticketParams = [
            'reissueTicket' => $reissueticket,
            'ticket' => $ticket,
            'agentFare' => $request->agent_fare,
            'supplierFare' => $request->supplier_fare,
            'agentId' => $request->agent,
            'supplierId' => $request->supplier,
            'profit' => $profit,
            'agentReissueFare' => $request->agent_reissuefare,
            'supplierReissueFare' => $request->supplier_reissuefare,
        ];
        
        $flag = $this->updateTicket($ticketParams);
        
        return $flag;
    }

    private function updateTicket(array $params)
    {
        $reissueticket = $params['reissueTicket'];
        $ticket = $params['ticket'];
        $agentFare = $params['agentFare'];
        $supplierFare = $params['supplierFare'];
        $agent = $params['agentId'];
        $supplier = $params['supplierId'];
        $profit = $params['profit'];
        $agentReissueFare = $params['agentReissueFare'];
        $supplierReissueFare = $params['supplierReissueFare'];

        $reissueticket->save();
        // Your existing logic for updating ticket, agent, and supplier
        $ticket->is_void = 1;
        $ticket->void_profit = $profit;

        $agent = Agent::where('id', $agent)->first();
        // $agent->amount -= $agentFare;
        $agent->amount += $agentReissueFare;

        $supplier = Supplier::where('id', $supplier)->first();
        // $supplier->amount -= $supplierFare;
        $supplier->amount += $supplierReissueFare;

        return $ticket->save() && $agent->save() && $supplier->save();
    }

}


