<x-app-layout>
   
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-2 flex items-center gap-6">
            <p class="font-bold text-2xl">List of AirLines</p>
            <button
                class="py-2 px-4 border-green-700 hover:bg-green-700 hover:text-white duration-300 border-2 text-green-700  rounded-2xl font-bold "
                onchange="toggleVisibility()" id="addnewbtn">Add Airlines</button>
        </div>
        <div id="airlines">
            <h1 class="mb-4 font-semibold w-[90%] md:w-[60%] mx-auto text-lg">Add Airlines</h1>

            <div class="addagent w-[90%] md:w-[60%] p-7 mx-auto bg-white shadow-lg rounded-lg">
                <form action="/addairline" method="POST" autocomplete="off">
                    @csrf <!-- Add this line to include CSRF protection in Laravel -->
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-10">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Code:</label>
                            <input type="text" id="code" name="code" class="mt-1 p-2 w-full border " placeholder="Enter code" required>
                        </div>
        
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Short Name:</label>
                            <input type="text" id="short_name" name="short_name" class="mt-1 p-2 w-full border " placeholder="Enter short name" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-10">
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Full Name:</label>
                            <input type="text" id="full_name" name="full_name" class="mt-1 p-2 w-full border " placeholder="Enter an full name" required>
                        </div>
                    </div>
                
        
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg">Submit</button>
                </form>
            </div>
        </div>
    
        <div class="allagents mt-8 shadow-lg bg-white p-3 rounded-lg">
            <table class="table table-hover no-wrap" id="agenttable">
                <thead class="bg-[#7CB0B2]">
                    <tr>
                        <th class="px-4 py-2">Serial</th>
                        <th class="px-4 py-2">Code</th>
                        <th class="px-4 py-2">Short Name</th>
                        <th class="px-4 py-2">Full Name</th>
                        
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($airlines as $index => $airline)
                       {{-- @php
                           dd($airline);
                       @endphp --}}
                        <tr>
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $airline->ID }}</td>
                            <td class="px-4 py-2">{{ $airline->Short }}</td>
                            <td class="px-4 py-2">{{ $airline->Full }}</td>
                          
                            <td class="px-4 py-2 flex">
                                <a href="{{ route('airline.edit', ['id' => encrypt($airline->ID)]) }}" class=" text-green-800 px-2 py-1 rounded-md"><i class="text-xl fa fa-pencil fa-fw"></i></a>
                                {{-- <a href="{{ route('airline.delete', ['id' => $airline->ID]) }}" class="text-red-900 px-2 py-1 rounded-md"><i class="text-xl fa fa-trash-o fa-fw"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                autoclose: true
            });
    
            $('.select2').select2({
                theme:'classic',
            });

            // $('#agenttable').DataTable(
            //     {
            //         responsive: true
            //     }
            // );
            new DataTable('#agenttable', {
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            }
})
        
        });

        
    </script>
    <script>
        
        var addnewBtn = document.getElementById('addnewbtn');
        var addAirlines = document.getElementById('airlines');
        addAirlines.style.display = 'none';

        addnewBtn.addEventListener('click', function() {
            toggleVisibility();
        });

        function toggleVisibility() {
            if (addAirlines.style.display === 'none') {
                addAirlines.style.display = 'block';
            } else {
                addAirlines.style.display = 'none';
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#code').on('change', function() {
                
                var codeValue = $(this).val().trim();
    
                if (codeValue !== '') {
                    $.ajax({
                        url: '/findairlinefree',
                        method: 'GET', // or 'GET', 'PUT', 'DELETE', etc.
                        data: { code: codeValue },
                        success: function(response) {
                            if(response.is_free === false){
                                
                                $('#code').val('');
                                alert('This Code is occupied by '+ response.airline_name)
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>