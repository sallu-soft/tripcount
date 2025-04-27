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
                onchange="toggleVisibility()" id="addnewbtn">Add
                New Stuff</button>
        </div>
        <div id="stuff-form">

            <div class="addagent w-[100%] lg:w-[50%] bg-white p-5 shadow-lg rounded-lg">
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
                <div class="text-center font-bold text-xl mb-8">Add New Employee</div>
            <form autocomplete="off" class="grid grid-cols-1 gap-4"  action="{{ route('addstuff.store') }}" method="post">
                @csrf
                <div class="flex items-center">
                    <label for="employeeName" class="w-1/2  mr-4">Employee Name <stong class="text-red-600 text-2xl">*</strong></label>
                    <input type="text" id="employeeName" name="employeeName"
                        class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <div class="flex items-center">
                    <label for="designation" class="w-1/2  mr-4">Employee Designation <stong class="text-red-600 text-2xl">*</strong></label>
                    <input type="text" id="designation" name="designation"
                        class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <div class="flex items-center">
                    <label for="mobileNumber" class="w-1/2  mr-4">Mobile Number <stong class="text-red-600 text-2xl">*</strong></label>
                    <input type="tel" id="mobileNumber" name="mobileNumber"
                        class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <div class="flex items-center">
                    <label for="email" class="w-1/2  mr-4">E-mail ID</label>
                    <input type="email" id="email" name="email"
                        class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <div class="flex items-center">
                    <label for="password" class="w-1/2  mr-4">Password</label>
                    <input type="password" id="password" name="password"
                        class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <div class="flex items-center">
                    <label for="address" class="w-1/2  mr-4">Address</label>
                    <textarea id="address" name="address" rows="2"
                        class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
                </div>
                <div class="flex items-center">
                    <label for="salary" class="w-1/2  mr-4">Salary</label>
                    <input type="number" id="salary" name="salary"
                        class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <div class="flex items-start">
                    <label for="salary" class="w-1/2  mr-4">Permission</label>
                    <div>
                        <fieldset class="flex gap-2">
                            <div>
                                <input type="checkbox" id="entry" name="permissions[]" value="entry" />
                                <label for="entry">Entry</label>
                            </div>
                            <div>
                                <input type="checkbox" id="edit" name="permissions[]" value="edit" />
                                <label for="edit">Edit</label>
                            </div>
                            <div>
                                <input type="checkbox" id="view" name="permissions[]" value="view" />
                                <label for="view">View</label>
                            </div>
                            <div>
                                <input type="checkbox" id="print" name="permissions[]" value="print" />
                                <label for="print">Print</label>
                            </div>
                            <div>
                                <input type="checkbox" id="profit" name="permissions[]" value="profit" />
                                <label for="profit">Profit</label>
                            </div>
                            <div>
                                <input type="checkbox" id="delete" name="permissions[]" value="delete" />
                                <label for="delete">Delete</label>
                            </div>
                        </fieldset>
                    </div>
                </div>
               
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none">Submit</button>
            </form>

            </div>
        </div>
        <div class="bg-white shadow-md p-6 my-3 w-full md:w-[60%]">
            
        {{-- <form method="GET" action="{{ route('type.index') }}" class=" flex justify-end mb-3">
                <div class="flex items-center gap-3">
                    <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
                    <button type="submit" class="bg-black px-5 py-1.5 rounded text-white">Search</button>
                </div>
        </form> --}}



           
    </div>
        <table class="table shadow-xl table-hover no-wrap " id="typetable">
            <thead class="bg-[#5dc8cc]">
                <tr>
                    <th scope="col" class="px-4 py-2 ">Serial</th>
                    <th scope="col" class="px-4 py-2 ">Name</th>
                    <th scope="col" class="px-4 py-2 ">Designation</th>
                    <th scope="col" class="px-4 py-2 ">Phone</th>
                    <th scope="col" class="px-4 py-2 ">Email</th>
                    <th scope="col" class="px-4 py-2 ">Salary</th>
                    
                    <th scope="col" class="px-4 py-2 flex justify-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $index => $employee)
                    <tr>
                        <th scope="row" class="px-4 py-2">{{ $index + 1 }}</th>
                        <td class="px-4 py-2 ">{{ $employee->name }}</td>
                        <td class="px-4 py-2 ">{{ $employee->designation }}</td>
                        <td class="px-4 py-2 ">{{ $employee->phone }}</td>
                        <td class="px-4 py-2 ">{{ $employee->email }}</td>
                        <td class="px-4 py-2 ">{{ $employee->salary }}</td>
                        <td class="px-4 py-2 flex justify-center">
                            <a href="#" class="editEmployee" data-id="{{ $employee->id }}"><i class="text-xl fa fa-pencil fa-fw"></i></a>
                            <a href="{{ route('stuff.delete', ['id' => $employee->id]) }}" class=""><i class="text-xl fa fa-trash-o fa-fw"></i></a>
                            <a href="{{ route('stuff.report', ['id' => $employee->id]) }}" class=""><i class="text-xl fa fa-eye fa-fw text-x"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Edit Employee</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                  <form class="grid grid-cols-1 gap-4"  action="{{ route('stuff.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="empid" id="empid">
                        <div class="flex items-center">
                            <label for="employeeName" class="w-1/2  mr-4">Employee Name <stong class="text-red-600 text-2xl">*</strong></label>
                            <input type="text" id="empname" name="employeeName"
                                class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div class="flex items-center">
                            <label for="designation" class="w-1/2  mr-4">Employee Designation <stong class="text-red-600 text-2xl">*</strong></label>
                            <input type="text" id="empdesig" name="designation"
                                class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div class="flex items-center">
                            <label for="mobileNumber" class="w-1/2  mr-4">Mobile Number <stong class="text-red-600 text-2xl">*</strong></label>
                            <input type="tel" id="empphn" name="mobileNumber"
                                class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div class="flex items-center">
                            <label for="email" class="w-1/2  mr-4">E-mail ID <stong class="text-red-600 text-2xl">*</strong></label>
                            <input type="email" id="empemail" name="email"
                                class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div class="flex items-center">
                            <button id="showPasswordButton" class="bg-blue-500 text-white px-4 py-2 rounded-md">Show Password Field</button>
                        </div>
                        <div id="passwordFieldContainer" class="items-center hidden">
                            <label for="password" class="w-1/2  mr-4">Password <stong class="text-red-600 text-2xl">*</strong></label>
                            <input type="text" id="emppassword" name="password"
                                class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Type new password ">
                        </div>
                        <div class="flex items-center">
                            <label for="address" class="w-1/2  mr-4">Address</label>
                            <textarea id="empaddress" name="address" rows="2"
                                class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
                        </div>
                        <div class="flex items-center">
                            <label for="salary" class="w-1/2  mr-4">Salary</label>
                            <input type="number" id="empsalary" name="salary"
                                class="rounded-md border border-gray-400 px-4 py-1 w-full focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div class="flex items-start">
                            <label for="salary" class="w-1/2  mr-4">Permission</label>
                            <div>
                                <fieldset class="flex gap-2">
                                    <div>
                                        <input type="checkbox" id="entry_edit" name="permissions[]" value="entry" />
                                        <label for="entry">Entry</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="edit_edit" name="permissions[]" value="edit" />
                                        <label for="edit">Edit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="view_edit" name="permissions[]" value="view" />
                                        <label for="view">View</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="print_edit" name="permissions[]" value="print" />
                                        <label for="print">Print</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="profit_edit" name="permissions[]" value="profit" />
                                        <label for="profit">Profit</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="delete_edit" name="permissions[]" value="delete" />
                                        <label for="delete">Delete</label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none">Submit</button>
                    </form>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary clsbtn" data-bs-dismiss="modal">Close</button>
                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                    
            </div>
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

           $('.clsbtn').click(function() {
                $('.modal').modal('hide');
            });


            // $('#typetable').DataTable();
            $('.editEmployee').click(function(event) {
                event.preventDefault(); // Prevent the default action of following the link

                var employeeId = $(this).data('id');
                var url = "{{ route('stuff.edit', ['id' => ':id']) }}".replace(':id', employeeId);

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        // Handle the response data as needed
                        // console.log(response);
                        $('#empname').val(response.name);
                        $('#empdesig').val(response.designation);
                        $('#empphn').val(response.phone);
                        $('#empemail').val(response.email);
                        $('#empaddress').val(response.address);
                        $('#empsalary').val(response.salary);
                        $('#empid').val(response.id);
                        var permissionsArray = response.permission.split(',');
                        // console.log(permissionsArray);
                        $.each(permissionsArray, function(index, permission) {
                            // console.log(permission);
                            if ($(`#${permission}_edit`).length) { // Corrected concatenation
                                $(`#${permission}_edit`).prop('checked', true);
                            }
                        });

                        $('.modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('There was a problem with the AJAX request:', error);
                    }
                });
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
        document.getElementById('showPasswordButton').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('passwordFieldContainer').classList.remove('hidden');
            document.getElementById('passwordFieldContainer').classList.add('flex');
            this.style.display = 'none'; // Hide the button after clicking
        });
    </script>
    
</x-app-layout>