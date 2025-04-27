<x-app-layout>
<style>
    .main{
        background-color:"white";
    }
</style>
<main class="flex-1 m-4 mx-auto max-w-[1060px] px-10">
    <div class="buttons justify-end flex gap-3 shadow-lg p-5 ">
       <button class="text-white bg-red-600 font-bold text-md py-2 px-4 focus:outline-none" id="printBtn">Print</button>
       
       <button class="text-white bg-black font-bold text-md py-2 px-4" onclick="goBack()">GO BACK</button>
    </div>
     <div class="my-4 bg-white shadow-lg p-5" id="printSection" >
       <div class="flex justify-between items-center py-5">
           <div class=""><img src="{{ url(Auth::user()->company_logo) }}" alt="logo" width="150px" height="180px"/></div>
           
           <div class="w-[350px]">
            <h3 class="company-name font-bold text-3xl ">{{Auth::user()->name}}</h3>
            <p class="company-address text-lg font-medium">{{Auth::user()->company_address}}</p>
            <p class="company-phone text-lg font-medium">Mob : {{Auth::user()->mobile_no}}</p>
            <p class="company-email text-lg font-medium">Email : {{Auth::user()->email}}</p>
        </div>
       </div>
       <hr class="mb-3 h-[3px] bg-gray-400 border-none"/>
       <div class="font-bold text-3xl text-center">INVOICE DETAILS</div>
       <div class="flex justify-between items-center text-lg">
         <div>
           <p><span class="font-bold">Date</span>: {{ \Carbon\Carbon::now()->format('d/m/y') }}</p>
           <p><span class="font-bold">Service Type : </span> Ticket Booking</p>
         </div>
         <div class="w-[350px] mt-3">
           <h3 class="font-bold text-xl">Agent Details</h3>
           <p>Name: {{$agent->name}}</p>
           <p>Address: {{$agent->address}}</p>
           <p>Email : {{$agent->email}}</p>
           <p>Mob : {{$agent->phone}}</p>
         </div>
       </div>
       <div class="w-full overflow-hidden mt-7">
         <table class="min-w-full bg-white border rounded shadow overflow-hidden">
           <thead class="text-black ">
             <tr class="bg-gray-300">
               <td class="py-1 font-bold text-md px-4">Invoice No</td>
               <td class="py-1 font-bold text-md px-4">Pax Name</td>
               <td class="py-1 font-bold text-md px-4">Details</th>
               <td class="py-1 font-bold text-md px-4">Total Balance</th>
               <!-- Add more columns as needed -->
             </tr>
           </thead>
           <tbody class="text-gray-700 border-black border-b-2">
             <tr>
               <td class="py-2 px-4">{{$ticket->invoice}}</td>
               <td class="py-2 px-4 font-bold uppercase">{{$ticket->passenger}}</td>
               <td class="py-2 px-4">
                 <p>Ticket No: {{$ticket->ticket_code}}/{{$ticket->ticket_no}}</p>
                 <p id="flight-date" data-flight-date="{{ $ticket->flight_date }}">Flight Date: </p>
                 <p>Sector : {{$ticket->sector}} 
                 </p>
                 <p>Airline Name : {{$ticket->airline_name}} / {{$ticket->airline_code}} </p>
                 
                 <p>Remarks: {{$ticket->remark}}</p>
               </td>
               <td class="py-2 px-4 font-bold">{{$ticket->agent_price}}</td>
               <!-- Add more rows and data as needed -->
             </tr>
           </tbody>
           <tfoot>
             <tr>
               <td class="py-2 px-4"></td>
               <td class="py-2 px-4"></td>
               <td class="py-2 px-4 bg-red-200 font-bold">
                 Total
               </td>
               <td class="py-2 px-4 bg-red-200 font-bold">{{$ticket->agent_price}}</td>
               <!-- Add more rows and data as needed -->
             </tr>
             <tr class="">
               <td class="py-2 px-4"></td>
               <td class="py-2 px-4"></td>
               <td class="py-2 px-4 bg-gray-200 font-bold" >
                 Net Amount
               </td>
               <td class="py-2 px-4 bg-gray-200 font-bold">{{$ticket->agent_price}}</td>
               <!-- Add more rows and data as needed -->
             </tr>
           </tfoot>
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
    function formatDate(dateStr) {
            let date = new Date(dateStr);
            let day = String(date.getDate()).padStart(2, '0');
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        // Get the flight date from the data attribute
        let flightDateElement = document.getElementById('flight-date');
        let flightDateStr = flightDateElement.getAttribute('data-flight-date');
        
        // Format the date
        let formattedDate = formatDate(flightDateStr);
        
        // Update the element's text content
        flightDateElement.textContent = `Flight Date: ${formattedDate}`;
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