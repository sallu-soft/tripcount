<x-app-layout>
    <div class="container-fluid mx-auto mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <h1 class="mb-4 text-3xl font-bold w-[100%] mx-auto lg:w-[75%]">Ticket Void Invoicing</h1>
    
        <div class="bg-white shadow-md rounded-lg w-[100%] mx-auto lg:w-[75%] p-6 mb-8">
            <form autocomplete="off" action="{{ route('ticket_void') }}" method="post">
                @csrf <!-- Add this line to include CSRF protection in Laravel -->
                <div class="mb-4 flex items-center gap-6">
                    <label for="ticket" class="w-[15%] block text-md font-semibold text-black ">Ticket Search:</label>
                    {{-- <input type="text" class="bg-green-50 rounded-lg shadow-lg border-2 border-green-400 mt-1 block w-[65%] p-1" id="ticket" name="ticket" required> --}}
                    <div class="w-[40%] flex items-center border-2 border-black">
                    <input
                        type="text"
                        class="block py-1 border-1 bg-gray-50 px-2 leading-1.5 outline-none transition-all duration-200 ease-linear  w-full"
                        placeholder="Search"
                        aria-label="Search"
                        id="ticket"
                        name="ticket"
                        aria-describedby="basic-addon1" />
                    
                    <button
                        class="flex items-center  bg-primary py-1.5 px-3  text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2"
                        type="button"
                        id="button-addon1"
                        data-twe-ripple-init
                        data-twe-ripple-color="light">
                        <span class="[&>svg]:h-5 [&>svg]:w-5">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor">
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        </span>
                    </button>
                </div>
                </div>
                <div class="grid grid-cols-2 gap-x-14">
                    
                    
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="name" class="block text-md font-semibold text-black ">Passenger Name:</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="name" name="name" readonly required>
                    </div>
                    {{-- <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="name" class="block text-md font-semibold text-black ">TICKET Code:</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="ticket_code" name="ticket_code" readonly required>
                    </div> --}}
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="sector" class="block text-md font-semibold text-black ">Sector</label>
                        <input type="tel" readonly class="form-input mt-1 block text-sm w-[65%] border p-1" id="sector" name="sector" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="flight" class="block text-md font-semibold text-black ">Flight No</label>
                        <input type="text" readonly class="form-input mt-1 block text-sm w-[65%] border p-1" id="flight" name="flight" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="flight_date" class="block text-md font-semibold text-black ">Flight Date</label>
                        <input type="date" class="form-input mt-1 block text-sm w-[65%] border p-1" id="flight_date" readonly name="flight_date" required>
                    </div>
                    {{-- <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="refund_date" class="block text-md font-semibold text-black ">Refund Date</label>
                        <input type="date" class="form-input mt-1 block text-sm w-[65%] border p-1" id="refund_date" name="refund_date" required>
                    </div> --}}
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="agent" class="block text-md font-semibold text-black ">Client</label>
                        <input type="text" readonly class="form-input mt-1 block text-sm w-[65%] border p-1" id="agent"  required>
                        <input type="hidden" class="form-control" name="agent" id="agent_id" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="Supplier" class="block text-md font-semibold text-black ">Supplier</label>
                        <input type="text" readonly class="form-input mt-1 block text-sm w-[65%] border p-1" id="supplier" required>
                        <input type="hidden" class="form-control" name="supplier" id="supplier_id" required>

                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="agent_fare" class="block text-md font-semibold text-black ">Client Fare</label>
                        <input type="text" readonly class="form-input mt-1 block text-sm w-[65%] border p-1" id="agent_fare" name="agent_fare" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="supplier_fare" class="block text-md font-semibold text-black ">Supplier Fare</label>
                        <input type="text" readonly class="form-input mt-1 block text-sm w-[65%] border p-1" id="supplier_fare" name="supplier_fare" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="agent_refundfare" class="block text-md font-semibold text-black ">Client Void Charge</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="agent_refundfare" name="agent_refundfare" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="supplier_refundfare" class="block text-md font-semibold text-black ">Supplier Void Charge</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="supplier_refundfare" name="supplier_refundfare" required>
                    </div>
                </div>
               
                <div class="flex justify-end">
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded ">Submit</button>
                </div>
            </form>
        </div>
    
        <div class="bg-white shadow-md p-6">
            <form method="GET" action="{{ route('void.view') }}" class="flex justify-end mb-3">
                <div class="flex items-center gap-3">
                    <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
                    <button type="submit" class="bg-black px-5 py-1.5 rounded text-white">Search</button>
                </div>
            </form>
            <table class="table divide-y table-striped w-full divide-gray-200 table-hover no-wrap" id="suppliertable">
                <thead class="bg-[#7CB0B2]">
                    <tr>
                        <th class="px-4 py-2 ">Serial</th>
                        <th class="px-4 py-2 ">Void Date</th>
                        <th class="px-4 py-2 ">Ticket No</th>
                        <th class="px-4 py-2 ">Passenger Name</th>
                        <th class="px-4 py-2 ">Agent</th>
                        <th class="px-4 py-2 ">Supplier</th>
                        <th class="px-4 py-2 ">Void Agent Fare</th>
                        <th class="px-4 py-2 ">Void Supplier Fare</th>
                        <th class="px-4 py-2 ">Void Profit</th>

                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach($void_tickets as $index => $void)
                        <tr>
                            <td class="px-4 py-2 ">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 ">{{ $void->date }}</td>
                            <td class="px-4 py-2 ">{{ $void->ticket_no }}</td>
                            <td class="px-4 py-2 ">{{ $void->passenger_name }}</td>
                            <td class="px-4 py-2 ">{{ $void->agent }}</td>
                            <td class="px-4 py-2 ">{{ $void->supplier }}</td>
                            <td class="px-4 py-2 ">{{ $void->now_agent_fere }}</td>
                            <td class="px-4 py-2 ">{{ $void->now_supplier_fare }}</td>
                            <td class="px-4 py-2 ">{{ $void->void_profit }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $void_tickets->links() }}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            // $('.datepicker').datepicker({
            //     autoclose: true
            // });

            // $('.select2').select2({
            //     theme: 'classic',
            // });

            // Initialize DataTable
            // new DataTable('#suppliertable', {
            //     responsive: true,
            //     rowReorder: {
            //         selector: 'td:nth-child(2)'
            //     }
            // });

            // Add onchange event handler for #ticket element
            $('#ticket').on('change', function () {
                var tckno = this.value;
                $.ajax({
                    url: '{{ route('search_ticket') }}', // Use the Laravel named route
                    method: 'POST',
                    data: {
                        ticketNumber: tckno
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            // Ticket found
                            $('#name').val(response.ticket.passenger);
                            $('#ticket_code').val(response.ticket.ticket_code);
                            $('#flight').val(response.ticket.flight_no);
                            $('#flight_date').val(response.ticket.flight_date);
                            $('#sector').val(response.ticket.sector);
                            $('#agent').val(response.agent);
                            $('#supplier').val(response.supplier);
                            $('#agent_fare').val(response.ticket.agent_price);
                            $('#supplier_fare').val(response.ticket.supplier_price);
                            $('#agent_id').val(response.ticket.agent);
                            $('#supplier_id').val(response.ticket.supplier);
                        } else {
                            // Ticket not found
                            alert('Ticket not found. Message:', response.message);
                            // You can display a message to the user or take other actions
                        }
                    },
                    error: function (error) {
                        // Handle the error here
                        console.error('AJAX error:', error);
                        // You can display an error message or take other actions
                    }
                });

            });
        });
    </script>

    
</x-app-layout>