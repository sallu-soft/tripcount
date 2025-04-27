<h2 class="text-center font-bold text-3xl my-2">Sales Report (Ticket)</h2>
<div class="flex items-center justify-between mb-2">
    <div class="text-lg">
        <h2 class="font-semibold">Company Name: {{ Auth::user()->name }}</h2>
        <p><span class="font-semibold">Period Date:</span> {{ $start_date }} to {{ $end_date }}</p>
    </div>
    <div class="flex items-center">
        <!-- You can add any additional content here -->
    </div>
</div>

<table class="table-auto w-full shadow-xl bg-white text-sm my-1">
    <thead>
        <tr class="border-t border-b border-gray-300 bg-[#00959E] text-black">
            <th class="text-start py-2 pl-2">Booking Date</th>
            <th class="text-start py-2 pl-2">Ticket No</th>
            <th class="text-start py-2 pl-2">Passenger Name</th>
            <th class="text-start py-2 pl-2">Flight Date</th>
            <th class="text-start py-2 pl-2">Sector</th>
            <th class="text-start py-2 pl-2">Airlines</th>

            {{-- @if($show_agent) --}}
                <th class="text-start py-2 pl-2">Agent</th>
                <th class="text-start py-2 pl-2">Agent Price</th>
            {{-- @endif --}}

            @if($show_supplier)
                <th class="text-start py-2 pl-2">Supplier</th>
                <th class="text-start py-2 pl-2">Supplier Price</th>
            @endif

            @if($show_profit)
                <th class="text-start py-2 pl-2">Net Markup</th>
            @endif

            <th class="text-start py-2 pl-2">Balance Amount</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total_agent_price = $total_supplier_price = $total_profit = $count = 0;
        @endphp
        
        {{-- @foreach ($alldata as $agentId => $tickets)
            @php
                // Retrieve agent name by agent ID
                $agentName = \App\Models\Agent::find($agentId)->name ?? 'Unknown';
            @endphp

            <tr>
                <td colspan="8" class="font-bold">{{ $agentName }}</td> <!-- Display the agent's name -->
            </tr>

            @foreach ($tickets as $ticket)
                <tr class="border-t border-gray-300">
                    <td class="py-2 pl-2">{{ (new DateTime($ticket->invoice_date))->format('d-m-Y') }}</td>
                    <td class="py-2">{{ $ticket->ticket_no }}</td>
                    <td class="py-2">{{ $ticket->passenger }}</td>
                    <td class="py-2">{{ (new DateTime($ticket->flight_date))->format('d-m-Y') }}</td>
                    <td class="py-2">{{ $ticket->sector }}</td>
                    <td class="py-2">{{ $ticket->airline_name }}</td>

                    @if ($show_agent)
                        <td class="py-2">{{ $agentName }}</td>
                        <td class="py-2">{{ $ticket->agent_price }}</td>
                    @endif

                    @if ($show_supplier)
                        <td class="py-2">{{ $ticket->supplier_name }}</td>
                        <td class="py-2">{{ $ticket->supplier_price }}</td>
                    @endif

                    @if ($show_profit)
                        <td class="py-2">{{ $ticket->profit }}</td>
                    @endif

                    <td class="py-2">{{ $ticket->agent_price }}</td>
                </tr>
            @endforeach
        @endforeach --}}

        @foreach ($alldata as $ticket)
                
            @php
                $total_agent_price += $ticket->agent_price;
                $total_supplier_price += $ticket->supplier_price;
                $total_profit += $ticket->profit;
                $count++;
            @endphp
            <tr class="border-t border-gray-300">
                <td class="py-2 px-4">{{ (new \DateTime($ticket->invoice_date))->format('d-m-Y') }}</td>
                <td class="py-2 px-4">{{ $ticket->ticket_no }}</td>
                <td class="py-2 px-4">{{ $ticket->passenger }}</td>
                <td class="py-2 px-4">{{ (new \DateTime($ticket->flight_date))->format('d-m-Y') }}</td>
                <td class="py-2 px-4">{{ $ticket->sector }}</td>
                <td class="py-2 px-4">{{ $ticket->airline_name }}</td>

                @if ($show_agent)
                    <td class="py-2 px-4">{{ $ticket->agent_name }}</td>
                    <td class="py-2 px-4">{{ $ticket->agent_price }}</td>
                @endif

                @if ($show_supplier)
                    <td class="py-2 px-4">{{ $ticket->supplier_name }}</td>
                    <td class="py-2 px-4">{{ $ticket->supplier_price }}</td>
                @endif

                @if ($show_profit)
                    <td class="py-2 px-4">{{ $ticket->profit }}</td>
                @endif
                <td class="py-2 px-4">{{ $total_agent_price }}</td>

            </tr>
        @endforeach



        <tr class="bg-dark-600 border-t border-black">
            <td class="text-start py-2"><b>Total - {{ $count }}</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            {{-- @if ($show_agent) --}}
                <td></td>
                <td class="text-start py-2"><b>{{ $total_agent_price }}</b></td>
            {{-- @endif --}}

            @if ($show_supplier)
                <td></td>
                <td class="text-start py-2"><b>{{ $total_supplier_price }}</b></td>
            @endif

            @if ($show_profit)
                <td class="text-start py-2"><b>{{ $total_profit }}</b></td>
            @endif

            <td class="text-start py-2"><b>{{ $total_agent_price }}</b></td>
        </tr>
    </tbody>
</table>