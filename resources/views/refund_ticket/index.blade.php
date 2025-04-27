<x-app-layout>
    <div class="container-fluid mx-auto mt-5">
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="mb-4 text-3xl font-bold w-[100%] lg:w-[85%]">Ticket Refund Invoicing 2</h1>
    
        <div class="bg-white shadow-md rounded-lg w-[100%] lg:w-[75%] p-6 mb-8">
            <form autocomplete="off" action="/addsupplier" method="post">
                @csrf <!-- Add this line to include CSRF protection in Laravel -->
                
                <div class="grid grid-cols-2 gap-x-14">
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="ticket" class="block text-md font-semibold text-black ">Ticket Search:</label>
                        <input type="text" class=" mt-1 block w-[65%] border p-1" id="ticket" name="ticket" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="name" class="block text-md font-semibold text-black ">Passenger Name:</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="name" name="name" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="sector" class="block text-md font-semibold text-black ">Sector</label>
                        <input type="tel" class="form-input mt-1 block text-sm w-[65%] border p-1" id="sector" name="sector" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="flight" class="block text-md font-semibold text-black ">Flight No</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="flight" name="flight" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="flight_date" class="block text-md font-semibold text-black ">Flight Date</label>
                        <input type="date" class="form-input mt-1 block text-sm w-[65%] border p-1" id="flight_date" name="flight_date" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="refund_date" class="block text-md font-semibold text-black ">Refund Date</label>
                        <input type="date" class="form-input mt-1 block text-sm w-[65%] border p-1" id="refund_date" name="refund_date" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="agent" class="block text-md font-semibold text-black ">Client</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="agent" name="agent" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="Supplier" class="block text-md font-semibold text-black ">Suplier</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="Supplier" name="Supplier" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="agent_fare" class="block text-md font-semibold text-black ">Client Fare</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="agent_fare" name="agent_fare" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="supplier_fare" class="block text-md font-semibold text-black ">Supplier Fare</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="supplier_fare" name="supplier_fare" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="agent_refundfare" class="block text-md font-semibold text-black ">Client Refund Fare</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="agent_refundfare" name="agent_refundfare" required>
                    </div>
                    <div class="mb-4 flex items-center justify-between gap-6">
                        <label for="supplier_refundfare" class="block text-md font-semibold text-black ">Supplier Refund Fare</label>
                        <input type="text" class="form-input mt-1 block text-sm w-[65%] border p-1" id="supplier_refundfare" name="supplier_refundfare" required>
                    </div>
                </div>
               
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
            </form>
        </div>
    
        <div class="bg-white shadow-md p-6">
            <table class="table divide-y table-striped divide-gray-200 table-hover no-wrap" id="suppliertable">
                <thead class="bg-[#7CB0B2]">
                    <tr>
                        <th class="px-4 py-2 ">Serial</th>
                        <th class="px-4 py-2 ">Refund Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($refund_ticket as $index => $refund)
                        <tr>
                            <td class="px-4 py-2 ">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 ">{{ $refund->refund_date }}</td>
                            {{-- <td class="px-4 py-2 ">
                                <a href="{{ route('supplier.edit', ['id' => encrypt($supplier->id)]) }}" class="text-blue-500 hover:underline">Edit</a>
                                <a href="{{ route('supplier.delete', ['id' => $supplier->id]) }}" class="text-red-500 hover:underline ml-2">Delete</a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                autoclose: true
            });
    
            $('.select2').select2({
                theme:'classic',
            });

            // $('#suppliertable').DataTable();
        //     new DataTable('#suppliertable', {
        //     responsive: true,
        //     rowReorder: {
        //         selector: 'td:nth-child(2)'
        //     }
        // });
        });

        
    </script>
    
</x-app-layout>