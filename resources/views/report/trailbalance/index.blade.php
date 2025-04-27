<x-app-layout>
    <div class="container-fluid shadow-lg bg-white">
        <form autocomplete="off" id="reportForm" action="{{ route('trialbalance_report') }}" method="POST">
            @csrf
            <div class="flex items-center gap-x-5 py-2">
                
                <div class="w-[350px] flex gap-3">
                    <label for="start_date">Start Date</label>
                    <div class="input-group date w-[75%]" >
                        <input type="text" class="form-control datepicker " name="start_date" id="start_date" placeholder="Start Date" />
                    </div>      
                </div>
                <div class="flex w-[350px] gap-3">
                    <label for="end_date">End Date</label>
                    <div class="input-group date w-[75%]">
                        <input type="text" class="form-control datepicker " name="end_date" id="end_date" placeholder="End Date" />
                    </div>      
                </div>
               
                
                <div class="flex items-end">
                    <button type="submit" class="bg-black px-5 py-2 text-white text-md ">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <div class="buttons justify-end flex gap-3 p-5 ">
        
        <button id="printButton" class="text-white bg-red-600 font-bold text-md py-2 px-4">Print</button>
        
        <button class="text-white bg-black font-bold text-md py-2 px-4" onclick='goBack()'>GO BACK</button>
    </div>

    <div class="reportdiv mt-5 w-[1200px] mx-auto bg-white" id="reportdiv">

    </div>
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