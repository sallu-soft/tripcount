<h2 class="text-center font-bold text-3xl my-2">Flight Report (Ticket)</h2>
<div class="flex items-center justify-between mb-2">
    <div class="text-lg">
        <h2 class="font-semibold">Company Name: {{ Auth::user()->name }}</h2>
        <p><span class="font-semibold">Period Date:</span> {{ $start_date }} to {{ $end_date }}</p>
    </div>
    <div class="flex items-center">
        <!-- You can add any additional content here -->
    </div>
</div>
<table class="table-auto w-full bordered shadow-xl bg-white border-black text-sm my-1">
    <thead>
        <tr class="border-y-2 border-black bg-[#00959E] py-[10px] h-[30px] text-[18px] text-white">
            <th class="text-start">Booking Date</th>
            <th class="text-start">Ticket No</th>
            <th class="text-start">Passenger Name</th>
            <th class="text-start">Flight Date</th>
            <th class="text-start">Sector</th>
            <th class="text-start">Airlines</th>

            @if($show_agent)
                
                <th class="text-start">Agent Price</th>
            @endif

            @if($show_supplier)
                <th class="text-start">Supplier</th>
                <th class="text-start">Supplier Price</th>
            @endif

            @if($show_profit)
                <th class="text-start">Net Markup</th>
            @endif

            <th class="text-start">Balance Amount</th>
        </tr>
    </thead>
    <tbody>
        @php
            // Initialize totals for each field
            $total_agent_price = $total_supplier_price = $total_profit = $total_balance = $count = 0;
        @endphp

        {{-- Loop over grouped tickets (grouped by agent) --}}
        @foreach ($alldata as $agent_id => $tickets)
            @php
                // Fetch agent name using the agent ID (assuming it's the key)
                $agent = \App\Models\Agent::where('id', $agent_id)->value('name');
                $agent_openning_balance = \App\Models\Agent::where('id', $agent_id)->value('opening_balance');
                $agent_total_price = $agent_total_supplier_price = $agent_total_profit = $agent_total_balance =  $per_agent_count = 0;
            @endphp

            {{-- For each agent, display their name --}}
            <tr class="bg-gray-200">
                <td colspan="10" class="font-bold text-lg">{{ $agent }}</td>
            </tr>

            {{-- Loop over tickets for the current agent --}}
          
            @foreach ($tickets as $data)
                @php
                    $supplier = \App\Models\Supplier::where('id', $data->supplier)->value('name');

                    // Update totals for the agent
                    $agent_total_price += $data->agent_price;
                    $agent_total_supplier_price += $data->supplier_price;
                    $agent_total_profit += $data->profit;
                    $agent_total_balance += $data->agent_price;
                    // $this_agent_amount += $data->agent_price;
                    // Update global totals
                    $total_agent_price += $data->agent_price;
                    $total_supplier_price += $data->supplier_price;
                    $total_profit += $data->profit;
                    $total_balance += $data->agent_price;

                    $count++;
                    $per_agent_count++;
                @endphp

                <tr class="border-b border-gray-400">
                    <td class="py-2 pl-2">{{ (new DateTime($data->invoice_date))->format('d-m-Y') }}</td>
                    <td class="py-2">{{ $data->ticket_no }}</td>
                    <td class="py-2">{{ $data->passenger }}</td>
                    <td class="py-2">{{ (new DateTime($data->flight_date))->format('d-m-Y') }}</td>
                    <td class="py-2">{{ $data->sector }}</td>
                    <td class="py-2">{{ $data->airline_name }}</td>

                    @if ($show_agent)
                        {{-- <td class="text-start py-2">{{ $agent }}</td> --}}
                        <td class="text-center py-2">{{ $data->agent_price }}</td>
                    @endif

                    @if ($show_supplier)
                        <td class="text-start py-2">{{ $supplier }}</td>
                        <td class="text-center py-2">{{ $data->supplier_price }}</td>
                    @endif

                    @if ($show_profit)
                        <td class="text-center py-2">{{ $data->profit }}</td>
                    @endif

                    <td class="py-2 text-center">{{ $agent_total_price }}</td>  <!-- Display balance for each ticket -->
                </tr>
            @endforeach

            {{-- Agent totals --}}
            <tr class="">
                <td colspan="5" class="text-right font-bold">Agent Total - {{$per_agent_count}}</td>
                <td class="text-right font-bold"></td>
                {{-- <td></td> --}}
                <td></td>
               
                
                <td class="text-start py-2"><b>{{ $agent_total_price }}</b></td>
                @if ($show_supplier)
                    <td class="text-start py-2"><b>{{ $agent_total_supplier_price }}</b></td>
                @endif
                @if ($show_profit)
                    <td class="text-start py-2"><b>{{ $agent_total_profit }}</b></td>
                @endif
                {{-- <td class="text-start py-2"><b>{{ $agent_total_balance }}</b></td> --}}
            </tr>
        @endforeach

        {{-- Global totals --}}
        <tr class="">
            <td class="text-start py-2"><b>Total - {{ $count }}</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            {{-- <td></td> --}}
            
            @if ($show_agent)
                {{-- <td></td> --}}
                <td class="text-start py-2"><b>{{ $total_agent_price }}</b></td>
            @endif

            @if ($show_supplier)
                <td></td>
                <td class="text-start py-2"><b>{{ $total_supplier_price }}</b></td>
            @endif

            @if ($show_profit)
                <td class="text-start py-2"><b>{{ $total_profit }}</b></td>
            @endif

            <td class="text-start py-2"><b>{{ $total_balance }}</b></td>  <!-- Display total balance -->
        </tr>
    </tbody>
</table>

