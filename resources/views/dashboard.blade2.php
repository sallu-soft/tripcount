<x-app-layout>
  <style>
    ::-webkit-scrollbar {
width: 5px; /* Adjust this value to your preference */
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
  </style>
    
    <div class="grid grid-cols-3 md:grid-cols-5  gap-y-3 gap-x-4">
        <a href={{route('ticket.view')}} class="text-white text-center bg-[#84857C] font-bold py-3 px-4 rounded hover:no-underline">
          New Ticket Invoice
        </a>
        <a href={{route('order.view')}} class="hover:no-underline text-center text-white bg-[#4E4E4E] font-bold py-3 px-4 rounded">
          New Invoice Type
        </a>
        <a href={{route('receive.index')}} class="text-white text-center  bg-[#6A764D] font-bold py-3 px-4 rounded hover:no-underline">
          Receive
        </a>
        <a href={{route('payment.index')}} class="text-white bg-[#A58A4C] font-bold py-3 px-4 rounded hover:no-underline text-center">
          Payment
          {{-- sales report --}}
        </a>
        <a href={{route('profit_loss.view')}} class="text-white bg-[#6A764D] font-bold py-3 px-4 rounded hover:no-underline text-center">
          Profit & Loss
        </a>
        <a href={{route('refund_ticket')}} class="text-center hover:no-underline text-white bg-[#576335] font-bold py-3 px-4 rounded">
          Refund
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
        <a href={{route('stuff_details.view')}} class="text-center hover:no-underline text-white bg-[#A58A4C] font-bold py-3 px-4 rounded">
          HR
        </a>
        <a href={{route('sales_ticket')}} class="text-center hover:no-underline text-white bg-[#344d0e] font-bold py-3 px-4 rounded">
          Sales Report
        </a>
        <a href={{route('due_reminder')}} class="text-center hover:no-underline text-white bg-[#574816] font-bold py-3 px-4 rounded">
          Deu Reminder
        </a>
        <a href={{route('sales_exicutive_stuff')}} class="text-center hover:no-underline text-white bg-[#4f595d] font-bold py-3 px-4 rounded">
          Sales Exicutive Report
        </a>
        <a href={{route('dailystate.view')}} class="text-center hover:no-underline text-white bg-[#7a4b2b] font-bold py-3 px-4 rounded">
          Day Book
        </a>
        <a href={{route('moneytransfer.view')}} class="text-center hover:no-underline text-white bg-[#5c6e70] font-bold py-3 px-4 rounded">
          Contra
        </a>
        
      </div>
      {{-- <div class="grid grid-cols-2">
        <div class="bg-white p-2 shadow-lg mt-2">
          <table class=" my-5 text-sm text-black border  overflow-hidden table table-hover" id="flight_table">
            <thead>
              <tr class="border-b bg-[#7CB0B2]">
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Invoice Date</th>
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Ticket No</th>
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Airline</th>
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Passenger</th>
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Flight Date</th>
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Agent</th>

                
                <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Price</th>

              
              
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

               
                <td class="px-4 py-2 text-gray-700">{{$ticket->agent_price}}</td>
             

              
              
              </tr>
              @endforeach
            
            </tbody>
          </table>
        </div>
      </div> --}}
      <div class="grid gap-4 grid-cols-2">
        <div class="mt-2 rounded-lg bg-white shadow-lg">
          <h2 class="px-2 py-1 text-xl  text-black border-b border-gray-200 font-semibold">Flight Alert</h2>
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
  
                  {{-- <td class="px-4 py-2 text-gray-700">{{$ticket->supplier}}</td> --}}
                  <td class="px-4 py-2 text-gray-700">{{$ticket->agent_price}}</td>
                  {{-- <td class="px-4 py-2 text-gray-700">{{$ticket->supplier_price}}</td> --}}
  
                
                
                </tr>
                @endforeach
              
              </tbody>
            </table>
          </div>
        </div>

        <div class="mt-2 rounded-lg bg-white shadow-lg">
          <h2 class="px-2 py-1 text-xl text-black border-b border-gray-200 font-semibold">
              Total Cash In Bank: <span style="color: rgb(0 149 158 / 1);">{{$total_amount}}</span>
          </h2>
                  <div class="bg-white p-2 overflow-y-scroll h-[400px] overflow-hidden">
            <table class="  my-5 text-sm text-black border table table-hover" >
              <thead>
                <tr class="border-b bg-[#7CB0B2]">
                  {{-- <th class="w-1/12 px-4 py-1 text-left text-gray-700 font-medium">Date</th> --}}
                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Bank</th>

                  <th class="w-1/6 px-4 py-1 text-left text-gray-700 font-medium">Description</th>
                  <th class="w-1/6 px-4 py-1 text-end pr-14 text-gray-700 font-medium">Amount</th>

                </tr>
              </thead>
              <tbody class="">

                @foreach($transactions as $bank)
                  <tr class="border-b hover:bg-gray-50">
                    {{-- <td class="px-4 py-2 text-gray-700">{{ (new DateTime($bank->updated_at))->format('d/m/Y') }}</td> --}}
                    <td class="px-4 py-2 text-gray-700">{{$bank->name}}</td>

                    <td class="px-4 py-2 text-gray-700">{{$bank->description}}</td>
                 
                    <td class="px-4 py-2 text-gray-700 pr-14 text-end">{{$bank->amount}}</td>

                  </tr>
                @endforeach
              
              </tbody>
            </table>
          </div>
        </div>

        <div class="mt-2 rounded-lg bg-white shadow-lg">
          <h2 class="px-2 py-1 text-xl text-black border-b border-gray-200 font-semibold">
              Total Receivables: <span style="color: rgb(0 149 158 / 1);">{{$total_receive}}</span>
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
          <h2 class="px-2 py-1 text-xl text-black border-b border-gray-200 font-semibold">
              Total Payables: <span style="color: rgb(0 149 158 / 1);">{{$total_pay}}</span>
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
        
      </div>
      <script type="text/javascript">
        $('#flight_table').DataTable();
    </script>

</x-app-layout>
