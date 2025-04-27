<x-app-layout>
    <div class="container-fluid bg-white shadow-lg px-4 rounded-lg">
        {{-- <h3>fsdsdf</h3> --}}
        <form autocomplete="off" id="reportForm" action="{{ route('flight_report_ticket') }}" method="POST">
          @csrf
          <div class="flex flex-wrap items-center pt-3">
            
              <div class="col-md-3 form-group flex items-center gap-2">
                  <label for="agent" class="text-[14px] text-[#22262e]">Agent</label>
                  <select class="form-control select2 " name="agent" id="agent" placeholder="Select agent">
                      <option value="">Select Agent</option>
                      @foreach($agents as $agent)
                          <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                      @endforeach
                  </select>
              </div>
              {{-- <div class="col-md-3 form-group flex items-center gap-2">
                  <label for="supplier" class="text-[14px] text-[#22262e]">Supplier</label>
                  <select class="form-control select2" name="supplier" id="supplier">
                      <option value="">Select Supplier</option>
                      @foreach($suppliers as $supplier)
                          <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                      @endforeach
                  </select>
              </div> --}}
                
             
              <div class="flex gap-4 col-md-6 ">
              <div class="form-group flex w-1/2 items-center gap-2 ">
                  <label for="issue_date" class="text-[14px] text-[#22262e] w-[150px]">Flight Date From</label>
                  <div class="input-group date" class="w-[70%]">
                      <input type="text" class="form-control datepicker w-[150px]" name="issue_date" id="issue_date" placeholder="Issue Date" />
                  </div>      
              </div>
              <div class="form-group flex items-center w-1/2 gap-2">
                  <label for="flight_date" class="text-[14px] text-[#22262e] w-[150px]">Flight Date To</label>
                  <div class="input-group date" class="w-[70%]">
                      <input type="text" class="form-control datepicker w-[150px]" name="flight_date" id="flight_date" placeholder="End Date" />
                  </div>      
              </div>
            </div>
              {{-- <div class="form-group px-6 flex items-center ">
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="profit" name="show_profit">
                      <label class="form-check-label font-bold text-[18px] text-[#741f1c]" for="inlineCheckbox1">Profit</label>
                  </div>
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="supplier" name="show_supplier">
                      <label class="form-check-label font-bold  text-[18px] text-[#1c7258]" for="inlineCheckbox2">Supplier</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="agent" name="show_agent">
                    <label class="form-check-label font-bold  text-[18px] text-[#239292]" for="inlineCheckbox3">Agent</label>
                  </div>
              </div> --}}
              
              <div class="flex items-center mb-2">
                  <button type="submit" class="bg-black border-blue-500 text-white px-7 text-[17px] py-2 ">Submit</button>
              </div>
          </div>
      </form>
    </div>

    <div class="buttons justify-end flex gap-3 p-5 ">
        
        <button id="printButton" class="text-white bg-red-600 font-bold text-md py-2 px-4">Print</button>
        
        <button class="text-white bg-black font-bold text-md py-2 px-4" onclick='goBack()'>GO BACK</button>
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