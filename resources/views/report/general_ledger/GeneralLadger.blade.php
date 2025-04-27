<!Doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
  {{-- <script src="https://cdn.tailwindcss.com"></script>
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
  </script> --}}
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Optional: Include any other necessary styles or fonts -->
  <script src="https://cdn.tailwindcss.com"></script>
  {{-- <style>
    .hide-scroll-bar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    .hide-scroll-bar::-webkit-scrollbar {
      display: none;
    }
  </style> --}}
</head>

<body class="flex bg-white">
  
  <main class="flex-1 mx-auto text-sm bg-white py-2 w-full">
  
   <div class="px-2">
        <h2 class="text-center font-semibold text-2xl my-2">General Ledger</h2>
        <div class="flex items-center justify-between mb-2">
            <div class="text-lg">
                <h2 class="font-semibold">Account Name : {{$holdername}}</h2>
                <p><span class="font-semibold">Period Date :</span> {{$start_date}} to {{$end_date}} </p>
            </div>
            <div class="flex items-center">
               
                <div class="mb-8 max-w-[380px]">
                    <h2 class="font-bold text-lg">{{Auth::user()->name}}</h2>
                    <p>{{Auth::user()->company_address}}</p>
                </div>
            </div>
        </div>
        <table class="table-auto w-full table-stripe  text-sm px-1 my-1 border-collapse border [&_th,&_td]:px-4 [&_th,&_td]:py-2 ">
          {{-- --}}
            <thead class="">
              <tr class="border-y-2 border-black">
                <th class="text-start">Date</th>
                <th class="text-start">Ticket No</th>
                <th class="text-start">Flight Date</th>
                <th class="text-start">Details</th>
                <th class="text-start">Debit</th>
                <th class="text-start">Credit</th>
                <th class="">Balance</th>
              </tr>
            </thead>
            <thead class="mt-4 ">
              <tr class="border-b border-black">
                <td class="py-2" colspan="4"><b>Opening balance</b></td>
                <td class="py-2"><b> </b></td>
                <td class="py-2"><b> </b></td>
                <td class="py-2" style="margin-top: 20px;"><b>{{  $opening_balance }}</b></td></tr>
            </thead>
            <tbody class="divide-y-2 ">
              
              {!! $html !!}
              <tr class="border-t border-black">
                <td colspan="3"><b>Tickets: {{ $total_ticket }}</b></td>
                <td><b>Total</b></td>
                
                <td><b>{{ $debit }}</b></td>
                <td><b>{{ $credit }}</b></td>
                <td><b>{{ $balance }}</b></td>
            </tr>
            </tbody>
            
            {{-- <tfoot class="border-t border-gray-300 px-4">
              <tr>
                  <td colspan="4">Total</td>
                  <td><b>{{ $debit }}</b></td>
                  <td><b>{{ $credit }}</b></td>
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