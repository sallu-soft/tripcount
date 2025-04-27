<x-app-layout>
  {{-- <style>
    ::-webkit-scrollbar {
width: 15px; /* Adjust this value to your preference */
}

/* Track */
::-webkit-scrollbar-track {
background: rgb(241, 238, 238); /* Or any other color you prefer */
}

/* Handle */
::-webkit-scrollbar-thumb {
background: #7CB0B2; /* Or any other color you prefer */
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
background: #555; /* Or any other color you prefer */
}
  </style> --}}
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    
    <div class="grid grid-cols-3 md:grid-cols-5  gap-y-3 gap-x-4">
        <a href={{route('ticket.view')}} class="text-white text-center bg-[#84857C] font-bold py-3 px-4 rounded hover:no-underline">
          New Ticket Invoice
        </a>
        <a href={{route('order.view')}} class="hover:no-underline text-center text-white bg-[#4E4E4E] font-bold py-3 px-4 rounded">
          Service Invoice Type
        </a>
        <a href={{route('receive.index')}} class="text-white text-center  bg-[#6A764D] font-bold py-3 px-4 rounded hover:no-underline">
          Receive
        </a>
        <a href={{route('payment.form')}} class="text-white bg-[#A58A4C] font-bold py-3 px-4 rounded hover:no-underline text-center">
          Payment
          {{-- sales report --}}
        </a>
        <a href={{route('profit_loss.view')}} class="text-white bg-[#6A764D] font-bold py-3 px-4 rounded hover:no-underline text-center">
          Profit & Loss
        </a>
        <a href={{route('flight_ticket')}} class="text-center hover:no-underline text-white bg-[#576335] font-bold py-3 px-4 rounded">
          Flight Report
        </a>
        <a href={{route('general_ledger')}}  class="text-white bg-[#7a4b2b] font-bold py-3 px-4 rounded text-center hover:no-underline">
          General Ledger
        </a>
        <a href={{route('cash_book.view')}} class="text-white text-center hover:no-underline bg-[#A58A4C] font-bold py-3 px-4 rounded">
          Cash Book Report
        </a>
        <a href={{route('bank_book.view')}} class="text-center hover:no-underline text-white bg-[#84857C] font-bold py-3 px-4 rounded">
          Bank Book Report
        </a>
        <a href={{route('expanditure.view')}} class="text-center hover:no-underline text-white bg-[#A58A4C] font-bold py-3 px-4 rounded">
          Expanditure
        </a>
        <a href={{route('sales_ticket')}} class="text-center hover:no-underline text-white bg-[#344d0e] font-bold py-3 px-4 rounded">
          Sales Report
        </a>
        <a href={{route('due_reminder')}} class="text-center hover:no-underline text-white bg-[#574816] font-bold py-3 px-4 rounded">
          Deu Reminder
        </a>
        <a href={{route('sales_exicutive_stuff')}} class="text-center hover:no-underline text-white bg-[#4f595d] font-bold py-3 px-4 rounded">
         Staff Sales Report
        </a>
        <a href={{route('dailystate.view')}} class="text-center hover:no-underline text-white bg-[#7a4b2b] font-bold py-3 px-4 rounded">
          Day Book
        </a>
        <a href={{route('moneytransfer.view')}} class="text-center hover:no-underline text-white bg-[#5c6e70] font-bold py-3 px-4 rounded">
          Contra
        </a>
        
      </div>
     
      <div class="grid gap-4 grid-cols-2 mt-2">
        

        @if(!session('employee'))
            <div class="mt-2 rounded-lg bg-white shadow-lg   animate__wobble">
                <h2 class="px-3 bg-gray-200 py-2 text-xl text-black border-b border-gray-200 font-semibold">
                    Total Cash In Bank: <span style="color: blue;">{{$total_amount}}</span>
                </h2>
                <div class="bg-white p-2 overflow-y-scroll h-[400px] overflow-hidden">
                    <table class="my-5 text-sm text-black border table table-hover">
                        <thead>
                            <tr class="border-b bg-[#7CB0B2]">
                                <th class="w-6/12 px-4 py-1 text-left text-gray-700 font-medium">Bank</th>
                                <th class="w-4/12 px-4 py-1 text-left text-gray-700 font-medium">Description</th>
                                <th class="w-2/12 px-4 py-1 text-left text-gray-700 font-medium">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $bank)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2 text-gray-700">{{$bank->name}}</td>
                                    <td class="px-4 py-2 text-gray-700">{{$bank->description}}</td>
                                    <td class="px-4 py-2 text-gray-700">{{$bank->amount}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2 text-gray-700 text-md font-semibold">Total</td>
                                    <td class="px-4 py-2 text-gray-700"></td>
                                    <td class="px-4 py-2 text-gray-700 text-md font-semibold">{{$total_amount}}</td>
                                </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endif
    
        <div class="mt-2 rounded-lg bg-white shadow-lg   animate__bounce">
          <h2 class="px-3 bg-gray-200 py-2 text-xl text-black border-b border-gray-200 font-semibold">
              Total Receivables: <span style="color: blue;">{{$total_receive}}</span>
          </h2>
                  <div class="bg-white p-2 overflow-y-scroll h-[400px] overflow-hidden">
            <table class="  my-5 text-sm text-black border table table-hover" >
              <thead>
                <tr class="border-b bg-[#7CB0B2]">
                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Date</th>
                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Invoice Number</th>

                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Name</th>
                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Method</th>
                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Amount</th>
                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Remarks</th>

                </tr>
              </thead>
              <tbody class="">

                @foreach($receives as $receive)
                  <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 text-gray-700">{{ (new DateTime($receive->date))->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 text-gray-700">{{$receive->invoice}}</td>

                    <td class="px-4 py-2 text-gray-700">{{$receive->name}}</td>
                    <td class="px-4 py-2 text-gray-700">{{$receive->method}}</td>

                    <td class="px-4 py-2 text-gray-700">{{$receive->amount}}</td>

                    <td class="px-4 py-2 text-gray-700">{{$receive->remark}}</td>
                  </tr>
                @endforeach
              
              </tbody>
            </table>
          </div>
        </div>
        
        <div class="mt-2 rounded-lg bg-white shadow-lg">
          <h2 class="px-3 bg-gray-200 py-2 text-xl text-black border-b border-gray-200 font-semibold">
              Total Payables: <span style="color: blue;">{{$total_pay}}</span>
          </h2>
                  <div class="bg-white p-2 overflow-y-scroll h-[400px] overflow-hidden">
            <table class="  my-5 text-sm text-black border table table-hover" >
              <thead>
                <tr class="border-b bg-[#7CB0B2]">
                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Date</th>
                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Invoice Number</th>

                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Name</th>
                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Method</th>
                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Amount</th>
                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Remarks</th>

                </tr>
              </thead>
              <tbody class="">

                @foreach($payments as $payment)
                  <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 text-gray-700">{{ (new DateTime($payment->date))->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 text-gray-700">{{$payment->invoice}}</td>

                    <td class="px-4 py-2 text-gray-700">{{$payment->name}}</td>
                    <td class="px-4 py-2 text-gray-700">{{$payment->method}}</td>

                    <td class="px-4 py-2 text-gray-700">{{$payment->amount}}</td>

                    <td class="px-4 py-2 text-gray-700">{{$payment->remark}}</td>
                  </tr>
                @endforeach
              
              </tbody>
            </table>
          </div>
        </div>
        {{-- <div class="mt-2 rounded-lg bg-white shadow-lg">
          <h2 class="px-3 bg-gray-200 py-2 text-xl text-black border-b border-gray-200 font-semibold">
              Sales (Current Billing): <span style="color: blue;">{{$total_pay}}</span>
          </h2>
          <div class="bg-white p-2 h-[400px]">
            <div class="grid grid-cols-2 gap-2">
              <div class=" h-[185px] rounded-lg flex items-center flex-col">
                <div class="font-semibold bg-[#7CB0B2] w-full text-center">Total Sales Ticket </div>
                <div class="font-bold text-lg text-blue-800 mt-10">{{$total_month_sales_ticket}}</div>
                
              </div>
              <div class=" h-[185px] rounded-lg flex items-center flex-col ">
                <div class="font-semibold bg-[#7CB0B2] w-full text-center">Today's Sales Ticket </div>
                <div class="font-bold text-lg text-blue-800 mt-10">{{$total_today_sales_ticket}}</div>
              </div>
              <div class=" h-[185px] rounded-lg flex items-center flex-col ">
                <div class="font-semibold bg-[#7CB0B2] w-full text-center">Total Sales Visa </div>
                <div class="font-bold text-lg text-blue-800 mt-10">{{$total_month_sales_visa}} </div>
              </div>
              <div class=" h-[185px] rounded-lg flex flex-col items-center ">
                <div class="font-semibold bg-[#7CB0B2] w-full text-center ">Today's Sales Visa </div>
                <div class="font-bold text-lg text-blue-800 mt-10">{{$total_today_sales_visa}} </div>
              </div>
              
            </div>
          </div>
        </div> --}}
        <div class=" rounded-lg bg-gradient-to-br from-gray-50 to-white shadow-xl">
          <h2 class="px-5 bg-gradient-to-r from-blue-100 to-gray-200 py-3 text-2xl text-blue-900 border-b border-gray-300 font-semibold rounded-t-lg">
            Sales (Current Billing): <span style="color: #2563EB;">{{ $total_pay }}</span>
          </h2>
          
          <div class="bg-white h-[400px]">
           
            <div class="container mx-auto py-6">
              <div class="grid grid-cols-2 text-center border-gray-300">
                
                <!-- 20000+ Graduates Students -->
                <div class="flex h-[170px] flex-col items-center  border-r justify-center border-b border-gray-300">
                  <h2 class="text-teal-600 text-4xl font-extrabold"> {{ $total_month_sales_ticket }}</h2>
                  <p class="text-gray-700 text-lg font-semibold">Total Sales Ticket</p>
                </div>
                
                <!-- 350+ Employees & Academics -->
                <div class="flex h-[170px] flex-col items-center border-b justify-center border-gray-300">
                  <h2 class="text-red-500 text-4xl font-extrabold">{{ $total_today_sales_ticket }}</h2>
                  <p class="text-gray-700 text-lg font-semibold">Today Sales Ticket</p>
                </div>
                
                <!-- 25+ Programmes -->
                <div class="flex h-[170px] flex-col items-center border-r justify-center border-gray-300">
                  <h2 class="text-orange-500 text-4xl font-extrabold">{{ $total_month_sales_visa }}</h2>
                  <p class="text-gray-700 text-lg font-semibold">Total Sales Visa</p>
                </div>
                
                <!-- 3000+ Students Per Year Admission -->
                <div class="flex h-[170px] flex-col items-center justify-center">
                  <h2 class="text-purple-600 text-4xl font-extrabold">{{ $total_today_sales_visa }}</h2>
                  <p class="text-gray-700 text-lg font-semibold">Today Sales Visa</p>
                </div>
            
              </div>
            </div>
          </div>
        </div>
        
        
        
      </div>
      <div class="mt-2 rounded-lg bg-white shadow-lg">
        <h2 class="px-3 bg-gray-200 py-2 text-xl text-black border-b border-gray-200 font-semibold">Flight Alert</h2>
        <div class="bg-white p-2 overflow-y-scroll h-[400px] overflow-hidden">
          <table class="  my-5 text-sm text-black border table table-hover" >
            <thead>
              <tr class="border-b bg-[#7CB0B2]">
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Invoice Date</th>
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Ticket No</th>
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Airline</th>
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Passenger</th>
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Flight Date</th>
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Agent</th>
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Supplier</th>

                {{-- <th class="w-1/6 px-4 py-2 text-left text-gray-700 font-medium">Supplier</th> --}}
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Price</th>

                {{-- <th class="w-1/6 px-4 py-2 text-left text-gray-700 font-medium">Supplier Price</th> --}}
              
              </tr>
            </thead>
            <tbody>

              @foreach($closetickets as $ticket)
              <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2 text-gray-700">{{ (new DateTime($ticket->invoice_date))->format('d/m/Y') }}</td>
                <td class="px-4 py-2 text-gray-700">{{$ticket->ticket_code}}/{{$ticket->ticket_no}}</td>
                <td class="px-4 py-2 text-gray-700">{{$ticket->airline_name}}/{{$ticket->airline_code}}</td>

                <td class="px-4 py-2 text-gray-700">{{$ticket->passenger}}</td>

                <td class="px-4 py-2 text-gray-700">{{ (new DateTime($ticket->flight_date))->format('d/m/Y') }}</td>
                <td class="px-4 py-2 text-gray-700">{{$ticket->agent}}</td>
                <td class="px-4 py-2 text-gray-700">{{$ticket->supplier}}</td>

                {{-- <td class="px-4 py-2 text-gray-700">{{$ticket->supplier}}</td> --}}
                <td class="px-4 py-2 text-gray-700">{{$ticket->agent_price}}</td>
                {{-- <td class="px-4 py-2 text-gray-700">{{$ticket->supplier_price}}</td> --}}

              
              
              </tr>
              @endforeach
            
            </tbody>
          </table>
        </div>
      </div>
      <script type="text/javascript">
        $('#flight_table').DataTable();
    </script>

</x-app-layout>
