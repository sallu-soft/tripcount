<x-app-layout>
    <style>
        .main{
            background-color:"white";
        }
    </style>
    <main class="flex-1 m-4 mx-auto max-w-[1060px] px-10">
        <div class="buttons justify-end flex gap-3 shadow-lg p-5 ">
           <button class="text-white bg-red-600 font-bold text-md py-2 px-4" id="printBtn">Print</button>
           
           <button class="text-white bg-black font-bold text-md py-2 px-4" onclick="goBack()">GO BACK</button>
        </div>
         <div class="my-4 bg-white shadow-lg p-5" id="printSection" >
           <div class="flex justify-between items-center py-5">
               <div class=""><img src="{{ url(Auth::user()->company_logo) }}" alt="logo" width="220px" height="200px"/></div>
               
               <div class="w-[370px]">
                <h3 class="company-name font-bold text-3xl ">{{Auth::user()->name}}</h3>
                <p class="company-address text-lg font-medium">{{Auth::user()->company_address}}</p>
                <p class="company-phone text-lg font-medium">Tel : {{Auth::user()->mobile_no}}</p>
                <p class="company-email text-lg font-medium">Email : {{Auth::user()->email}}</p>
            </div>
           </div>
           <hr class="mb-3 h-[3px] bg-gray-400 border-none"/>
           <div class="font-bold text-3xl text-center">INVOICE DETAILS</div>
           <div class="flex justify-between items-center text-lg mt-6">
             <div>
               <p><span class="font-bold">Date</span>: {{ \Carbon\Carbon::now()->format('d/m/y') }}</p>
               <p><span class="font-bold">Service Type : </span> {{$type}}</p>
             </div>
             <div class="max-w-[360px]">
               <h3 class="font-bold text-xl">Agent Details</h3>
               <p><span class="font-semibold">Name:</span> {{$agent->name}}</p>
               <p> <span class="font-semibold">Address:</span>  {{$agent->address}}</p>
               <p><span class="font-semibold">Email :</span>  {{$agent->email}}</p>
               <p><span class="font-semibold">Mob :</span>  {{$agent->phone}}</p>
             </div>
           </div>
           <div class="w-full overflow-hidden mt-7">
             <table class="min-w-full bg-white border rounded shadow overflow-hidden">
               <thead class="text-black bg-gray-300">
                 <tr class="bg-gray-300">
                   <td class="py-1 font-bold text-md px-4">Invoice No</td>
                   <td class="py-1 font-bold text-md px-4">Details</th>
                   <td class="py-1 font-bold text-md px-4 text-center">Total Balance</th>
                   <!-- Add more columns as needed -->
                 </tr>
               </thead>
               <tbody class="text-gray-700 border-black border-b-2">
                 <tr>
                   <td class="py-2 px-4">{{$order->invoice}}</td>
                   <td class="py-2 px-4">
                     <p>Pax Name: {{$order->name}}</p>
                     <p>Passport No : {{$order->passport_no}} 
                     </p>
                     <p>Country : {{$order->country}} </p>
                     
                     <p>Remarks: {{$order->remark}}</p>
                   </td>
                   <td class="py-2 px-4 text-center">{{$order->contact_amount}}</td>
                   <!-- Add more rows and data as needed -->
                 </tr>
               </tbody>
               {{-- <tfoot>
                 <tr>
                   <td class="py-2 px-4"></td>
                   <td class="py-2 px-4"></td>
                   <td class="py-2 px-4 bg-red-200">
                     Total
                   </td>
                   <td class="py-2 px-4 bg-red-200">{{$order->agent_price}}</td>
                   <!-- Add more rows and data as needed -->
                 </tr>
                 <tr class="">
                   <td class="py-2 px-4"></td>
                   <td class="py-2 px-4"></td>
                   <td class="py-2 px-4 bg-gray-200">
                     Net Amount
                   </td>
                   <td class="py-2 px-4 bg-gray-200">{{$order->agent_price}}</td>
                   <!-- Add more rows and data as needed -->
                 </tr>
               </tfoot> --}}
             </table>
           </div>
         </div>
     
     
       </main>
       <script type="text/javascript">
         
        //  function printContent() {
        //     var printBoxContent = document.getElementById('printbox').innerHTML;
        //     var originalContent = document.body.innerHTML;
    
        //     document.body.innerHTML = printBoxContent;
        //     document.body.style.backgroundColor = "white";
    
        //     window.print();
    
        //     // Restore the original content
        //     document.body.innerHTML = originalContent;
        // }
        function goBack() {
        window.history.back();
      }
         
       </script>
       <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the "Print" button
            const printButton = document.getElementById('printBtn');
            const printSection = document.getElementById('printSection');
    
            // Attach a click event listener to the "Print" button
            printButton.addEventListener('click', function () {
                // Open the print dialog for the printSection
                window.print();
            });
        });
    </script>
    
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
    
            #printSection, #printSection * {
                visibility: visible;
            }
    
            #printSection {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                max-width: 100%;
                box-sizing: border-box;
                padding: 10px; /* Adjust padding as needed */
            }
        }
    </style>
    </x-app-layout>