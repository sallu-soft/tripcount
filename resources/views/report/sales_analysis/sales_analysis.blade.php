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
  
  <main class="mx-auto w-full shadow-xl">
    <div class=" px-7 py-3">
      <h2 class="text-center text-3xl my-2">SALLU AIR SERVICE</h2>
      <h2 class="text-center font-bold text-xl my-2 underline">Profit Report</h2>
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
        <table class="table-auto w-[100%] mx-auto border-2 border-gray-400 devide-2 text-md my-1">
            <thead>
                <tr class="border-y-2 border-black bg-[#00959E]">
                    <th class="text-start">SL</th>
                    <th class="text-start">Trans. Date</th>
                    <th class="text-start">Sale Amount</th>
                    <th class="text-start">Purchase Amount</th>
                    <th class="text-start">Profit Amount</th>
                    <th class="text-start">Receive Amount</th>
                    <th class="text-start">Payment Amount</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach($tableData as $index => $row)
                <tr class="text-black border-t border-2 border-gray-400">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row['date'] }}</td>
                    <td>{{ $row['salestotalAmount'] }}</td>
                    <td>{{ $row['purchasetotalAmount'] }}</td>
                    <td>{{ $row['profittotalAmount'] }}</td>
                    <td>{{ $row['receivetotalAmount'] }}</td>
                    <td>{{ $row['paymenttotalAmount'] }}</td>
                </tr>
                @endforeach
                <tr class="border-2 border-black text-black font-bold">
                    <td>Total Amount</td>
                    <td></td> <!-- No date for total -->
                    <td>{{ $totalSales }}</td>
                    <td>{{ $totalPurchase }}</td>
                    <td>{{ $totalProfit }}</td>
                    <td>{{ $totalReceive }}</td>
                    <td>{{ $totalPayment }}</td>
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
