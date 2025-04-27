<x-app-layout>
    <style type="text/css">
        .select2-selection--single{
            height:32px !important;
        }
    </style>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('employee'))
    @php
        $employee = session('employee');
        // dd($employee['permission']);
        $permissionString = $employee['permission'];
        $permissionsArray = explode(',', $permissionString);
        $role = $employee['role'];
        // dd($role, $employee);
    @endphp
    @else
        @php
            $permissionsArray = ['entry', 'edit', 'delete', 'print', 'view'];
            $role = 'admin';
        @endphp
    @endif

    <h2 class="text-2xl py-4 flex xl:w-3/4 lg:w-4/4 w-full  font-bold
    px-2  text-gray-900">
        Ticket Invoicing
    </h2>
    <div class="text-md flex xl:w-3/4 lg:w-4/4 w-full 
    px-2  text-gray-900">
    <div class="form-check form-check-inline">
        <input class="form-check-input hidden" type="radio" name="ticket_invoice_type" id="single_ticket" value="single_ticket">
        <label class="form-check-label py-1 px-4 border-green-700 hover:bg-green-700 hover:text-white duration-300 border-2 text-green-700  rounded-2xl font-bold " for="single_ticket">Single Ticket</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input hidden" type="radio" name="ticket_invoice_type" id="multiple_ticket" value="multiple_ticket">
        <label class="form-check-label py-1 px-4 border-green-700 hover:bg-green-700 hover:text-white duration-300 border-2 text-green-700  rounded-2xl font-bold " for="multiple_ticket">Multiple Ticket</label>
      </div>
      
    </div>
   
    <div id="container" class="border-t bg-white border-gray-2  flex-col justify-center items-center rounded-lg flex shadow-md xl:w-3/4 lg:w-4/4 w-full mx-auto my-2">
        @if(in_array('entry', $permissionsArray))
        <form class="w-full p-6" id="ticket_form">
                @csrf
                <div class="grid grid-cols-2 w-full gap-3">
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="invoice_no" class="block w-[50%]">Invoice No.</label>
                        <input type="text" id="invoice_no"
                            class="text-center text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            name="invoice_no" readonly>
                    </div>
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="agent_name" class="block w-[50%]">Agent
                            Name</label>

                        <select name="agent" id="agent_multiple" class="select2 bg-white w-[80%] border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block p-1" required>
                            <option value="">Select Agent</option>
                            @foreach ($agents as $agent)
                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>

                    </div>

                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="invoice_date" class="block w-[50%]">Invoice
                            Date</label>
                        <input type="date" id="invoice_date"
                            class=" bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1" required
                            name="invoice_date" value="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="flight_date" class="w-[50%]">Flight Date</label>
                        <div class="w-full flex gap-x-2">
                            <input type="date" id="flight_date" class="bg-white md:w-[90%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1" name="flight_date" required>
                            <button id="toggle_return_section" class="bg-[#00959E] font-bold w-[8%] text-white text-xl rounded-xl flex justify-center items-center p-1">+</button>
                        </div>
                    </div>
                    
                
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="airline" class="w-[50%]">Airline</label>
                        <div class="flex w-full gap-x-3">
                            {{-- <input type="text" id="airlines_name"
                                class="bg-white w-[73%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                                name="airlines_name"> --}}
                                <select id="airlines_name" class="select2 bg-white w-[73%] border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block p-1" name="airlines_name" required>
                                    <option>Select Airline</option>
                                    @foreach ($airlines as $airline)
                                        <option value="{{ $airline->Full}}">{{ $airline->Full }}</option>
                                    @endforeach
                                </select>
                                
                            <input type="text" id="airlines_code"
                                class="bg-white w-[23%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1" required
                                name="airlines_code">
                        </div>
                    </div>
                    <div class="" id="return_section" >
                    <div class="w-full px-4 mb-2 flex items-center" style="display:none">
                        <label for="return_date" class="w-[50%]">Return Date</label>
                        <input type="date" id="return_date" class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1" name="return_date">
                    </div>
                    </div>
                    
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="ticket_no" class="w-[50%]">Ticket No /
                            PNR</label>
                        <div class="flex w-full gap-x-4">
                            <input type="text" id="ticket_code"
                                class="bg-white w-[23%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                                name="ticket_code" required>
                            <input type="text" id="ticket_no" maxlength="10" minlength="10"
                                class="bg-white w-[73%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                                name="ticket_no" required>
                        </div>
                    </div>
                
                
                    
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="number_of_tickets" class="w-[50%]">Number of
                            Tickets</label>
                        <input type="number" id="number_of_tickets"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="number_of_tickets">
                    </div>
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="pnr" class="w-[50%]">PNR</label>
                        <input type="text" id="pnr"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="pnr" required>
                    </div>
                    
                
                
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="passenger_name" class="w-[50%]">Passenger
                            Name</label>
                        <input type="text" id="passenger_name"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="passenger_name" required>
                    </div>
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="person" class="w-[50%]">Person</label>
                        <select id="person" class=" bg-white w-full border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block p-1" name="person">
                                <option value="adult">Adult</option>
                                <option value="child">Child</option>
                                <option value="infant">Infant</option>
                                
                        </select>
                    </div>
                    
                    
                
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="class" class="w-[50%]">Class</label>
                        <div class="flex w-full gap-x-4">
                            <input type="text" id="class_code"
                                    class="bg-white w-[23%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                                    name="class_code">
                            <select id="class" class=" bg-white w-[73%] border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block p-1" name="class">
                                    <option value="economy">Economy</option>
                                    <option value="business">Business</option>
                                    
                            </select>
                        </div>
                    </div>
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="sector" class="w-[50%]">Sector</label>
                        <input type="text" id="sector"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="sector" required>
                    </div>
                    
                    
                    
                    
                
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="flight_no" class="w-[50%]">Flight No</label>
                        <input type="text" id="flight_no"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="flight_no" required>
                    </div>
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="supplier" class="w-[50%]">Supplier</label>

                        <select name="supplier" id="supplier_multiple"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block max-w-full select2 p-1" required>
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }} {{$supplier->company}}</option>
                            @endforeach
                            @foreach ($agents as $agent)
                                <option value="agent_{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="agent_price" class="w-[50%]">Agent
                            Price</label>
                        <input type="text" id="agent_price_1"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="agent_price" required>
                    </div>

                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="supplier_price" class="w-[50%]">Supplier
                            Price</label>
                        <div class="w-full flex gap-x-2">
                        <input type="text" id="supplier_price"
                            class="bg-white border border-gray-300 md:w-[82%] text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="supplier_price" required>
                            <button id="group_ait" class="bg-[#00959E] font-bold w-[16%] text-white text-sm rounded-xl flex justify-center items-center p-1"><span class="text-lg">+</span> AIT</button>
                        </div>
                    </div>
                
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="stuff" class="w-[50%]">Stuff</label>
                        <input type="text" id="stuff"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="stuff" required>
                    </div>
                    
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="remark" class="w-[50%]">Remark</label>
                        <textarea id="remark"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="remark"></textarea>
                    </div>

                
                </div>
                <div class=" flex-wrap gap-x-10 -mx-4 mb-4 hidden">
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="discount" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">AIT</label>
                        <input type="text" id="aitticket"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="ait">
                    </div>
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="remark" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">AIT
                            Amount</label>
                        <input type="text" id="aitticket_amount"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="ait_amount">
                    </div>

                </div>
                

            
            <div class="flex justify-center my-4 gap-x-8">
                <div class="font-semibold">
                    <input type="checkbox" id="addGDS" name="addGDS" onchange="toggleGdsVisibility()" />
                    <label for="addGDS" class="text-[#00959E] font-bold">Add GDS</label>
                </div>
            </div>


            <div class="my-4 w-full" id="gds">
                <div class="flex flex-wrap gap-x-2 md:gap-x-6 mb-4">
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="fare" class="block w-full md:w-[50%] text-gray-700 text-sm mb-2">Fare</label>
                        <input type="text" id="fare"
                            class=" text-gray-900 text-sm bg-white border border-gray-300 focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="fare">
                    </div>
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="commission"
                            class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">Commission</label>
                        <div class="w-full flex gap-2">
                            <input type="text" id="commission"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-[83%] p-1"
                            name="commission">
                            <input type="number" id="commissionPercentage"
                                class="bg-white text-center border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-[15%] p-1" value="7"
                                >%
                        
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-x-6 mb-4">
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="tax" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">TAX</label>
                        <input type="text" id="tax"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="tax">
                    </div>
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="ait_amount" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">AIT
                            Amount</label>
                        <input type="text" id="ait_amount"
                            class=" border bg-white border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="ait_amount" readonly placeholder="3830">
                    </div>
                </div>
                <div class="flex flex-wrap gap-x-6 mb-4">
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="ait" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">AIT</label>
                        <div class="w-full flex gap-2">
                            <input type="text" id="ait"
                                class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-[83%] p-1"
                                name="ait">
                            <p id="aitPercent"
                                class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1 md:w-[15%] text-center"
                                >0.3%</p>
                        </div>
                    </div>
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="service_charge" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">Service
                            Charge</label>
                        <input type="text" id="service_charge"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="service_charge">
                    </div>
                </div>
                <div class="flex flex-wrap gap-x-6 mb-4">
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="agent_price" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">Agent
                            Price</label>
                        <input type="text" id="agent_price"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="agent_price_gds">
                    </div>
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="gds_payment" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">GDS
                            Payment</label>
                        <input type="text" id="gds_payment"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="gds_payment">
                    </div>
                </div>
            </div>

            <div class=" w-full my-2 rounded-lg p-2 font-bold" id="profit_show">
                Net Profit - 00
            </div>

            <div class="col-span-2 flex justify-end">
                <button type="submit" id="add_ticket"
                    class="bg-black text-xl hover:bg-blue-700 mr-5 text-white font-bold py-2 px-16 rounded">Submit</button>
            </div>

        </form>
        @else
        <div class="alert alert-warning">
            Don't have permission to entry
        </div>
    @endif
    @if(in_array('entry', $permissionsArray))
        <form class="w-full p-6" id="ticket_form_single" action="{{ route('addsingleticket.store') }}" method="POST">
            @csrf
                <div class="grid grid-cols-2 w-full gap-3">
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="invoice_no" class="block w-[50%]">Invoice No.</label>
                        <input type="text" id="invoice_no_single"
                            class="text-center text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            name="invoice_no" readonly>
                    </div>
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="agent_name" class="block w-[50%]">Agent
                            Name</label>

                        <select name="agent" id="agent"
                            class="bg-gray-50 border select2 border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block max-w-[60%] p-1">
                            <option value="">Select Agent</option>
                            @foreach ($agents as $agent)
                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>

                    </div>

                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="invoice_date" class="block w-[50%]">Invoice
                            Date</label>
                        <input type="date" id="invoice_date"
                            class=" bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="invoice_date" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="flight_date" class="w-[50%]">Flight Date</label>
                        <div class="w-full flex gap-x-2">
                            <input type="date" id="flight_date" class="bg-white md:w-[90%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1" name="flight_date">
                            <button id="toggle_return_section_single" class="bg-[#00959E] font-bold w-[8%] text-white text-xl rounded-xl flex justify-center items-center p-1">+</button>
                        </div>
                    </div>
                    
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="airline" class="w-[50%]">Airline</label>
                        <div class="flex w-full gap-x-3">
                            
                                <select id="airlines_name_single" class="select2 bg-white w-[73%] border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block p-1" name="airlines_name">
                                    <option>Select Airline</option>
                                    @foreach ($airlines as $airline)
                                        <option value="{{ $airline->Full}}">{{ $airline->Full }}</option>
                                    @endforeach
                                </select>
                                
                            <input type="text" id="airlines_code_single"
                                class="bg-white w-[23%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                                name="airlines_code">
                        </div>
                    </div>
                    <div class="" id="return_section_single" >
                        <div class="w-full px-4 mb-2 flex items-center">
                            <label for="return_date" class="w-[50%]">Return Date</label>
                            <input type="date" id="return_date" class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1" name="return_date">
                        </div>
                    </div>
                    
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="ticket_no" class="w-[50%]">Ticket No /
                            PNR</label>
                        <div class="flex w-full gap-x-4">
                            <input type="text" id="ticket_code_single"
                                class="bg-white w-[23%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                                name="ticket_code">
                            <input type="text" id="ticket_no_single" maxlength="10" minlength="10"
                                class="bg-white w-[73%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                                name="ticket_no">
                        </div>
                    </div>
                
                   
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="pnr" class="w-[50%]">PNR</label>
                        <input type="text" id="pnr"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="pnr">
                    </div>
                    
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="passenger_name" class="w-[50%]">Passenger
                            Name</label>
                        <input type="text" id="passenger_name"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="passenger_name">
                    </div>
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="person" class="w-[50%]">Person</label>
                        <select id="person" class=" bg-white w-full border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block p-1" name="person">
                                <option value="adult">Adult</option>
                                <option value="child">Child</option>
                                <option value="infant">Infant</option>
                                
                        </select>
                    </div>
                    
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="class" class="w-[50%]">Class</label>
                        <div class="flex w-full gap-x-4">
                            <input type="text" id="class_code"
                                    class="bg-white w-[23%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                                    name="class_code">
                            <select id="class" class=" bg-white w-[73%] border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block p-1" name="class">
                                    <option value="economy">Economy</option>
                                    <option value="business">Business</option>
                                    
                            </select>
                        </div>
                    </div>

                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="sector" class="w-[50%]">Sector</label>
                        <input type="text" id="sector_single"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="sector">
                    </div>
                    
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="flight_no" class="w-[50%]">Flight No</label>
                        <input type="text" id="flight_no_single"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="flight_no">
                    </div>
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="supplier" class="w-[50%]">Supplier</label>

                        <select name="supplier" id="supplier"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block max-w-full select2 p-1">
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }} {{$supplier->company}}</option>
                            @endforeach
                            @foreach ($agents as $agent)
                                <option value="agent_{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="stuff" class="w-[50%]">Stuff</label>
                        <input type="text" id="stuff"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="stuff">
                    </div>
                
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="agent_price" class="w-[50%]">Agent
                            Price</label>
                        <input type="text" id="agent_price_single"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="agent_price">
                    </div>

                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="supplier_price" class="w-[50%]">Supplier
                            Price</label>
                        <div class="w-full flex gap-x-2">
                        <input type="text" id="supplier_price_single"
                            class="bg-white border border-gray-300 md:w-[82%] text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="supplier_price">
                            <button id="group_ait_single" class="bg-[#00959E] font-bold w-[16%] text-white text-sm rounded-xl flex justify-center items-center p-1"><span class="text-lg">+</span> AIT</button>
                        </div>
                    </div>
                
                
                   
                    
                    <div class="w-full px-4 mb-2 flex items-center">
                        <label for="remark" class="w-[50%]">Remark</label>
                        <textarea id="remark"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="remark"></textarea>
                    </div>

                
                </div>

                <div class=" flex-wrap gap-x-10 -mx-4 mb-4 hidden">
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="discount" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">AIT</label>
                        <input type="text" id="aitticket_single"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="ait">
                    </div>
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="remark" class="block w-full md:w-[40%]  text-gray-700 text-sm mb-2">AIT
                            Amount</label>
                        <input type="text" id="aitticket_amount_single"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="ait_amount">
                    </div>

                </div>

                <div class="flex justify-center my-4 gap-x-8">
                    <div class="font-semibold">
                        <input type="checkbox" id="addGDS_single" name="addGDS_single" onchange="toggleGdsVisibility_single()" />
                        <label for="addGDS_single" class="text-[#00959E] font-bold">Add GDS</label>
                    </div>
                </div>
                

            
            <div class="my-4 w-full" id="gds_single">
                <div class="flex flex-wrap gap-x-2 md:gap-x-6 mb-4">
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="fare_single" class="block w-full md:w-[50%] text-gray-700 text-sm mb-2">Fare</label>
                        <input type="text" id="fare_single"
                            class=" text-gray-900 text-sm bg-white border border-gray-300 focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="fare_single">
                    </div>
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="commission_single"
                            class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">Commission</label>
                        <div class="w-full flex gap-2">
                            <input type="text" id="commission_single"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-[83%] p-1"
                            name="commission_single">
                            <input type="number" id="commission_singlePercentage"
                                class="bg-white text-center border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-[15%] p-1" value="7"
                                >%
                        
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-x-6 mb-4">
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="tax_single" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">TAX</label>
                        <input type="text" id="tax_single"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="tax_single">
                    </div>
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="ait_amount_single" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">AIT
                            Amount</label>
                        <input type="text" id="ait_amount_single"
                            class=" border bg-white border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="ait_amount_single" readonly placeholder="3830">
                    </div>
                </div>
                <div class="flex flex-wrap gap-x-6 mb-4">
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="ait_single" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">AIT</label>
                        <div class="w-full flex gap-2">
                            <input type="text" id="ait_single"
                                class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-[83%] p-1"
                                name="ait_single">
                            <p id="ait_singlePercent"
                                class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1 md:w-[15%] text-center"
                                >0.3%</p>
                        </div>
                    </div>
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="service_charge_single" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">Service
                            Charge</label>
                        <input type="text" id="service_charge_single"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="service_charge_single">
                    </div>
                </div>

                <div class="flex flex-wrap gap-x-6 mb-4">
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="agent_price_gds" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">Agent
                            Price</label>
                        <input type="text" id="agent_price_gds"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="agent_price_gds">
                    </div>
                    <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                        <label for="gds_payment_single" class="block w-full md:w-[50%]  text-gray-700 text-sm mb-2">GDS
                            Payment</label>
                        <input type="text" id="gds_payment_single"
                            class="bg-white border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                            name="gds_payment_single">
                    </div>
                </div>
            </div>


            <div class=" w-full my-2 rounded-lg p-2 font-bold" id="profit_show">
                Net Profit - 00
            </div>

          

            <div class="col-span-2 flex justify-end">
                <button type="submit" id="add_ticket"
                    class="bg-black text-xl hover:bg-blue-700 mr-5 text-white font-bold py-2 px-16 rounded">Submit</button>
            </div>

        
        </form>
        @else
        <div class="alert alert-warning">
            Don't have permission to entry
        </div>
    @endif
    </div>


    
    <table class="table-fixed mx-4 border rounded-lg overflow-hidden table bg-white table-hover"
        id="ticket_table">
        <thead class="">
            <tr class="border-b bg-[#7CB0B2]">
                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Invoice Date</th>
                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Invoice</th>
                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Ticket No</th>
                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Passenger</th>
                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Flight Date</th>

                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Airline</th>
                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Agent</th>

                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Supplier</th>
                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Agent Price</th>

                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Supplier Price</th>
                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Remark</th>
                <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($tickets as $ticket)
                @php
                    $suppliername = '';
            
                    if ($ticket->who !== null) {
                        if (strpos($ticket->who, 'agent_') === 0) {
                            $who_id = str_replace('agent_', '', $ticket->who);
                            $suppliername = $agentsID[$who_id] ?? 'Unknown Agent';
                        } else {
                            // dd( $ticket);
                            $suppliername = $suppliersID[$ticket->supplier] ?? 'Unknown Supplier';
                        }
                    } else {
                        $suppliername = $suppliersID[$ticket->supplier] ?? 'Unknown Supplier';
                    }
                @endphp
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-2 py-2 text-gray-700">{{ (new DateTime($ticket->invoice_date))->format('d/m/Y') }}
                    </td>
                    <td class="px-2 py-2 text-gray-700">{{ $ticket->invoice }}</td>
                    
                    <td class="px-2 py-2 text-gray-700">{{ $ticket->ticket_code }}-{{ $ticket->ticket_no }}</td>
                    <td class="px-2 py-2 text-gray-700">{{ $ticket->passenger }}</td>

                    <td class="px-2 py-2 text-gray-700">{{ (new DateTime($ticket->flight_date))->format('d/m/Y') }}
                    </td>
                    <td class="px-2 py-2 text-gray-700">{{ $ticket->airline_code }}-{{ $ticket->airline_name }}</td>
                    <td class="px-2 py-2 text-gray-700">{{ $agentsID[$ticket->agent] }}</td>

                    <td class="px-2 py-2 text-gray-700">{{ $suppliername }}<br></td>
                    <td class="px-2 py-2 text-center text-gray-700">{{ $ticket->agent_price }}</td>
                    <td class="px-2 py-2 text-center text-gray-700">{{ $ticket->supplier_price }}</td>


                    <td class="px-2 py-2 text-gray-700">{{ $ticket->remark }}</td>
                    <td class="px-2 py-2 text-gray-700 flex items-center justify-around">
                        @if(in_array('edit', $permissionsArray))
                        <a href="{{ route('ticket_edit', ['id' => $ticket->id]) }}"
                            class=" mr-1">
                            <i class="fa fa-pencil fa-fw text-xl"></i>
                        </a>
                        @endif
                        @if(in_array('view', $permissionsArray))
                        <a href="{{ route('ticket_view', ['id' => $ticket->id]) }}"
                            class=" mr-1">
                            <i class="fa fa-eye fa-fw text-xl"></i>
                        </a>
                        @endif
                        @if(in_array('delete', $permissionsArray))
                        <a href="#" onclick="confirmDelete('{{ route('ticket.delete', ['id' => $ticket->id]) }}')"
                          class=" mr-1">
                          <i class="fa fa-trash fa-fw text-xl"></i>
                       </a>
                       	@endif
                        {{-- <a href="{{ route('ticket_print', ['id' => $ticket->id]) }}" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-print"></i> Print
                </a> --}}
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document" style="max-width: 1200px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="tableContainer"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        function confirmDelete(deleteUrl) {
            // Display a confirmation dialog
            const isConfirmed = window.confirm("Are you sure you want to delete?");

            // If the user confirms, proceed with the delete action
            if (isConfirmed) {
                window.location.href = deleteUrl;
            }
        }
            
        // var received_payment = document.getElementById('receive_payment');
        var gds = document.getElementById('gds');
        var gds_single = document.getElementById('gds_single');
        // var refunddiv = document.getElementById('refunddiv');
        
        
        gds.style.display = 'none';
        gds_single.style.display = 'none';
       

        function toggleGdsVisibility() {
            var gds = document.getElementById('gds');
            var gds_checkbox = document.getElementById('addGDS');
            gds.style.display = 'none';
            // Toggle the visibility of the received_payment based on checkbox state
            if (gds_checkbox.checked) {
                gds.style.display = 'block';
            } else {
                gds.style.display = 'none';
            }
        }
       

        function toggleGdsVisibility_single() {
            var gds_single = document.getElementById('gds_single');
            var gds_checkbox = document.getElementById('addGDS_single');
            gds_single.style.display = 'none';
            // Toggle the visibility of the received_payment based on checkbox state
            if (gds_checkbox.checked) {
                gds_single.style.display = 'block';
            } else {
                gds_single.style.display = 'none';
            }
        }

        
    </script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
          

            $('#ticket_form_single').hide();
            // $('#container').hide();
            $('#ticket_form').hide();
            $('input[name="ticket_invoice_type"]').on('change', function() {
                var selectedValue = $('input[name="ticket_invoice_type"]:checked').val();
               
                if (selectedValue === 'multiple_ticket') {
                    $('#ticket_form_single').hide();
                    $('#ticket_form').show();
                // Add your logic for multiple ticket selection
                } else if (selectedValue === 'single_ticket') {
                    $('#ticket_form_single').show();
                    $('#ticket_form').hide();
                }
            });

            
            $('.datepicker').datepicker({
                // autoclose: true
            });
            $('#ticket_table').DataTable();
           
            $('#return_section').hide();
            $('#toggle_return_section').click(function() {
                event.preventDefault();
                $('#return_section').toggle(); 
            });
            $('#return_section_single').toggle();
            $('#toggle_return_section_single').click(function() {
                event.preventDefault();
                $('#return_section_single').toggle(); 
            });
            // Flag variable to track if price has been changed

            var amountEntered = false; // Flag variable to track if an amount has been entered

            $('#supplier_price').on('input', function() {
                amountEntered = true; // Set the flag to true when an amount is entered
            });

            $('#group_ait').click(function(event) {
                event.preventDefault();
                if (amountEntered) { // Check if an amount has been entered
                    var supplier_price = parseFloat($('#supplier_price').val());
                    var percentage = supplier_price * 0.003;
                    supplier_price = (supplier_price + percentage);
                    $('#supplier_price').val(supplier_price);
                    $('#ait').val(percentage);
                    amountEntered = false; // Reset the flag after calculation
                }
            });
            
            $('#supplier_price_single').on('input', function() {
                amountEntered = true; // Set the flag to true when an amount is entered
            });

            $('#group_ait_single').click(function(event) {
                event.preventDefault();
                if (amountEntered) { // Check if an amount has been entered
                    var supplier_price = parseFloat($('#supplier_price_single').val());
                    var percentage = supplier_price * 0.003;
                    supplier_price = (supplier_price + percentage);
                    $('#supplier_price_single').val(supplier_price);
                    $('#ait_single').val(percentage);
                    amountEntered = false; // Reset the flag after calculation
                }
            });
           
            function generateRandomString() {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '/get-last-id', // Replace with the actual URL to fetch the last ID
                        method: 'GET',
                        success: function(response) {
                            let invoice = response.invoice;
                            
                            resolve(invoice);
                        },
                        error: function(error) {
                            console.error('Error fetching last ID:', error);
                            // Reject the promise with the error
                            reject(error);
                        }
                    });
                });
            }

            // Example usage:
            generateRandomString()
                .then(randomString => {
                    $('#invoice_no').val(randomString);
                    $('#invoice_no_single').val(randomString);
                    // Do something with the random string here
                })
                .catch(error => {
                    console.error('Failed to generate random string:', error);
            });


            
            $('#ticket_code').on('change', function() {
                var ticketCodeValue = $(this).val();

                // Make an AJAX call
                $.ajax({
                    url: '/search_airline', // Replace with the actual endpoint URL
                    method: 'POST', // Specify the HTTP method (POST, GET, etc.)
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        ticketCode: ticketCodeValue
                    }, // Data to be sent to the server
                    dataType: 'json', // Expected data type of the response
                    success: function(response) {
                        if (response.message == 'Success') {
                            $('#airlines_name').val(response.airline.Full).trigger('change');
                            $('#flight_no').val(response.airline.Short + "-");
                            $('#airlines_code').val(response.airline.Short);

                        
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        // Handle errors during the AJAX call
                        console.error('Error:', error);
                    }
                });
            });


            $('#ticket_code_single').on('change', function() {
                var ticketCodeValue = $(this).val();

                // Make an AJAX call
                $.ajax({
                    url: '/search_airline', // Replace with the actual endpoint URL
                    method: 'POST', // Specify the HTTP method (POST, GET, etc.)
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        ticketCode: ticketCodeValue
                    }, // Data to be sent to the server
                    dataType: 'json', // Expected data type of the response
                    success: function(response) {
                        if (response.message == 'Success') {
                          
                            $('#airlines_name_single').val(response.airline.Full).trigger('change');
                            $('#flight_no_single').val(response.airline.Short + "-");
                            $('#airlines_code_single').val(response.airline.Short);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        // Handle errors during the AJAX call
                        console.error('Error:', error);
                    }
                });
            });

            $('#airlines_name').on('change', function() {
                var airlinesname = $(this).val();
                
                $.ajax({
                    url: '/search_airline', // Replace with the actual endpoint URL
                    method: 'POST', // Specify the HTTP method (POST, GET, etc.)
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        ticketCode: airlinesname
                    }, // Data to be sent to the server
                    dataType: 'json', // Expected data type of the response
                    success: function(response) {
                        if (response.message == 'Success') {
                            $('#airlines_name').val(response.airline.Full);
                            $('#airlines_code').val(response.airline.Short);
                            $('#flight_no').val(response.airline.Short + "-");
                            $('#ticket_code').val(response.airline.ID);

                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        // Handle errors during the AJAX call
                        console.error('Error:', error);
                    }
                });
            });

            $('#airlines_name_single').on('change', function() {
                var airlinesname = $(this).val();
                
                $.ajax({
                    url: '/search_airline', // Replace with the actual endpoint URL
                    method: 'POST', // Specify the HTTP method (POST, GET, etc.)
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        ticketCode: airlinesname
                    }, // Data to be sent to the server
                    dataType: 'json', // Expected data type of the response
                    success: function(response) {
                        if (response.message == 'Success') {
                           
                            $('#airlines_name_single').val(response.airline.Full);
                            $('#airlines_code_single').val(response.airline.Short);
                            $('#flight_no_single').val(response.airline.Short + "-");
                            $('#ticket_code_single').val(response.airline.ID);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        // Handle errors during the AJAX call
                        console.error('Error:', error);
                    }
                });
            });

            // multiple ticket gds calculation start
                var fare, commission, tax, ait, gds, service_charge;
                var ait_amount = 3830;
                $('#fare').on('change', function() {
                    fare = parseFloat(this.value);
                    // console.log(fare);
                    if (!isNaN(fare)) {
                        var commissionPercentage = $('#commissionPercentage').val();
                        commission = (fare * commissionPercentage) / 100;
                        commission = Math.floor(commission);
                        // var afterCommission = fare - commission;

                        $('#commission').val(commission);
                        $('#commissionPercentage').on('change', function() {
                            var commissionPercentage = $('#commissionPercentage').val();
                        commission = (fare * commissionPercentage) / 100;
                        commission = Math.floor(commission);
                        // var afterCommission = fare - commission;

                        $('#commission').val(commission);
                        });


                    }
                });

                $('#tax').on('change', function() {
                    tax = this.value;
                    $('#ait_amount').val(ait_amount);
                    fare = parseFloat(fare);
                    tax = parseFloat(tax); // replace with the actual source of tax value
                    ait_amount = parseFloat(ait_amount); // replace with the actual source of ait_amount value

                    var total = fare + tax - ait_amount;
                    ait = parseFloat((total * 0.3) / 100);
                    ait = Math.floor(ait);
                    total = parseFloat(total);
                    var gds_payment = fare + tax + ait - commission;
                    gds = gds_payment;
                    $('#ait').val(ait);
                    $('#aitticket').val(ait);
                    $('#aitticket_amount').val(ait_amount);
                    $('#gds_payment').val(gds_payment);
                    $('#supplier_price').val(gds_payment);

                });

                $('#service_charge').on('change', function() {
                    service_charge = this.value;
                    service_charge = parseFloat(service_charge);
                    // console.log(service_charge);
                    if (!isNaN(service_charge)) {
                        var gds_payment = gds + service_charge;
                        $('#gds_payment').val(gds_payment);
                        $('#supplier_price').val(gds_payment);
                    } else {
                        service_charge = 0;
                        var gds_payment = gds + service_charge;
                        $('#gds_payment').val(gds_payment);
                        $('#supplier_price').val(gds_payment);
                    }

                });

                $('#agent_price').on('change', function() {
                    $('#agent_price_1').val(this.value);
                });
            //  end here
            
            // single ticket gds calculation start
            var fare_single, commission_single, tax_single, ait_single, gds_single, service_charge_single;
            var ait_amount = 3830;
            $('#fare_single').on('change', function() {
                fare_single = parseFloat(this.value);
                // console.log(fare_single);
                if (!isNaN(fare_single)) {
                    var commission_singlePercentage = $('#commission_singlePercentage').val();
                    commission_single = (fare_single * commission_singlePercentage) / 100;
                    commission_single = Math.floor(commission_single);
                    // var afterCommission = fare_single - commission_single;

                    $('#commission_single').val(commission_single);
                    $('#commission_singlePercentage').on('change', function() {
                        var commission_singlePercentage = $('#commission_singlePercentage').val();
                        commission_single = (fare_single * commission_singlePercentage) / 100;
                        commission_single = Math.floor(commission_single);
                    // var afterCommission = fare_single - commission_single;

                        $('#commission_single').val(commission_single);
                    });


                }
            });

            $('#tax_single').on('change', function() {
                tax_single = this.value;
                $('#ait_amount_single').val(ait_amount);
                fare_single = parseFloat(fare_single);
                tax_single = parseFloat(tax_single); // replace with the actual source of tax_single value
                ait_amount = parseFloat(ait_amount); // replace with the actual source of ait_amount value

                var total = fare_single + tax_single - ait_amount;
                ait_single = parseFloat((total * 0.3) / 100);
                ait_single = Math.floor(ait_single);
                total = parseFloat(total);
                var gds_payment = fare_single + tax_single + ait_single - commission_single;
                gds_single = gds_payment;
                console.log(gds_payment, ait_single, tax_single);
                $('#ait_single').val(ait_single);
                $('#aitticket_single').val(ait_single);
                $('#aitticket_amount_single').val(ait_amount);
                $('#gds_payment_single').val(gds_payment);
                $('#supplier_price_single').val(gds_payment);

            });

            $('#service_charge_single').on('change', function() {
                service_charge_single = this.value;
                service_charge_single = parseFloat(service_charge_single);
                // console.log(service_charge_single);
                if (!isNaN(service_charge_single)) {
                    var gds_payment = gds_single + service_charge_single;
                    $('#gds_payment_single').val(gds_payment);
                    $('#supplier_price_single').val(gds_payment);
                } else {
                    service_charge_single = 0;
                    var gds_payment = gds_single + service_charge_single;
                    $('#gds_payment_single').val(gds_payment);
                    $('#supplier_price_single').val(gds_payment);
                }

            });

            $('#agent_price_gds').on('change', function() {
                $('#agent_price_single').val(this.value);
            });
            //  end here

            function manipulateString(inputString, variable) {
                if (variable >= 0 && variable <= 100) {
                    var lastTwoChars = inputString.slice(-2);
                    var result = inputString.slice(0, -2) + (parseInt(lastTwoChars) + variable);

                    // Send AJAX request to check if the result already exists on the server
                    $.ajax({
                        url: '/check-result',  // The URL for the server-side route
                        type: 'POST',          // The request type
                        data: {
                            result: result,    // Send the generated result to the server
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
                        },
                        success: function(response) {
                            if (response.exists) {
                                alert('Duplicate ticket numbers: ' + result);
                                if (response.duplicates.length > 0) {
                                    alert('Duplicate ticket numbers: ', response.duplicates);
                                } else {
                                    console.log('No duplicates found.');
                                }
                            } else {
                                console.log('The result is unique: ' + result);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX request failed: ' + error);
                        }
                    });

                    return result;
                } else {
                    console.error('Invalid variable. It should be between 0 and 100.');
                    return null;
                }
            }


            
            $('#number_of_tickets').on('change', function(event) {
                var number_of_tickets = parseInt($('#number_of_tickets').val());
                if (number_of_tickets > 1) {
                    $('#passenger_name').prop('disabled', true);
                    $('#passenger_name').addClass('bg-gray-300');// Change background color
                } else {
                    $('#passenger_name').prop('disabled', false);
                    $('#passenger_name').removeClass('bg-gray-300'); // Reset background color
                }
            });

            $('#add_ticket').on('click', function(event) {
                event.preventDefault();
                var agent = $('#agent_multiple').val();
                var passenger_name = $('#passenger_name').val();
                var supplier = $('#supplier_multiple').val();
                var invoice_date = $('#invoice_date').val();
                var flight_date = $('#flight_date').val();
                var return_date = $('#return_date').val();
                var person = $('#person').val();
                var classOpt = $('#class').val();
                var class_code = $('#class_code').val();
                var sector = $('#sector').val();
                var flight_no = $('#flight_no').val();
                var ticket_code = $('#ticket_code').val();
                var pnr = $('#pnr').val();
                var ticket_no = $('#ticket_no').val();
                var airlines_name = $('#airlines_name').val();
                var airlines_code = $('#airlines_code').val();
                var stuff = $('#stuff').val();
                var agent_price_1 = $('#agent_price_1').val();
                var supplier_price = $('#supplier_price').val();
                var discount = $('#discount').val();
                var remark = $('#remark').val();
                var number_of_tickets = $('#number_of_tickets').val();
                var invoice_no = $('#invoice_no').val();
                var aitticket = $('#aitticket').val();
                var ait = $('#ait').val();
                // console.log(invoice_Date)
                var agent_price_1 = parseFloat($('#agent_price_1').val());
                var supplier_price = parseFloat($('#supplier_price').val());
                
                if (!isNaN(agent_price_1) && !isNaN(supplier_price)) {
                    var profit = agent_price_1 - supplier_price;
                    var tkno = parseInt(number_of_tickets);
                    var total_profit = profit * tkno;
                    console.log(agent_price_1, supplier_price, profit, total_profit, tkno);

                    // Update the content of the div with the calculated total_profit
                    $('#profit_show').html('Net Profit - ' + total_profit);
                } else {
                    alert('Invalid input. Please enter valid numeric values.');
                }


                if (
                    agent &&
                    supplier &&
                    invoice_date &&
                    flight_date &&
                    flight_no &&
                    (ticket_code || ticket_no) && // either ticket code or ticket no should be available
                    (airlines_name || airlines_code) && // either airlines name or code should be available
                    number_of_tickets>1 &&
                    agent_price_1 && sector && stuff &&
                    supplier_price && invoice_no && pnr && person && classOpt
                ) {
                    var csrfToken = "{{ csrf_token() }}";
                    var tableHtml =
                        '<form id="tickets_form" method="post" action="{{ route('addticket.store') }}">';
                    tableHtml += '<input type="hidden" name="_token" value="' + csrfToken + '">';
                    tableHtml += '<table class="table">';
                    tableHtml += '<thead>';
                    tableHtml += '<tr>';
                    tableHtml += '<th>Ticket No</th>';
                    tableHtml += '<th>Invoice Date</th>';
                    tableHtml += '<th>Flight Date</th>';
                    tableHtml += '<th>Flight No</th>';
                    tableHtml += '<th>Ticket Code/No</th>';
                    tableHtml += '<th>Airlines Name/Code</th>';
                    tableHtml += '<th>Pessanger</th>';
                    tableHtml += '<th>Agent Price</th>';
                    tableHtml += '<th>Supplier Price</th>';
                    tableHtml += '<th>Invoice No</th>';
                    // Add more headers as needed
                    tableHtml += '</tr>';
                    tableHtml += '</thead>';
                    tableHtml += '<tbody>';

                    // Populate table rows with data
                    for (var i = 0; i < parseInt(number_of_tickets); i++) {
                        tableHtml += '<tr>';
                        tableHtml += '<td>' + '<input type="text" name="ticket_no[]" id="ticket_no_' + i +
                            '" value="' + manipulateString(ticket_no, i) + '"></td>';
                        tableHtml += '<td>' + invoice_date + '</td>';
                        tableHtml += '<td>' + flight_date + '</td>';
                        tableHtml += '<td>' + flight_no + '</td>';
                        tableHtml += '<td>' + (ticket_code || ticket_no) + '</td>';
                        tableHtml += '<td>' + (airlines_name || airlines_code) + '</td>';
                        tableHtml += '<td>' +
                            '<input type="text" class="form-control" name="passenger_name[]" id="passenger_name_' +
                            i + '"></td>';
                        tableHtml += '<td>' + agent_price_1 + '</td>';
                        tableHtml += '<td>' + supplier_price + '</td>';
                        tableHtml += '<td>' + '<input type="text" name="invoice_no[]" id="invoice_no' + i +
                            '" value="' + manipulateString(invoice_no, i) + '"></td>';
                        tableHtml += '<td>' +  + '</td>';
                        // Add more cells as needed
                        tableHtml += '</tr>';
                    }
                    tableHtml += '<input type="hidden" name="agent" value="' + agent + '">';
                    tableHtml += '<input type="hidden" name="pnr" value="' + pnr + '">';
                    tableHtml += '<input type="hidden" name="supplier" value="' + supplier + '">';
                    tableHtml += '<input type="hidden" name="agent_price" value="' + agent_price_1 + '">';
                    tableHtml += '<input type="hidden" name="supplier_price" value="' + supplier_price +
                        '">';
                    tableHtml += '<input type="hidden" name="invoice_date" value="' + invoice_date + '">';
                    tableHtml += '<input type="hidden" name="flight_date" value="' + flight_date + '">';
                    // tableHtml += '<input type="hidden" name="invoice_no" value="' + invoice_no + '">';
                    tableHtml += '<input type="hidden" name="flight_no" value="' + flight_no + '">';
                    tableHtml += '<input type="hidden" name="return_date" value="' + return_date + '">';
                    tableHtml += '<input type="hidden" name="class" value="' + classOpt + '">';
                    tableHtml += '<input type="hidden" name="class_code" value="' + class_code + '">';
                    tableHtml += '<input type="hidden" name="person" value="' + person + '">';
                    tableHtml += '<input type="hidden" name="sector" value="' + sector + '">';
                    tableHtml += '<input type="hidden" name="ticket_code" value="' + ticket_code + '">';
                    // tableHtml += '<input type="hidden" name="ticket_no" value="'+ ticket_no +'">';
                    tableHtml += '<input type="hidden" name="airlines_name" value="' + airlines_name + '">';
                    tableHtml += '<input type="hidden" name="airlines_code" value="' + airlines_code + '">';
                    tableHtml += '<input type="hidden" name="remark" value="' + remark + '">';
                    tableHtml += '<input type="hidden" name="stuff" value="' + stuff + '">';
                    tableHtml += '<input type="hidden" name="ait" value="' + ait + '">';
                    tableHtml += '<input type="hidden" name="ait_amount" value="' + aitticket + '">';
                    tableHtml += '</tbody>';
                    tableHtml += '</table>';
                    tableHtml += '<td colspan="10" class="text-center">';
                    tableHtml +=
                        '<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">';
                    tableHtml += 'Submit';
                    tableHtml += '</button>';
                    tableHtml += '</td>';
                    tableHtml += '</form>';
                    // Append the table to the modal or wherever you want to display it
                    $('#tableContainer').html(tableHtml);

                    $('#myModal').modal('show');
                } 
                else if(
                agent && stuff &&
                supplier &&
                invoice_date &&
                flight_date &&
                flight_no &&
                (ticket_code || ticket_no) && // either ticket code or ticket no should be available
                (airlines_name || airlines_code) && // either airlines name or code should be available
                number_of_tickets == 1 &&
                agent_price_1 && sector &&
                supplier_price && invoice_no && pnr && person && classOpt )
                {
                    var csrfToken = "{{ csrf_token() }}";
                 
                    var formData = $("#ticket_form").serialize();
                    $.ajax({
                        url: '/addsingleticket', // Use the correct route name
                        type: 'POST',
                        data: formData, // Send the serialized data
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            // Handle the success response data as needed
                            alert('Ticket added successfully');
                            window.location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Handle errors here
                            console.error('Error:', errorThrown);
                        }
                    });

                }
                else {
                    alert('Some required variables are missing.');
                }




            });


        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
           
            var sectorInput = document.getElementById('sector');
            var sectorInputSingle = document.getElementById('sector_single');
    
            sectorInput.addEventListener('input', function() {
                var inputValue = this.value.toUpperCase();
                var formattedValue = inputValue.replace(/-/g, ''); // Remove existing hyphens
                var newValue = '';
                for (var i = 0; i < formattedValue.length; i++) {
                    newValue += formattedValue[i];
                    if ((i + 1) % 3 === 0 && i + 1 !== formattedValue.length) {
                        newValue += '-';
                    }
                }
                this.value = newValue;
            });

            sectorInput.addEventListener('keydown', function(event) {
                if (event.key === 'Backspace') {
                    var currentValue = this.value;
                    if (currentValue.slice(-1) === '-') {
                        this.value = currentValue.slice(0, -2); // Remove the character before the hyphen
                        event.preventDefault();
                    }
                }
            });
            sectorInputSingle.addEventListener('input', function() {
                var inputValue = this.value.toUpperCase();
                var formattedValue = inputValue.replace(/-/g, ''); // Remove existing hyphens
                var newValue = '';
                for (var i = 0; i < formattedValue.length; i++) {
                    newValue += formattedValue[i];
                    if ((i + 1) % 3 === 0 && i + 1 !== formattedValue.length) {
                        newValue += '-';
                    }
                }
                this.value = newValue;
            });

            sectorInputSingle.addEventListener('keydown', function(event) {
                if (event.key === 'Backspace') {
                    var currentValue = this.value;
                    if (currentValue.slice(-1) === '-') {
                        this.value = currentValue.slice(0, -2); // Remove the character before the hyphen
                        event.preventDefault();
                    }
                }
            });
        });
        var flightInput = document.getElementById('flight_no');

        flightInput.addEventListener('input', function() {
            var inputValue = this.value;
            if (inputValue.length === 2) {
                this.value = inputValue + '-';
            }
        });

        flightInput.addEventListener('keydown', function(event) {
            if (event.key === 'Backspace' && this.value.length > 2) {
                this.value = this.value.slice(0, -1);
                event.preventDefault();
            }
        });
    </script>
</x-app-layout>
