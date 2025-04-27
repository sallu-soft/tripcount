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

<body class="flex ">
  
  <main class="mx-auto w-full bg-white">
   
    <div class=" px-7 py-3 shadow-2xl">
      <h2 class="text-center text-3xl my-2">{{Auth::user()->name}}</h2>
      <p class="text-center text-xl my-2">{{Auth::user()->company_address}}</p>
        <h2 class="text-center font-bold text-xl my-2 underline">Bank Report</h2>
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
          <tr class="bg-[#0E7490] text-white">
            <th class="px-4 text-left">SL</th>
            <th class="px-4 text-left">Date</th>
            <th class="px-4 text-left">Account Name</th>
            <th class="px-4 text-left">Narration</th>
            <th class="px-4 text-center">Cash In</th>
            <th class="px-4 text-center">Cash Out</th>
          </tr>
        </thead>
        <tbody id="data" class="divide-y divide-gray-400">
          @php
            $balance = $cash_in = $cash_out = 0;
          @endphp

          @foreach ($datas as $index => $data)
              @php
                $balance += $data->amount;
              @endphp
              @if ($data->getTable() == 'receive')
                @php
                  $cash_in += $data->amount;
                @endphp
                  <tr>
                      <td class="px-4 py-1">{{ $index + 1 }}</td>
                      <td class="px-2 py-1">{{ $data->date }}</td>
                      <td class="px-2 py-1">{{ $data->name }}</td>
                      <td class="px-2 py-1">Ref No: {{ $data->invoice }} 
                          Bank Name: {{ $data->method }}</td>
                      <td class="px-2 py-1 text-center">{{ $data->amount }}</td>
                      <td class="px-2 py-1 text-center"></td>
                  </tr>
              @else
                @php
                  $cash_out += $data->amount;
                @endphp
                  <tr>
                      <td class="px-4 py-1">{{ $index + 1 }}</td>
                      <td class="px-2 py-1">{{ $data->date }}</td>
                      <td class="px-2 py-1">{{ $data->name }}</td>
                      <td class="px-2 py-1">Ref No: {{ $data->invoice }} 
                          Bank Name: {{ $data->method }}</td>
                      <td class="px-2 py-1 text-center"></td>
                      <td class="px-2 py-1 text-center">{{ $data->amount }}</td>
                  </tr>
              @endif
          @endforeach
          
          <tr class="!bg-white font-bold ">
            <td class="px-2 py-1"></td>
            <td class="px-2 py-1"></td>
            <td class="px-2 py-1"></td>
            <td class="px-2 py-1">Total</td>
            <td class="px-2 py-1 text-center"><?php echo $cash_in ?></td>
            <td class="px-2 py-1 text-center"><?php echo $cash_out ?></td>
            
          </tr>
          <tr class="!bg-white font-bold ">
            <td class="px-2 py-1"></td>
            <td class="px-2 py-1"></td>
            <td class="px-2 py-1"></td>
            <td class="px-2 py-1"> Balance</td>
            <td class="px-2 py-1 text-center"></td>
            <td class="px-2 py-1 text-center"><?php echo $cash_in - $cash_out ?></td>
            
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
