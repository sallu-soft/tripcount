<x-app-layout>
    <div class="container-fluid bg-white shadow-lg p-4 rounded-lg flex-wrap">
        {{-- <h3>fsdsdf</h3> --}}
        <form autocomplete="off" id="reportForm" action="{{ route('sales_report_visa') }}" method="POST">
            @csrf
            <div class="flex items-center pt-3">
              
                <div class=" form-group flex items-center gap-2 col-md-2">
                    <label for="agent" class="text-[14px] text-[#22262e]">Agent</label>
                    <select class="form-control select2" name="agent" id="agent" placeholder="Select agent">
                        <option value="">Select Agent</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 form-group flex items-center gap-2">
                    <label for="supplier" class="text-[14px] text-[#22262e]">Supplier</label>
                    <select class="form-control select2" name="supplier" id="supplier">
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 form-group flex items-center gap-2">
                    <label for="type" class="text-[14px] text-[#22262e]">Type</label>
                    <select class="form-control select2" name="type" id="type">
                        <option value="">Select Type</option>
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2 flex items-center gap-2">
                    <label for="start_date" class="text-[14px] text-[#22262e]">From</label>
                    <div class="input-group date" style="width: 100%">
                        <input type="text" class="form-control datepicker" name="start_date" id="start_date" placeholder="Start Date" />
                    </div>      
                </div>
                <div class="form-group col-md-2 flex items-center gap-2">
                    <label for="end_date" class="text-[14px] text-[#22262e]">To</label>
                    <div class="input-group date" style="width: 100%">
                        <input type="text" class="form-control datepicker" name="end_date" id="end_date" placeholder="End Date" />
                    </div>      
                </div>
                
            </div>
            <div class="flex items-center pt-3">
                <div class="form-group px-6 flex items-center ">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="profit" name="show_profit">
                        <label class="form-check-label text-green-600 text-[16px] font-bold" for="inlineCheckbox1">Profit</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="supplier" name="show_supplier">
                        <label class="form-check-label text-blue-700 text-[16px] font-bold" for="inlineCheckbox2">Supplier</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" checked type="checkbox" id="inlineCheckbox3" value="agent" name="show_agent">
                      <label class="form-check-label text-pink-800 text-[16px] font-bold" for="inlineCheckbox3">Agent</label>
                    </div>
                </div>
                
                <div class="flex items-center mb-2">
                    <button type="submit" class="bg-black border-blue-500 text-lg  text-white py-2 px-6">Submit</button>
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
                        $('#reportdiv').html(response);
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