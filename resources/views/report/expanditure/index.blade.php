<x-app-layout>
    <div class="container-fluid bg-white shadow-lg px-1 rounded-lg">
        {{-- <h3>fsdsdf</h3> --}}
        <form id="reportForm" action="{{ route('expenditure_report_result') }}" method="POST">
            @csrf
            <div class="flex items-center">
                
                <!-- Start Date -->
                <div class="form-group col-md-2">
                    <label for="start_date">Start Date</label>
                    <div class="input-group date" style="width: 100%">
                        <input type="text" class="form-control datepicker" name="start_date" id="start_date" placeholder="Start Date" />
                    </div>      
                </div>
                
                <!-- End Date -->
                <div class="form-group col-md-2">
                    <label for="end_date">End Date</label>
                    <div class="input-group date" style="width: 100%">
                        <input type="text" class="form-control datepicker" name="end_date" id="end_date" placeholder="End Date" />
                    </div>      
                </div>
        
                <!-- Towards (Dropdown) -->
                <div class="form-group col-md-2">
                    <label for="towards" class="block text-sm font-medium text-gray-700">Towards:</label>
                    <div class="flex items-center gap-2">
                        <select id="towards" name="towards" class="mt-1 px-2 py-1 w-11/12 border" required>
                            <option value="">Select Towards</option>
                            @foreach ($expenditures as $expenditure)
                                <option value="{{ $expenditure->id }}">{{ $expenditure->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="flex items-center">
                    <button type="submit" class="bg-black border-blue-500 text-white py-2 px-5 rounded-lg">
                        Submit
                    </button>
                </div>
        
            </div>
        </form>
        
    </div>

    
    <div class="buttons justify-end flex gap-3 shadow-lg p-5 ">
        
        <button id="printButton" class="text-white bg-red-600 font-bold text-md py-2 px-4">Print</button>
        
        <button class="text-white bg-black font-bold text-md py-2 px-4" onclick="goBack()">GO BACK</button>
    </div> 

    <div class="reportdiv mt-5" id="reportdiv">

    </div>


    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
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