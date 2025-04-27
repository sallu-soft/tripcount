<x-app-layout>
    <div class="container-fluid bg-white shadow-lg p-4 rounded-lg">
        {{-- <h3>fsdsdf</h3> --}}
        <form id="reportForm" action="{{ route('reissue_ticket_report') }}" method="POST">
          @csrf
          <div class="flex items-center">
            
              <div class=" form-group col-md-2">
                  <label for="agent">Agent</label>
                  <select class="form-control select2" name="agent" id="agent" placeholder="Select agent">
                      <option value="">Select Agent</option>
                      @foreach($agents as $agent)
                          <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="col-md-2 form-group">
                  <label for="supplier">Supplier</label>
                  <select class="form-control select2" name="supplier" id="supplier">
                      <option value="">Select Supplier</option>
                      @foreach($suppliers as $supplier)
                          <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group col-md-2">
                  <label for="start_date">Start Date</label>
                  <div class="input-group date" style="width: 100%">
                      <input type="text" class="form-control datepicker" name="start_date" id="start_date" placeholder="Start Date" />
                  </div>      
              </div>
              <div class="form-group col-md-2">
                  <label for="end_date">End Date</label>
                  <div class="input-group date" style="width: 100%">
                      <input type="text" class="form-control datepicker" name="end_date" id="end_date" placeholder="End Date" />
                  </div>      
              </div>
              <div class="form-group px-6 flex items-center ">
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="profit" name="show_profit">
                      <label class="form-check-label font-semibold text-green-600" for="inlineCheckbox1">Show Profit</label>
                  </div>
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="supplier" name="show_supplier">
                      <label class="form-check-label font-semibold text-blue-700" for="inlineCheckbox2">Show Supplier</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="agent" name="show_agent">
                    <label class="form-check-label font-semibold text-pink-800" for="inlineCheckbox3">Show Agent</label>
                  </div>
              </div>
              
              <div class="flex items-center">
                  <button type="submit" class="bg-black border-blue-500 text-white py-2 px-5 rounded-lg ">Submit</button>
              </div>
          </div>
      </form>
    </div>
    <div class="buttons justify-end flex gap-3 shadow-lg p-5 ">
        
        <button id="printButton" class="text-white bg-red-600 font-bold text-md py-2 px-4">Print</button>
        
        <button class="text-white bg-black font-bold text-md py-2 px-4" onclick='goBack()'>GO BACK</button>
    </div> 
    <div class="reportdiv mt-5" id="reportdiv">
        <table class="table-auto w-full bordered shadow-xl bg-white border-black text-sm my-1">
            <thead>
                <tr class="border-y-2 border-black bg-cyan-700 text-white">
                    <th class="text-start">Date</th>
                    <th class="text-start">Ticket No</th>
                    <th class="text-start">Passenger Name</th>
                    <th class="text-start">Flight Date</th>
                    <th class="text-start">Sector</th>
                    <th class="text-start">Airlines</th>
                    <th class="text-start">Agent</th>
                    <th class="text-start">Agent Fare</th>
                    <th class="text-start">Net Markup (Void)</th>
                </tr>
            </thead>
            <tbody class="divide-y-2">
                @foreach ($query as $data)
                    <tr>
                        <td class="px-2 pl-2">{{ (new DateTime($data->date))->format('d-m-Y') }}</td>
                        <td class="py-2">{{ $data->ticket_code }}-{{ $data->ticket_no }}</td>
                        <td class="py-2">{{ $data->passenger }}</td>
                        <td class="py-2">{{ (new DateTime($data->flight_date))->format('d-m-Y') }}</td>
                        <td class="py-2">{{ $data->sector }}</td>
                        <td class="py-2">{{ $data->airline_name }}</td>
                        <td class="py-2">{{ $data->agent_name }}</td>
                        <td class="py-2">{{ $data->now_agent_fere }}</td>
                        <td class="py-2">{{ $data->reissue_profit }}</td>
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