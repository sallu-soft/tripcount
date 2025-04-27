<x-app-layout>

     
  <main class="mx-auto w-[75%] ">
    <div id="addAgent mt-8">
        <h1 class="mb-4 text-3xl w-[80%] mx-auto font-bold">Add Contra</h1>
        <div class="addagent w-[90%] md:w-[80%] p-7 mx-auto bg-white shadow-lg rounded-lg">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('moneytransfer.add') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-10">
                    <div class="mb-4">
                        <label for="branch" class="block text-sm font-medium text-gray-700">Banch:</label>
                        <input type="text" id="branch" name="branch" class="mt-1 p-2 w-full border " placeholder="Enter your name" value="{{$company_name}}">
                    </div>
    
                    <div class="mb-4">
                        <label for="transaction_date" class="block text-sm font-medium text-gray-700">Transaction Date:</label>
                        <input type="date" id="transaction_date" name="transaction_date" class="mt-1 p-2 w-full border " placeholder="Enter your phone number" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-10">
                    <div class="mb-4">
                        <label for="from_account" class="block text-sm font-medium text-gray-700">From Account:</label>
                        <select id="from_account" name="from_account" class="mt-1 p-2 w-full border " placeholder="Enter an from_account">
                            <option value="">From Acount</option>
                            @foreach ($transactions as $transaction)
                                <option value="{{$transaction->id}}">{{$transaction->name}}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="mb-4">
                        <label for="to_account" class="block text-sm font-medium text-gray-700">To Account:</label>
                        <select id="to_account" name="to_account" class="mt-1 p-2 w-full border " placeholder="Enter an to_account">
                            <option value="">To Acount</option>
                            @foreach ($transactions as $transaction)
                                <option value="{{$transaction->id}}">{{$transaction->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-10">
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700">Amount:</label>
                        <input type="text" id="amount" name="amount" class="mt-1 p-2 w-full border " placeholder="Enter a amount">
                    </div>
                    <div class="mb-4">
                        <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks:</label>
                        <textarea id="remarks" name="remarks" class="mt-1 p-2 w-full border " placeholder="Enter an remarks" ></textarea>
                    </div>
        
                  
                </div>
               
    
                <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg">Submit</button>
            </form>
        </div>
    </div>
    <div class=" mt-8 shadow-lg bg-white rounded-lg">
        <table class="table table-striped table-hover no-wrap w-full" id="agenttable">
            <thead class="bg-[#7CB0B2]">
                <tr>
                    <th class="px-4 py-2 text-left">Serial</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">From</th>
                    <th class="px-4 py-2 text-left">To</th>
                    <th class="px-4 py-2 text-left">Amount</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-400">
                @foreach ($transfers as $index=>$transfer)
                    <tr>
                        <td class="px-4 py-2"> {{$index + 1}} </td>
                        <td class="px-4 py-2">{{$transfer->date}}</td>
                        <td class="px-4 py-2">{{$transfer->from}}</td>
                        <td class="px-4 py-2">{{$transfer->to}}</td>
                        <td class="px-4 py-2">{{$transfer->amount}}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('moneytransfer.delete', ['id' => $transfer->id]) }}" class="text-red-900 px-2 py-1 rounded-md"><i class="text-xl fa fa-trash-o fa-fw"></i></a>
                        </td>
                    <tr>
                @endforeach
                   
            </tbody>
        </table>
    </div>
  </main>
  

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();

            function generateRandomStringReceive() {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '/get-last-id-receive', // Replace with the actual URL to fetch the last ID
                        method: 'GET',
                        success: function(response) {
                            console.log(response);
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

          
            $('#submit_form_payment').submit(function(e) {
                e.preventDefault(); 
                                       
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
                                // Reload the page after the alert is closed
                                window.location.reload();
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
   
</x-app-layout>



