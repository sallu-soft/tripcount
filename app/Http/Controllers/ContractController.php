<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Supplier;
use App\Models\Agent;
use App\Models\Type;
use App\Models\Contract;
use App\Models\ContractService;
use App\Models\ExtraTypes;
use Illuminate\View\View;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class ContractController extends Controller
{
    //
    public function index_new(){
        if(Auth::user()){
            $user = Auth::id();
            $suppliers = Supplier::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $agents = Agent::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $types = Type::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            $contracts = DB::table('contracts')
            ->leftJoin('agent', 'contracts.agent', '=', 'agent.id')
            ->where('contracts.user', $user)
            ->select(
                'contracts.*',
                'agent.name as agent_name'
            )
            ->get();
             
            return view('contract/index_new', compact('suppliers', 'agents', 'types', 'contracts'));
        }
        else{
            return view('welcome');
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $contract = new Contract();
            $contract->agent = $request->agent_id; // or agent_id
            $contract->total_amount = $request->total_amount;
            $contract->contract_date = $request->contract_date;
            $contract->invoice = $request->invoice;
            $contract->passport_no = $request->passport_no;
            $contract->name = $request->name;
            $contract->country = $request->country;
            $contract->notes = $request->notes;
            $contract->user = Auth::id(); // or user_id
            $contract->save();

            return redirect()->route('order.view')
                            ->with('success', 'Contract created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function update(Request $request)
    {
        // dd($request->all());
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to continue');
        }

        $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'service_amounts' => 'sometimes|array',
            'service_amounts.*' => 'nullable|numeric|min:0',
            'service_suppliers' => 'sometimes|array',
            'service_suppliers.*' => 'nullable|string',
            'service_dates' => 'sometimes|array',
            'service_dates.*' => 'nullable|date',
            'service_notes' => 'sometimes|array',
            'service_notes.*' => 'nullable|string|max:500'
        ]);

        try {
            DB::beginTransaction();

            $contractId = $request->input('contract_id');
            $userId = Auth::id();
            // dd(count($request['extra_types']));
            if (isset($request['extra_types']) && count($request['extra_types']) !== 0) {
                // Update contract's extra_service status
                 $contract = Contract::find($contractId); // Use find() instead of where()->get() for single record
                 $contract->extra_service = 1;
                 $contract->save();
             
                 foreach ($request['extra_types'] as $extraType) {
                    // Check if record already exists
                    $existingRecord = ExtraTypes::where([
                        'contract_service_id' => $contractId,
                        'user' => $userId,
                        'extratype' => $extraType
                    ])->first();
                
                    // Update or create new record
                    $extraTypeService = $existingRecord ?? new ExtraTypes();
                    $extraTypeService->fill([
                        'contract_service_id' => $contractId,
                        'user' => $userId,
                        'extratype' => $extraType,
                        'note' => $request["{$extraType}_note"] ?? null
                    ]);
                
                    // Process type-specific fields
                    if ($extraType === 'wakala') {
                        $this->processWakala($request, $extraTypeService);
                    } elseif ($extraType === 'ticket') {
                        $this->processTicket($request, $extraTypeService);
                    }
                
                    $extraTypeService->save();
                }
            }
            else{
            }
            foreach ($request->input('service_suppliers', []) as $serviceTypeId => $agentSupplierString) {
                // Skip if no amount is provided for this service
                if (empty($request->input("service_amounts.{$serviceTypeId}"))) {
                    continue;
                }
            
                // Ensure agentSupplierString is valid
                if (empty($agentSupplierString) || !str_contains($agentSupplierString, '_')) {
                    continue; // or handle the error appropriately
                }
            
                // Parse agent/supplier string (format: "agent_81" or "supplier_74")
                $parts = explode('_', $agentSupplierString);
                $type = $parts[0] ?? null;
                $id = $parts[1] ?? null;
                
                // Validate the parsed values
                if (empty($type) || empty($id)) {
                    continue; // skip invalid entries
                }
            
                // Prepare data for update/creation
                $serviceData = [
                    'allocated_amount' => $request->input("service_amounts.{$serviceTypeId}"),
                    'agent_or_supplier' => $type,
                    'supplier' => $id,
                    'date' => $request->input("service_dates.{$serviceTypeId}"),
                    'note' => $request->input("service_notes.{$serviceTypeId}"),
                ];
                
                
                $contractService = ContractService::where([
                    'contract_id' => $contractId,
                    'user' => $userId,
                    'service_type' => $serviceTypeId
                ])->first();
                
                if ($contractService) {
                    // Update existing record
                    $contractService->allocated_amount = $serviceData['allocated_amount'];
                    $contractService->agent_or_supplier = $serviceData['agent_or_supplier'];
                    $contractService->supplier = $serviceData['supplier'];
                    $contractService->date = $serviceData['date'];
                    $contractService->note = $serviceData['note'];
                    $contractService->save();
                } else {
                    // Create new record
                    $contractService = new ContractService();
                    $contractService->contract_id = $contractId;
                    $contractService->user = $userId;
                    $contractService->service_type = $serviceTypeId;
                    $contractService->allocated_amount = $serviceData['allocated_amount'];
                    $contractService->agent_or_supplier = $serviceData['agent_or_supplier'];
                    $contractService->supplier = $serviceData['supplier'];
                    $contractService->date = $serviceData['date'];
                    $contractService->note = $serviceData['note'];
                    // dd($contractService);
                    $contractService->save();
                }
            }
            DB::commit();

            return back()->with('success', 'Contract services updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update contract services. Please try again.'. $e->getMessage());
        }
    }


    protected function processWakala($request, &$extraTypeService) {
        $parts = explode('_', $request['wakala_supplier']);
        if (count($parts) == 2) {
            $extraTypeService->agent_supplier = $parts[0];
            $extraTypeService->supplier = $parts[1];
        }
        $extraTypeService->wakala_date = $request['wakala_date'];
        $extraTypeService->amount = $request['wakala_total_price'];
        $extraTypeService->wakala_visa_no = $request['wakala_visa_no'];
        $extraTypeService->wakala_id_no = $request['wakala_id_no'];
        $extraTypeService->wakala_buying_price = $request['wakala_buying_price'];
        $extraTypeService->wakala_multi_currency = $request['wakala_multi_currency'];
        $extraTypeService->wakala_sales_by = $request['wakala_sales_by'];
    }

    protected function processTicket($request, &$extraTypeService) {
        $parts = explode('_', $request['ticket_supplier']);
        if (count($parts) == 2) {
            $extraTypeService->agent_supplier = $parts[0];
            $extraTypeService->supplier = $parts[1];
        }
    
        $extraTypeService->amount = $request['ticket_selling_price'];
        $extraTypeService->ticket_invoice_date = $request['ticket_invoice_date'];
        $extraTypeService->ticket_travel_date = $request['ticket_travel_date'];
        $extraTypeService->ticket_sector = $request['ticket_sector'];
        $extraTypeService->ticket_number = $request['ticket_number'];
        $extraTypeService->ticket_passenger_name = $request['ticket_passenger_name'];
        $extraTypeService->ticket_airline = $request['ticket_airline'];
    }



    public function searchcontractservice($id)
    {
        // Get main services
        $services = DB::table('contract_services')
            ->where('contract_id', $id)
            ->where('contract_services.user', Auth::id())
            ->join('type', 'contract_services.service_type', '=', 'type.id')
            ->select(
                'service_type',
                'agent_or_supplier',
                'supplier',
                'allocated_amount',
                'type.name as service_name',
                'date',
                'note'
            )
            ->get()
            ->groupBy('service_type');

        // Get extra services if available
        $extraServiceAvailable = Contract::where('id', $id)->value('extra_service');
        $extraServices = null;
        $extraServiceTypes = null;

        if ($extraServiceAvailable == 1) {
            $extraServices = ExtraTypes::where('contract_service_id', $id)
                ->where('user', Auth::id())
                ->get();

            $extraServiceTypes = $extraServices->pluck('extratype')->unique()->values()->toArray();
        }

        // Format main services with supplier names
        $formatted = [];
        foreach ($services as $service_type => $items) {
            $formatted[$service_type] = $items->map(function ($item) {
                $supplierName = ($item->agent_or_supplier === 'agent')
                    ? Agent::where('id', $item->supplier)->value('name')
                    : Supplier::where('id', $item->supplier)->value('name');

                return [
                    'agent_or_supplier' => $item->agent_or_supplier,
                    'supplier' => $item->supplier,
                    'allocated_amount' => $item->allocated_amount,
                    'service_name' => $item->service_name,
                    'supplier_name' => $supplierName,
                    'date' => $item->date,
                    'note' => $item->note,
                ];
            })->values();
        }

        // Return properly formatted JSON response
        return response()->json([
            'services' => $formatted,
            'extraServiceTypes' => $extraServiceTypes,
            'extraServices' => $extraServices
        ]);
    }
}
