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
  
  <main class="flex-1 mx-auto max-w-7xl px-10">
   <!-- <div class="buttons justify-end flex gap-3 shadow-lg p-5 ">
      <button class="text-white bg-pink-600 font-bold text-md py-2 px-4">Send</button>
      <button class="text-white bg-blue-700 font-bold text-md py-2 px-4">Print</button>
      <button class="text-white bg-green-600 font-bold text-md py-2 px-4 ">ADD NEW INVOICE</button>
      <button class="text-white bg-black font-bold text-md py-2 px-4">GO BACK</button>
   </div> -->
   <div class="">
        <h2 class="text-center font-bold text-3xl my-2">Trial Balance</h2>
        <h2 class="text-center font-bold text-xl my-2"> Account : All</h2>
        <div class="flex items-center justify-between mb-2">
            <div class="text-lg">
                <h2 class="font-semibold">Company Name : {{Auth::user()->name}}</h2>
                <p><span class="font-semibold">Period Date :</span> {{$start_date}} to {{$end_date}} </p>
            </div>
            <div class="flex items-center">
               
                
            </div>
        </div>
        <table class=" table-auto w-full border border-black devide-2 text-lg my-1">
            <thead class="py-2">
              <tr class=" bg-cyan-700 py-4 text-white">
                <th class="text-start px-2 py-2 w-[70%]">Particular</th>
                <th class="text-center px-2 py-2">Debit</th>
                <th class="text-end px-2 py-2">Credit</th>
               
                
              </tr>
            </thead>
            <tbody class="divide-y divide-black">
              {{-- <tr class="">
               <td class="w-[70%] px-2 py-2">Cash in Hand</td>
               <td class="text-end px-2 py-2">{{$totalincash_debit}}</td>
               <td class="text-end px-2 py-2">{{$totalincash_credit}}</td>
            
              </tr> --}}
              <tr class="">
               <td class="w-[70%] px-2 py-2">Ticket Sales</td>
               <td class="text-center px-2 py-2">{{$totalTicketAgentPrice}}</td>
               <td class="text-end px-2 py-2">0</td>
            
              </tr>
              <tr class="">
               <td class="w-[70%] px-2 py-2">Ticket Purchase</td>
               <td class="text-center px-2 py-2">0</td>
               <td class="text-end px-2 py-2">{{$totalTicketSupplierPrice}}</td>
            
              </tr>
              {{-- <tr class="">
               <td class="w-[70%] px-2 py-2">Bank</td>
               <td class="text-end px-2 py-2">{{$totalinbank_debit}}</td>
               <td class="text-end px-2 py-2">{{$totalinbank_credit}}</td>
            
              </tr> --}}
              <tr class="">
               <td class="w-[70%] px-2 py-2">Visa Sales</td>
               <td class="text-center px-2 py-2">{{$totalOrderAgentPrice}}</td>
               <td class="text-end px-2 py-2">0</td>
            
              </tr>
              <tr class="">
               <td class="w-[70%] px-2 py-2">Visa Purchase</td>
               <td class="text-center px-2 py-2">0</td>
               <td class="text-end px-2 py-2">{{$totalOrderSupplierPrice}}</td>
            
              </tr>
              @foreach ($totals as $method => $total)
                  <tr>
                      <td class="w-[70%] px-2 py-2">{{ $method }}</td>
                      <td class="text-center px-2 py-2">{{ $total['debit'] }}</td>
                      <td class="text-end px-2 py-2">{{ $total['credit'] }}</td>
                  </tr>
              @endforeach
              @foreach ($agents as $agent)
                  <tr>
                      <td class="w-[70%] px-2 py-2">{{ $agent['name'] }}<span style="color:red">(Agent)</span></td>
                      <td class="text-center px-2 py-2">{{ $agent['amount'] }}</td>
                      <td class="text-end px-2 py-2">0</td>
                  </tr>
              @endforeach
              @foreach ($suppliers as $agent)
                  <tr>
                      <td class="w-[70%] px-2 py-2">{{ $agent['name'] }}<span style="color:red">(Supplier)</span></td>
                      <td class="text-center px-2 py-2">0</td>
                      <td class="text-end px-2 py-2">{{ $agent['amount'] }}</td>
                  </tr>
              @endforeach
              <tr class=" text-black font-bold">
               
               <td class="w-[70%] text-lg px-2 py-2">Total</td>
               <td class="text-center px-2 py-2">{{$totalDebit}}</td>
               <td class="text-end px-2 py-2">{{$totalCredit}}</td>
              </tr>
            
            </tbody>
          </table>
   </div>


  </main>
 
</body>

</html>