@php
$totalSales = 0;
$totalPurchase = 0;
$totalProfit = 0;
$totalReceive = 0;
$totalPayment = 0;
foreach($tableData as $row) {
    $totalSales += $row['salestotalAmount'];
    $totalPurchase += $row['purchasetotalAmount'];
    $totalProfit += $row['profittotalAmount'];
    $totalReceive += $row['receivetotalAmount'];
    $totalPayment += $row['paymenttotalAmount'];
}
@endphp
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
      .bold-row td {
        font-weight: bold;
    }

  </style>
</head>

<body class="flex ">
  
  <main class="mx-auto w-[95%] md:w-[980px] ">
    <div class=" px-7 py-3 shadow-2xl">
      <h2 class="text-center text-3xl my-2">{{Auth::user()->name}}</h2>
      <h2 class="text-center font-bold text-xl my-2 underline">Sales Analysis Report</h2>
      <div class="flex items-center w-[35%] mx-auto justify-between mb-2">
          <div class="text-md">
              <!-- <h2 class="font-semibold">Company Name : Sallu Air Service</h2>
              <p><span class="font-semibold">Period Date :</span> 14-09-2023 to 15-09-2023 </p> -->
              <p>From Date : <span class="font-semibold">{{$start_date}}</span></p>
          </div>
          <div class="text-md">
              <p>To Date : <span class="font-semibold">{{$end_date}}</span></p>
              
          </div>
          
      </div>
      {{-- <p class="text-xl font-semibold">(Opening Balance : 100,000)</p> --}}
      </div>

      <div>
        <table class="table-auto w-full mx-auto border-2 border-gray-400 devide-2 text-sm my-1">
            <thead>
                <tr class="border-y-2 border-black bg-cyan-700 text-white">
                    <th class="text-start px-2">SL</th>
                    <th class="text-start">Trans. Date</th>
                    <th class="text-start">Sale Amount</th>
                    <th class="text-start">Purchase Amount</th>
                    <th class="text-start">Profit Amount</th>
                    <th class="text-start">Receive Amount</th>
                    <th class="text-start">Payment Amount</th>
                </tr>
            </thead>
            <tbody class="divide-y-2">
                @foreach($tableData as $index => $row)
                <tr class="text-black ">
                    <td class="px-2 py-2">{{ $index + 1 }}</td>
                    <td class="py-2">{{ $row['date'] }}</td>
                    <td class="py-2">{{ $row['salestotalAmount'] }}</td>
                    <td class="py-2">{{ $row['purchasetotalAmount'] }}</td>
                    <td class="py-2">{{ $row['profittotalAmount'] }}</td>
                    <td class="py-2">{{ $row['receivetotalAmount'] }}</td>
                    <td class="py-2">{{ $row['paymenttotalAmount'] }}</td>
                </tr>
                @endforeach
                <tr class="text-black font-bold">
                    <td class="px-2 py-2">Total Amount</td>
                    <td class="py-2"></td> <!-- No date for total -->
                    <td class="py-2">{{ $totalSales }}</td>
                    <td class="py-2">{{ $totalPurchase }}</td>
                    <td class="py-2">{{ $totalProfit }}</td>
                    <td class="py-2">{{ $totalReceive }}</td>
                    <td class="py-2">{{ $totalPayment }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    
 </main>
  <!-- <script type="text/javascript">
    
    const rows = document.querySelectorAll('#data tr');
    for (let i = 0; i < rows.length; i += 2) {
      rows[i].classList.add('bg-gray-200');
    }
  </script> -->
  <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
</body>

</html>
