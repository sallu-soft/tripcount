<x-app-layout>

    <main class=" w-full">
        
        @if(session('success'))
        <div class="alert alert-success" id="">
            {{-- {{ dd(session('success')) }} --}}
            {{-- <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officiis, officia!</p> --}}
        </div>
        @endif
        <div class="w-[85%] mx-auto flex justify-center items-center ">
            

            <div class="flex-col py-3 border-gray-400 w-full" style="" id="receive">
                <div class="text-xl font-bold text-gray-700 mb-4">Receive Details</div>
                <form autocomplete="off" action="{{ route('submit.receive') }}" id="submit_form_receive" method="post" class="w-[100%]">
                    @csrf
                    <div
                        class="shadow-2xl border-t border-gray-200 mt-4 bg-white w-[100%] md:w-[80%] rounded-lg px-8 py-6 grid grid-cols-1 md:grid-cols-2 gap-x-28">
                        <div class="flex md:flex-row flex-col md:items-center justify-around gap-1 md:gap-4 mb-2 md:mb-4 ">
                            <label for="receiveRef" class="text-gray-800 font-semibold w-[80%] md:w-[40%]">Ref. No.</label>
                            <input type="text" id="receiveRef" name="receiveRef" value="RV-000100"
                                class="lg:w-[60%] w-[95%] md:w-[80%] h-9 p-2 text-black text-center bg-white" readonly />
                        </div>
                        <div class="flex md:flex-row flex-col md:items-center justify-around gap-1 md:gap-4 mb-2 md:mb-4 ">
                            <label for="receiveDate" class="text-gray-800 font-semibold w-[80%] md:w-[40%]">Receive Date</label>
                            <input type="date" id="receiveDate" name="receiveDate"
                                class="lg:w-[60%] md:w-[80%] w-[95%] border  h-9 p-2 text-black text-center bg-white" />
                        </div>
                        <div class="flex md:flex-row flex-col md:items-center justify-around gap-1 md:gap-4 mb-2 md:mb-4 ">
                            <label for="clientName" class="text-gray-800 font-semibold w-[80%] md:w-[50%]">Client Name</label>
                            <select id="clientName" name="clientName" class="lg:w-[50%] w-[80%] border h-9 text-black bg-white select2">
                                <option value="">Select Client Name</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->getTable() }}_{{ $agent->id }}">{{ $agent->name }}</option>
                                @endforeach
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->getTable() }}_{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        {{-- <div class="flex md:flex-row flex-col md:items-center justify-around gap-1 md:gap-4 mb-2 md:mb-4 ">
                            <label for="clientBalance" class="text-gray-800 font-semibold w-[80%] md:w-[40%]">Total Invoice
                                Amount</label>
                            <input type="text" id="clientBalance" name="clientBalance"
                                class="lg:w-[60%] md:w-[80%] w-[95%] border  h-9 p-2 text-black text-center bg-white" />
                        </div> --}}
                        <div class="flex md:flex-row flex-col md:items-center justify-around gap-1 md:gap-4 mb-2 md:mb-4 ">
                            <label for="receiveAmount" class="text-gray-800 font-semibold w-[80%] md:w-[40%]">Receive Amount</label>
                            <input type="text" id="receiveAmount" name="receiveAmount"
                                class="lg:w-[60%] md:w-[80%] w-[95%] border  h-9 p-2 text-black text-center bg-white" />
                        </div>
                        <div class="flex md:flex-row flex-col md:items-center justify-around gap-1 md:gap-4 mb-2 md:mb-4 ">
                            <label for="receiveMethod" class="text-gray-800 font-semibold w-[80%] md:w-[50%]">Mode of Receive</label>
                            <select id="receiveMethod" name="receiveMethod" class="lg:w-[50%] w-[80%] border h-9 text-black bg-white select2">
                                <option value="">Select Payment Method</option>
                                @foreach($methods as $method)
                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="flex md:flex-row flex-col md:items-center justify-around gap-1 md:gap-4 mb-2 md:mb-4 ">
                            <label for="remarks" class="text-gray-800 font-semibold w-[80%] md:w-[40%]">Remarks</label>
                            <textarea id="remarks" name="remarks" class="lg:w-[60%] w-[95%] md:w-[80%] border  p-2  text-black bg-white"
                                placeholder="Type remarks (if any)"></textarea>
                        </div>
                        <div class="justify-end items-end flex w-[95%] md:w-full">
                            <button type="submit"
                                class="inline-flex items-center px-4 h-10 bg-black text-white font-bold rounded-md ">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('#submit_form_receive').submit(function(e) {
                e.preventDefault(); // Prevent the form from submitting the traditional way

                // Perform your AJAX call
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(), // Serialize the form data
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2500
                            }).then((result) => {
                                if (response && response.fullEntry) {
                                    const lastId = response.fullEntry.payment.id
                                    console.log(lastId);
                                    // Redirect to the receive_voucher with the lastId
                                    window.location.href = `/receive_voucher/${lastId}`;
                                } else {
                                    // Handle the case where lastId is missing in the result
                                    console.error("lastId not found in result:", response);
                                }

                            });
                        }
                        else{
                            Swal.fire({
                            icon: 'error',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2500
                            }).then((result) => {
                                // Reload the page after the alert is closed
                                window.location.reload();
                            });
                        }
                    },
                    error: function(error) {
                        // Handle the error response
                        console.error('Error:', error);
                    }
                });
                
            });

            
        });
    </script>
    <script>
   

      

      function generateRandomStringReceive() {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '/get-last-id-receive', // Replace with the actual URL to fetch the last ID
                        method: 'GET',
                        success: function(response) {
                            // console.log(response);
                            let invoice = response.invoice;
                            
                            resolve(invoice);
                        },
                        error: function(error) {
                            console.error('Error fetching last ID:', error);
                            // Reject the promise with the error
                            reject(error);
                        }
                    });
                });
            }

            // Example usage:
            generateRandomStringReceive()
                .then(randomString => {
                    $('#receiveRef').val(randomString);
                    // Do something with the random string here
                })
                .catch(error => {
                    console.error('Failed to generate random string:', error);
                });



           
                $('#ticket_code').on('change', function() {
                var ticketCodeValue = $(this).val();

                // Make an AJAX call
                $.ajax({
                    url: '/search_airline', // Replace with the actual endpoint URL
                    method: 'POST', // Specify the HTTP method (POST, GET, etc.)
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        ticketCode: ticketCodeValue
                    }, // Data to be sent to the server
                    dataType: 'json', // Expected data type of the response
                    success: function(response) {
                        if (response.message == 'Success') {
                            $('#airlines_name').val(response.airline.Full);
                            $('#airlines_code').val(response.airline.Short);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        // Handle errors during the AJAX call
                        console.error('Error:', error);
                    }
                });
            });
            

            // Example usage:
            


           
                $('#ticket_code').on('change', function() {
                var ticketCodeValue = $(this).val();

                // Make an AJAX call
                $.ajax({
                    url: '/search_airline', // Replace with the actual endpoint URL
                    method: 'POST', // Specify the HTTP method (POST, GET, etc.)
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        ticketCode: ticketCodeValue
                    }, // Data to be sent to the server
                    dataType: 'json', // Expected data type of the response
                    success: function(response) {
                        if (response.message == 'Success') {
                            $('#airlines_name').val(response.airline.Full);
                            $('#airlines_code').val(response.airline.Short);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        // Handle errors during the AJAX call
                        console.error('Error:', error);
                    }
                });
            });

            function generateRandomStringReceive() {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '/get-last-id-receive', // Replace with the actual URL to fetch the last ID
                        method: 'GET',
                        success: function(response) {
                            // console.log(response);
                            let invoice = response.invoice;
                            
                            resolve(invoice);
                        },
                        error: function(error) {
                            console.error('Error fetching last ID:', error);
                            // Reject the promise with the error
                            reject(error);
                        }
                    });
                });
            }

            // Example usage:
            generateRandomStringReceive()
                .then(randomString => {
                    $('#receiveRef').val(randomString);
                    // Do something with the random string here
                })
                .catch(error => {
                    console.error('Failed to generate random string:', error);
                });



           
                $('#ticket_code').on('change', function() {
                var ticketCodeValue = $(this).val();

                // Make an AJAX call
                $.ajax({
                    url: '/search_airline', // Replace with the actual endpoint URL
                    method: 'POST', // Specify the HTTP method (POST, GET, etc.)
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        ticketCode: ticketCodeValue
                    }, // Data to be sent to the server
                    dataType: 'json', // Expected data type of the response
                    success: function(response) {
                        if (response.message == 'Success') {
                            $('#airlines_name').val(response.airline.Full);
                            $('#airlines_code').val(response.airline.Short);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        // Handle errors during the AJAX call
                        console.error('Error:', error);
                    }
                });
            });
    </script>
</x-app-layout>