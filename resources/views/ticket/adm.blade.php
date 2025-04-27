<x-app-layout>
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
    <h2 class="text-2xl py-4 flex lg:w-3/4 w-full mx-auto font-bold
    px-2  text-gray-900">
        ADM Invoicing
    </h2>
    <div class="flex bg-gray-50 flex-col justify-center items-center p-6 rounded-lg shadow-lg lg:w-3/4 w-full mx-auto my-2">
      
    <form autocomplete="off" action="{{ route('adm_entry') }}" method="post" class="w-full">
        @csrf
        <div class="flex flex-wrap xl:gap-x-7 lg:gap-x-2 md:gap-x-2 sm:gap-x-0 -mx-4 mb-4">
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="invoice_no" class="block w-[50%]">Invoice No.</label>
                <input type="text" id="invoice_no"
                    class="text-center text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    name="invoice_no" readonly>
            </div>
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
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
        </div>

        <div class="flex flex-wrap xl:gap-x-7 lg:gap-x-2 md:gap-x-2 sm:gap-x-0 -mx-4 mb-4">
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="invoice_date" class="block w-[50%]">Invoice
                    Date</label>
                <input type="date" id="invoice_date"
                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    name="invoice_date">
            </div>
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="flight_date" class="w-[50%]">Flight
                    Date</label>
                <input type="date" id="flight_date"
                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    name="flight_date">
            </div>
        </div>
        <div class="flex flex-wrap xl:gap-x-7 lg:gap-x-2 md:gap-x-2 sm:gap-x-0 -mx-4 mb-4">
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="sector" class="w-[50%]">Sector</label>
                <input type="text" id="sector"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    name="sector">
            </div>
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="flight_no" class="w-[50%]">Flight No</label>
                <input type="text" id="flight_no"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    name="flight_no">
            </div>
        </div>
        <div class="flex flex-wrap xl:gap-x-7 lg:gap-x-2 md:gap-x-2 sm:gap-x-0 -mx-4 mb-4">
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="ticket_no" class="w-[50%]">PNR</label>
                <div class="flex w-full gap-x-4">
                    <input type="text" id="ticket_code"
                        class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                        name="ticket_code">
                    {{-- <input type="text" id="ticket_no" maxlength="10"
                        class="bg-gray-50 w-[73%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                        name="ticket_no"> --}}
                </div>
            </div>
            {{-- <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="number_of_tickets" class="w-[50%]">Number of
                    Tickets</label>
                <input type="number" id="number_of_tickets"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    name="number_of_tickets">
            </div> --}}
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="passenger_name" class="w-[50%]">Passenger
                    Name</label>
                <input type="text" id="passenger_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    name="passenger_name">
            </div>
        </div>
        <div class="flex flex-wrap xl:gap-x-7 lg:gap-x-2 md:gap-x-2 sm:gap-x-0 -mx-4 mb-4">
            
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="airline" class="w-[50%]">Airline</label>
                <div class="flex w-full gap-x-3">
                    <input type="text" id="airlines_name"
                        class="bg-gray-50 w-[73%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                        name="airlines_name">
                    <input type="text" id="airlines_code"
                        class="bg-gray-50 w-[23%] border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block p-1"
                        name="airlines_code">
                </div>
            </div>
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="supplier" class="w-[50%]">Supplier</label>

                <select name="supplier" id="supplier"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block max-w-full select2 p-1">
                        <option value="">Select Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }} {{$supplier->company}}</option>
                        @endforeach
                    </select>
                
            </div>
        </div>
        
        <div class="flex flex-wrap xl:gap-x-7 lg:gap-x-2 md:gap-x-2 sm:gap-x-0 -mx-4 mb-4">
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="agent_price" class="w-[50%]">Agent ADM
                    Price</label>
                <input type="text" id="agent_adm_price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    name="agent_adm_price">
            </div>
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="supplier_price" class="w-[50%]">Supplier ADM
                    Price</label>
                <input type="text" id="supplier_adm_price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    name="supplier_adm_price">
            </div>
        </div>
        <div class="flex flex-wrap xl:gap-x-7 lg:gap-x-2 md:gap-x-2 sm:gap-x-0 -mx-4 mb-4">
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="stuff" class="w-[50%]">Stuff</label>
                <input type="text" id="stuff"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    name="stuff">
            </div>
            <div class="w-full md:w-[48%] px-4 mb-2 flex items-center">
                <label for="remark" class="w-[50%]">Remark</label>
                <textarea id="remark"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-1"
                    name="remark"></textarea>
            </div>

        </div>
        
        {{-- <div class="col-span-2 mx-3 flex justify-end">
            <button  type="submit"
                class="bg-[#922724] text-xl hover:bg-blue-700 text-white font-bold py-2 px-16 rounded">Submit</button>
        </div> --}}
        <div class="flex justify-end mr-5">
            <button type="submit" id="add_ticket" class="bg-black text-white px-4 py-2 rounded ">Submit</button>
        </div>

    </form>

        

        
        
        
    </div>

    <form method="GET" action="{{ route('adm.view') }}" class="flex justify-end mb-3">
        <div class="flex items-center gap-3">
            <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
            <button type="submit" class="bg-black px-5 py-1.5 rounded text-white">Search</button>
        </div>
    </form>
    <table class="table-fixed mx-4 border rounded-lg overflow-hidden table table-striped table-hover"
    id="ticket_table">
    <thead>
        <tr class="border-b bg-[#7CB0B2]">
            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Invoice</th>
            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Invoice Date</th>
            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Ticket No</th>
            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Passenger</th>
            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Flight Date</th>

            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Airline</th>
            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Agent</th>

            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Supplier</th>
            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Agent Deportee Price</th>

            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Supplier Deportee Price</th>
            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Remark</th>
            <th class="w-1/6 px-4 py-2 text-left text-gray-900 font-medium">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($adm as $ticket)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-2 py-2 text-gray-700">{{ $ticket->invoice }}</td>
                <td class="px-2 py-2 text-gray-700">{{ (new DateTime($ticket->invoice_date))->format('d/m/Y') }}
                </td>
                <td class="px-2 py-2 text-gray-700">{{ $ticket->ticket_code }}-{{ $ticket->ticket_no }}</td>
                <td class="px-2 py-2 text-gray-700">{{ $ticket->passenger }}</td>

                <td class="px-2 py-2 text-gray-700">{{ (new DateTime($ticket->flight_date))->format('d/m/Y') }}
                </td>
                <td class="px-2 py-2 text-gray-700">{{ $ticket->airline_code }}-{{ $ticket->airline_name }}</td>
                <td class="px-2 py-2 text-gray-700">{{ $ticket->agent }}</td>

                <td class="px-2 py-2 text-gray-700">{{ $ticket->supplier }}</td>
                <td class="px-2 py-2 text-gray-700">{{ $ticket->agent_adm_price }}</td>
                <td class="px-2 py-2 text-gray-700">{{ $ticket->supplier_adm_price }}</td>


                <td class="px-2 py-2 text-gray-700">{{ $ticket->remark }}</td>
                <td class="px-2 py-2 text-gray-700 flex items-center justify-around">
                    <a href="{{ route('ticket_edit', ['id' => $ticket->id]) }}"
                        class="text-blue-500 hover:text-blue-700 mr-1">
                        <i class="fa fa-pencil fa-fw text-xl"></i>
                    </a>
                    <a href="{{ route('ticket_view', ['id' => $ticket->id]) }}"
                        class="text-green-500 hover:text-green-700 mr-1">
                        <i class="fa fa-eye fa-fw text-xl"></i>
                    </a>
                    <a href="#" onclick="confirmDelete('{{ route('ticket.delete', ['id' => $ticket->id]) }}')"
                      class="text-red-800 hover:text-red-900 mr-1">
                      <i class="fa fa-trash fa-fw text-xl"></i>
                   </a>
                    {{-- <a href="{{ route('ticket_print', ['id' => $ticket->id]) }}" class="text-red-500 hover:text-red-700">
                <i class="fas fa-print"></i> Print
            </a> --}}
                </td>

            </tr>
        @endforeach

    </tbody>
    </table>
    {{ $adm->links() }}

    

     
   
   
   
   <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        
            $('.select2').select2();
            $('.datepicker').datepicker({
                // autoclose: true
            });

            
        });
            function generateRandomString() {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '/get-last-id-adm', // Replace with the actual URL to fetch the last ID
                        method: 'GET',
                        success: function(response) {
                            let lastId = response.lastId || 0;
                            lastId = parseInt(lastId) + 1;

                            // Format the lastId with leading zeros to make it 6 digits
                            const formattedLastId = lastId.toString().padStart(6, '0');

                            const randomString = `ADM-${formattedLastId}`;

                            // Resolve the promise with the generated random string
                            resolve(randomString);
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
                            $('#airlines_name').val(response.airline.Full);
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
            $('#invoice_no').val(generateRandomString());
            var fare, commission, tax, ait, gds, service_charge;
            var ait_amount = 3830;
            $('#fare').on('change', function () {
                fare = parseFloat(this.value);

                if (!isNaN(fare)) {
                    var commissionPercentage = 7;
                    commission = (fare * commissionPercentage) / 100;
                    commission = Math.floor(commission);
                    // var afterCommission = fare - commission;
                    $('#commission').val(commission);

                }
            });

            $('#tax').on('change', function(){
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
                $('#gds_payment').val(gds_payment);
                $('#supplier_price').val(gds_payment);

            });

            $('#service_charge').on('change', function(){
                  service_charge = this.value;
                  service_charge = parseFloat(service_charge);
                  // console.log(service_charge);
                  if(!isNaN(service_charge)){
                    var gds_payment = gds + service_charge;
                    $('#gds_payment').val(gds_payment);
                    $('#supplier_price').val(gds_payment);
                  }
                  else{
                    service_charge = 0;
                    var gds_payment = gds + service_charge;
                    $('#gds_payment').val(gds_payment);
                    $('#supplier_price').val(gds_payment);
                  }
                  
            });


            // $('#agent_price').on('change', function(){
            //     $('#agent_deportee_price').val(this.value);
            // });

            function manipulateString(inputString, variable) {
                if (variable >= 0 && variable <= 9) {
                    var lastTwoChars = inputString.slice(-2);
                    var result = inputString.slice(0, -2) + (parseInt(lastTwoChars) + variable);
                    return result;
                } else {
                    console.error('Invalid variable. It should be between 0 and 9.');
                    return null;
                }
            }

            
                



    </script>
 </x-app-layout>