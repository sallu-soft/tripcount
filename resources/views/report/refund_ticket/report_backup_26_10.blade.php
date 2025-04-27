{{-- @php
    dd($refunds);   
@endphp --}}

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
  <style>
    .hide-scroll-bar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    .hide-scroll-bar::-webkit-scrollbar {
      display: none;
    }
  </style>
</head>

<body class="flex">
 
  <main class="flex-1 mx-auto max-w-7xl px-10" style="width: 90%">
  
   <div class="">
        <h2 class="text-center font-semibold text-2xl my-2">Refund Report</h2>
        <div class="flex items-center justify-between mb-2">
            <div class="text-lg">
                {{-- <h2 class="font-semibold">Account Name : {{$holdername}}</h2> --}}
                <p><span class="font-semibold">Period Date :</span> {{$start_date}} to {{$end_date}} </p>
            </div>
            <div class="flex items-center">
               
                <div class="mb-8">
                    <h2 class="font-bold text-xl">{{Auth::user()->name}}</h2>
                    <p>{{Auth::user()->company_address}}</p>
                </div>
            </div>
        </div>
        
        <table class="table-auto w-full border-y-2 table-stripe devide-2 text-sm my-1">
        
            <thead>
              <tr class="border-y-2 border-black">
                <th class="text-start">Date</th>
                {{-- <th class="text-start">Invoice No</th> --}}
                <th class="text-start">Ticket No</th>
                <th class="text-start pl-6">Passenger</th>
                @if ($showAgent != null)
                    <th class="text-start">Agent</th>
                    <th class="text-start pl-6">Agent Price</th>
                @endif
                @if ($showSupplier != null)
                    <th class="text-start">Supplier</th>
                    <th class="text-start pl-6">Supplier Price</th>
                @endif
                @if ($showProfit != null)
                    <th class="text-start pl-6">Profit</th>
                @endif
                
              </tr>
            </thead>
          
            
            <tbody class="divide-y-2">
                @foreach ($refunds as $refund)
                <tr>
                    <td>{{(new DateTime( $refund->date ))->format('d-m-Y') }}</td>
                    <td>{{ $refund->ticket_no }}</td>
                    <td class="pl-6">{{ $refund->passenger }}</td>
                    @if ($showAgent)
                        <td>{{ $refund->agent_name }}</td>
                        <td class="pl-6">{{ $refund->now_agent_fere }}</td>
                    @endif
                    @if ($showSupplier)
                        <td>{{ $refund->supplier_name }}</td>
                        <td class="pl-6">{{ $refund->now_supplier_fare }}</td>
                    @endif
                    @if ($showProfit)
                        <td class="pl-6">{{ $refund->refund_profit }}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            {{-- <tfoot>
              <tr>
                  <td colspan="4">Total</td>
                  <td><b>{{ $debit + $opening_balance_debit }}</b></td>
                  <td><b>{{ $credit + $opening_balance_credit }}</b></td>
                  <td><b>{{ $balance }}</b></td>
              </tr>
            </tfoot> --}}
          </table>
   </div>


  </main>
  <script type="text/javascript">
    function dropdown() {
      document.querySelector("#submenu").classList.toggle("hidden");
      document.querySelector("#arrow").classList.toggle("rotate-0");
    }
    dropdown();

    function openSidebar() {
      document.querySelector(".sidebar").classList.toggle("hidden");
    }
  </script>
</body>

</html>