<x-app-layout>
    <div class="container-fluid bg-white shadow-lg px-1 rounded-lg">
        {{-- <h3>fsdsdf</h3> --}}
        <form autocomplete="off" id="reportForm" action="{{ route('bank_book_report') }}" method="POST">
          @csrf
          <div class="flex items-center px-4 py-3 gap-4">
            
            
       
            <div class="flex ">
                <label for="start_date" class="w-[100px]">Start Date</label>
                <div class="input-group date" style="width: 100%">
                    <input type="text" class="form-control datepicker" name="start_date" id="start_date" placeholder="Start Date" />
                </div>      
            </div>
            <div class="flex">
                <label for="end_date" class="w-[100px]">End Date</label>
                <div class="input-group date" style="width: 100%">
                    <input type="text" class="form-control datepicker" name="end_date" id="end_date" placeholder="End Date" />
                </div>      
            </div>
            <div class="flex gap-3">
                <label for="end_date">Method</label>
                <div class=" w-[250px]">
                    <select class="form-control select2" name="method" id="method">
                        <option value="">Select Bank</option>

                        @foreach ($methods as $method)
                            <option value="{{$method->id}}">{{$method->name}}</option>

                        @endforeach
                    </select>
                </div>      
            </div>
            
            
            <div class="flex items-center">
                <button type="submit" class="bg-black border-blue-500 text-white py-2 ml-3 px-6 ">Submit</button>
            </div>
          </div>
      </form>
    </div>

    
    <div class="buttons justify-end flex gap-3 p-5 ">
        
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