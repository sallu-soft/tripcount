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
   
  </style>
</head>

<body class="flex">
  
  <main class=" mx-auto w-[95%] bg-white shadow-lg py-6">
   
    <div class=" px-7 py-3 flex flex-col gap-y-2 shadow-2xl">
        <h2 class="text-center font-medium text-2xl ">Company Name : {{Auth::user()->name}}</h2>
        <p class="text-center text-lg">Company Address : {{Auth::user()->company_address}}</p>
        <p class="text-center font-semibold text-xl underline">Report: Income Statement</p>
        <p class="text-center font-semibold text-xl">Form Date : {{$start_date}}   To Date : {{$end_date}}</p>
        
    </div>
    <div class="flex mb-10">
    <table class="table-auto w-full ">
        <thead>
          <tr class="bg-[#0E7490] text-black flex justify-between">
            <th class="px-4 py-2 text-left">Particular</th>
            <th class="px-4 py-2 text-left">Amount</th>
           
          </tr>
        </thead>
        <tbody id="data" class="text-lg px-2 border ">
          <tr class="flex justify-between px-2 border-y">
            <td class="px-2 py-2">Ticket Purchase</td>
            <td class="px-2 py-2">{{$ticket_total_purchase}}</td>
          </tr>
          <tr class="flex justify-between px-2 border-y">
            <td class="px-2 py-2">Visa Purchase</td>
            <td class="px-2 py-2">{{$order_total_purchase}}</td>
          </tr>
          <tr class="flex justify-between px-2 border-y">
            <td class="px-2 py-2">Direct Expensess</td>
            <td class="px-2 py-2">{{$total_purchase}}</td>
            
          </tr>
          <tr class="flex justify-between px-2">
            <td class="px-2 py-2"></td>
            <td class="px-2 py-2">{{$total_purchase}}</td>
            
          </tr>
          
          
          </tbody>
      </table>
    <table class="table-auto w-full">
        <thead>
          <tr class="bg-[#0E7490] text-white flex justify-between">
            <th class="px-4 py-2 text-left">Particular</th>
            <th class="px-4 py-2 text-left">Amount</th>
           
          </tr>
        </thead>
        <tbody id="data" class="text-lg border-y">
          <tr class="flex justify-between px-2 border-y">
            <td class="px-2 py-2">Ticket Sell</td>
            <td class="px-2 py-2">{{$ticket_total_sell}}</td>
          </tr>
          <tr class="flex justify-between px-2 border-y">
            <td class="px-2 py-2">Visa Sell</td>
            <td class="px-2 py-2">{{$order_total_sell}}</td>
          </tr>
          <tr class="flex justify-between px-2 border-y">
            <td class="px-2 py-2">Income</td>
            <td class="px-2 py-2">{{$total_sell}}</td>
            
          </tr>
          <tr class="flex justify-between px-2">
            <td class="px-2 py-2"></td>
            <td class="px-2 py-2">{{$total_sell}}</td>
            
          </tr>
          
          
          </tbody>
      </table>
    </div>
    <div class="w-[50%] flex justify-end">
    <p class="font-bold text-xl">Gross Profit : {{$profit}}</p>
    <p class="font-medium text-lg"></p>
    </div>
  </main>
  <script type="text/javascript">
    
    
  </script>
  <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
</body>

</html>