<x-app-layout>
    <div class=" bg-white shadow-lg px-4 py-2 ">
        <form autocomplete="off" id="reportForm" action="{{ route('sales_analysis_report') }}" method="POST">
            @csrf
            <div class="flex gap-4 items-center w-full">
               
                <div class="flex w-[15%] gap-2">
                    <label for="start_date">Start Date</label>
                    <div class="input-group date" style="width: 60%">
                        <input type="text" class="form-control datepicker" name="start_date" id="start_date" required placeholder="Start Date" />
                    </div>      
                </div>
                <div class="flex w-[15%] gap-2">
                    <label for="end_date">End Date</label>
                    <div class="input-group date" style="width: 60%">
                        <input type="text" class="form-control datepicker" name="end_date" id="end_date" required placeholder="End Date" />
                    </div>      
                </div>
               
                
                <div class="">
                    <button type="submit" class="bg-black border-blue-500 text-white py-2 px-6  ">Submit</button>
                </div>
            </div>
        </form>
  </div>

  <div class="buttons justify-end flex gap-3 p-5 ">
        
    <button id="printButton" class="text-white bg-red-600 font-bold text-md py-2 px-4">Print</button>
    
    <button class="text-white bg-black font-bold text-md py-2 px-4" onclick='goBack()'>GO BACK</button>
</div> 
  <main class="flex-1 mx-auto max-w-7xl px-10">
  
   
    

        <!-- <p class="">From Date : 14-09-2024 </p> -->
    <div class="reportdiv mt-5" id="reportdiv">

    </div>
  </main>
  

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            autoclose: true
        });

        $('.select2').select2();

        // $('#ordertable').DataTable();

        $('#reportForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    // Update the reportdiv with the response
                    // console.log(response);
                    $('#reportdiv').html(response.html);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });

    
</script>

<script>
    // Function to print the content of the reportdiv
    function printReport() {
        var printContents = document.getElementById("reportdiv").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    // Add event listener to the "Print" button
    document.querySelector("#printButton").addEventListener("click", function() {
        printReport();
    });
</script>
</x-app-layout>