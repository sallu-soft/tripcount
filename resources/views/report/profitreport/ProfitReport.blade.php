
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
  
  <main class="mx-auto w-full ">
    <div class=" px-7 py-3 bg-white shadow-2xl">
      <h2 class="text-center text-3xl my-2">{{Auth::user()->name}}</h2>
        <p class="text-center text-xl my-2">{{Auth::user()->company_address}}</p>
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
    
    <table class="table-auto w-full shadow-2xl">
        <thead>
          <tr class="bg-[#0E7490] text-black">
            <th class="px-4 text-left">SL</th>
            <th class="px-4 text-left">Service Name</th>
            <th class="px-4 text-left">Number Of Sales</th>
            <th class="px-4 text-left">Buying Price</th>
            <th class="px-4 text-center">Selling Price</th>
            <th class="px-4 text-center">Profit</th>
          </tr>
        </thead>
        <tbody id="data" class="">
          @php
            $count = $buying = $selling = $total = 0;
          @endphp
          @foreach ($typeData as $index => $data)
            @php
              $count += $data['count'];
              $buying += $data['buying_price'];
              $selling += $data['selling_price'];
              $total += $data['profit'];
            @endphp
            <tr class="border-t-2 border-gray-400">
              <td class="px-4 py-1">{{$index + 1}}</td>
              <td class="px-4 py-1">{{$data['name']}}</td>
              <td class="px-4 py-1">{{$data['count']}}</td>
              <td class="px-4 py-1">{{$data['buying_price']}}</td>
              <td class="px-4 py-1 text-center">{{$data['selling_price']}}</td>
              <td class="px-4 py-1 text-center">{{$data['profit']}}</td>
              
            </tr>
          @endforeach

          <tr class="bold-row border-t-2 border-gray-600">
            <td class="px-2 py-1"></td>
            <td class="px-2 py-1">Total</td>
            <td class="px-2 py-1">{{ $count }}</td>
            <td class="px-2 py-1">{{ $buying }}</td>
            <td class="px-2 py-1 text-center">{{ $selling }}</td>
            <td class="px-2 py-1 text-center">{{ $total }}</td>
          </tr>
        
         
          
          </tbody>
      </table>
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
