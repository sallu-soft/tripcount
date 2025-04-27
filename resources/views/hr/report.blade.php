<x-app-layout>
    <div class="container-fluid bg-white shadow-lg p-4 rounded-lg">
        {{-- <h3>fsdsdf</h3> --}}
        <form id="reportForm" action="{{ route('stuff.report', ['id' => $id]) }}" method="POST" autocomplete="off">

          @csrf
          <div class="flex items-center gap-3">
            
            
       
            <div class="w-fit flex items-center">
                <div class="flex flex-col">
                    <label for="month" class="">For the month of:</label>
                    <select id="month" name="month" class="w-[100px] px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="">Choose Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class=""><input type="number" id="year" name="year" class=" px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Year"></div>
                <input type="hidden" id="id" name="emp_id" value="{{$id}}" readonly>
                
            </div>
            
            <div class="flex items-center">
                <button type="submit" class="bg-black border-blue-500 text-white py-2 px-5 rounded-lg ">Submit</button>
            </div>
          </div>
      </form>
    </div>

    <div class="buttons justify-end flex gap-3 shadow-lg p-5 ">
        <button id="printButton" class="text-white bg-red-700 font-bold text-md py-2 px-4">Print</button>
        <button class="text-white bg-black font-bold text-md py-2 px-4">GO BACK</button>
    </div> 

    <div class="reportdiv mt-5" id="reportdiv">
        <table class="table table-striped table-hover no-wrap " id="typetable">
            <thead class="bg-[#5dc8cc]">
                <tr>
                    <th scope="col" class="px-4 py-2 ">Serial</th>
                    <th scope="col" class="px-4 py-2 ">Ref ID</th>
                    <th scope="col" class="px-4 py-2 ">Name</th>
                    <th scope="col" class="px-4 py-2 ">Date</th>
                    <th scope="col" class="px-4 py-2 ">Month</th>
                    <th scope="col" class="px-4 py-2 ">Year</th>
                    <th scope="col" class="px-4 py-2 ">Remark</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach ($salaries as $index => $salary)
                    <tr>
                        <th scope="row" class="px-4 py-2">{{ $index + 1 }}</th>
                        <td class="px-4 py-2 ">{{ $salary->ref_id }}</td>
                        <td class="px-4 py-2 ">{{ $salary->employee }}</td>
                        <td class="px-4 py-2 ">{{ $salary->date }}</td>
                        <td class="px-4 py-2 ">{{ $salary->month }}</td>
                        <td class="px-4 py-2 ">{{ $salary->year }}</td>
                        <td class="px-4 py-2 ">{{ $salary->remarks }}</td>
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
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