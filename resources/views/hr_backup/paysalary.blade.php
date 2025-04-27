{{-- <x-app-layout>
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-2 flex items-center gap-6">
            <p class="font-bold text-2xl">List of Stuff</p>
            <button
                class="py-2 px-4 border-green-700 hover:bg-green-700 hover:text-white duration-300 border-2 text-green-700  rounded-2xl font-bold "
                onchange="toggleVisibility()" id="addnewbtn">Pay
                Salary</button>
        </div>
        <div id="stuff-form">

            <div class="addagent w-[100%] lg:w-[60%] bg-white p-5 shadow-lg rounded-lg">
                
                <div class="text-center font-bold text-xl mb-8">Pay Employee Salary</div>
                <form class="grid grid-cols-2 gap-x-6 gap-y-2">
                    <div class="flex items-center">
                      <label for="payment_date" class="w-1/2 pr-4 ">Payment Date*:</label>
                      <input type="date" id="payment_date" name="payment_date" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                    <div class="flex items-center">
                      <label for="ref_no" class="w-1/2 pr-4 ">Ref. No.:</label>
                      <input type="text" id="ref_no" name="ref_no" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" value="SL-001">
                    </div>
                      <div class="flex items-center">
                        <label for="salary_amount" class="w-1/2 pr-4 ">Salary Amount*:</label>
                        <input type="number" id="salary_amount" name="salary_amount" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
                      </div>
                      <div class="flex items-center">
                        <label for="mode_of_payment" class="w-1/2 pr-4 ">Mode of Payment*:</label>
                        <select id="mode_of_payment" name="mode_of_payment" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
                          <option value="">Choose Mode of Payment</option>
                        </select>
                      </div>
                      <div class="flex items-center">
                        <label for="staff" class="w-1/2 pr-4 ">Choose Staff:</label>
                        <select id="staff" name="staff" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
                          <option value="">Choose the Staff</option>
                        </select>
                      </div>
                      <div class="flex items-center">
                        <label for="month" class="w-1/2 pr-4 ">For the month of:</label>
                        <select id="month" name="month" class="w-3/4 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
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
                        <input type="number" id="year" name="year" class="w-1/4 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Year">
                      </div>
                    <div class="flex items-center">
                      <label for="remarks" class="w-1/2 pr-4">Remarks:</label>
                      <textarea id="remarks" name="remarks" rows="2" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
                    </div>
                    <div class="flex justify-end items-end h-[40px]">
                      <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white">Submit</button>
                    </div>
                  </form>
            </div>
        </div>
        <div class="bg-white shadow-md p-6 my-3 w-full md:w-[60%]">
            
        <form method="GET" action="{{ route('type.index') }}" class=" flex justify-end mb-3">
                <div class="flex items-center gap-3">
                    <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
                    <button type="submit" class="bg-black px-5 py-1.5 rounded text-white">Search</button>
                </div>
            </form>



        
    </div>

    </div>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                autoclose: true
            });

            $('.select2').select2({
                theme: 'classic',
            });

           


        });
        var addnewBtn = document.getElementById('addnewbtn');
        var addStuff = document.getElementById('stuff-form');
        addStuff.style.display = 'none';

        addnewBtn.addEventListener('click', function() {
            toggleVisibility();
        });

        function toggleVisibility() {
            if (addStuff.style.display === 'none') {
                addStuff.style.display = 'block';
            } else {
                addStuff.style.display = 'none';
            }
        }
    </script>
</x-app-layout> --}}
<x-app-layout>
    <div class="container mt-5">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-2 flex items-center gap-6">
            <p class="font-bold text-2xl">List of Stuff</p>
            <button
                class="py-2 px-4 border-green-700 hover:bg-green-700 hover:text-white duration-300 border-2 text-green-700  rounded-2xl font-bold "
                onchange="toggleVisibility()" id="addnewbtn">Pay
                Salary</button>
        </div>
        <div id="stuff-form">

            <div class="addagent w-[100%] lg:w-[80%] bg-white p-5 shadow-lg rounded-lg">
                {{-- <form action="/addtype" method="post">
                    @csrf <!-- Add this line to include CSRF protection in Laravel -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="name">Type Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your name" required>
                        </div>
                    </div>

                    <button type="submit" class="px-8 py-2 bg-black rounded-xl text-white">Submit</button>
                </form> --}}
                <div class="text-center font-bold text-xl mb-8">Pay Employee Salary</div>
                <form class="grid grid-cols-2 gap-x-6 gap-y-2" action="{{ route('salary.store') }}" method="post">
                    @csrf
                    <div class="flex items-center">
                      <label for="ref_no" class="w-1/2 pr-4 ">Ref. No.:</label>
                      <input type="text" id="ref_no" name="ref_no" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500"value="SL-{{ $nextID }}" readonly
                      >
                    </div>
                    <div class="flex items-center">
                      <label for="payment_date" class="w-1/2 pr-4 ">Payment Date*:</label>
                      <input type="date" id="payment_date" name="payment_date" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                    
                      
                      <div class="flex items-center">
                        <label for="staff" class="w-1/2 pr-4 ">Choose Staff:</label>
                        <select id="staff" name="staff" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
                          <option value="">Choose the Staff</option>
                          @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="flex items-center">
                        <label for="mode_of_payment" class="w-1/2 pr-4 ">Mode of Payment*:</label>
                        <select id="mode_of_payment" name="mode_of_payment" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
                          <option value="">Choose Mode of Payment</option>
                          @foreach ($methods as $method)
                            <option value="{{$method->id}}">{{$method->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="flex items-center">
                        <label for="salary_amount" class="w-1/2 pr-4 ">Salary Amount*:</label>
                        <input type="number" id="salary_amount" name="salary_amount" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
                      </div>
                      <div class="flex items-center">
                        <label for="month" class="w-1/2 pr-4 ">For the month of:</label>
                        <select id="month" name="month" class="w-3/4 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
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
                        <input type="number" id="year" name="year" class="w-1/4 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Year">
                      </div>
                    <div class="flex items-center">
                      <label for="remarks" class="w-1/2 pr-4">Remarks:</label>
                      <textarea id="remarks" name="remarks" rows="2" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
                    </div>
                    <div class="flex justify-end items-end h-[40px]">
                      <button type="submit" class="px-4 py-2 rounded mt-2 bg-black text-white">Submit</button>
                    </div>
                  </form>
            </div>
        </div>
        <div class="bg-white shadow-md p-6 my-3 w-full md:w-[80%]">
            
        <form method="GET" action="{{ route('type.index') }}" class=" flex justify-end mb-3">
                <div class="flex items-center gap-3">
                    <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
                    <button type="submit" class="bg-black px-5 py-1.5 rounded text-white">Search</button>
                </div>
            </form>



        <table class="table table-striped table-hover no-wrap " id="typetable">
                <thead class="bg-[#5dc8cc]">
                    <tr>
                        <th scope="col" class="px-4 py-2 ">Serial</th>
                        <th scope="col" class="px-4 py-2 ">Name</th>
                        <th scope="col" class="px-4 py-2 ">Salary</th>
                        
                        <th scope="col" class="px-4 py-2 ">Method</th>
                        <th scope="col" class="px-4 py-2 ">Month-Year</th>
                        
                        <th scope="col" class="px-4 py-2 flex justify-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salaries as $index => $salary)
                        <tr>
                            <th scope="row" class="px-4 py-2">{{ $index + 1}}</th>
                            <td class="px-4 py-2">
                              @foreach($employees as $index => $employee)
                                  @if($salary->employee == $employee->id)
                                      {{ $employee->name }}
                                  @endif
                              @endforeach
                            </td>
                            <td class="px-4 py-2">
                              @foreach($employees as $index => $employee)
                                  @if($salary->employee == $employee->id)
                                      {{ $employee->salary }}
                                  @endif
                              @endforeach
                            </td>
                            <td class="px-4 py-2">
                              @foreach($methods as $index => $method)
                                  @if($salary->method == $method->id)
                                      {{ $method->name }}
                                  @endif
                              @endforeach
                            </td>
                            <td class="px-4 py-2">
                              <?php
    // Assuming $salary->month contains the numeric value of the month (e.g., 1 for January)
                                $monthNumber = $salary->month;
                                $monthName = date("F", mktime(0, 0, 0, $monthNumber, 1));
                                echo $monthName;
                                ?>
                                {{ $salary->year}}
                            </td>
                            <td class="px-4 py-2 flex justify-center">
                              <a href="{{ route('payslip.view', ['id' => $salary->id]) }}" class=""><i class="text-xl fa fa-eye fa-fw"></i></a>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        {{ $salaries->links() }}
    </div>

    </div>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                autoclose: true
            });
            $('#staff').on('change', function(){
              var staffId = $(this).val(); // Get the selected staff ID
    
              // Make an AJAX call
              $.ajax({
                  url: '/get-staff-details', // URL to your backend route
                  method: 'POST', // or 'GET' depending on your backend setup
                  data: { 
                      staff_id: staffId,
                      _token: '{{ csrf_token() }}' // Include the CSRF token
                  }, 
                  success: function(response) {
                      // Handle successful response from the server
                      // console.log(response);
                      $('#salary_amount').val(response.salary);
                      // You can update your UI with the received data here
                  },
                  error: function(xhr, status, error) {
                      // Handle errors
                      console.error(xhr.responseText);
                  }
              });
            });

            $('.select2').select2({
                theme: 'classic',
            });

            // $('#typetable').DataTable();


        });
        var addnewBtn = document.getElementById('addnewbtn');
        var addStuff = document.getElementById('stuff-form');
        addStuff.style.display = 'none';

        addnewBtn.addEventListener('click', function() {
            toggleVisibility();
        });

        function toggleVisibility() {
            if (addStuff.style.display === 'none') {
                addStuff.style.display = 'block';
            } else {
                addStuff.style.display = 'none';
            }
        }
    </script>
</x-app-layout>