<x-app-layout>
   
    

    <div class="container">
        {{-- @php
            dd($agent->description);
        @endphp --}}
        <form action="{{ route('airline.update', ['id' => $airline->ID]) }}" method="post" autocomplete="off">
            @csrf <!-- Add this line to include CSRF protection in Laravel -->
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-10">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Code:</label>
                    <input type="text" id="code" name="code" class="mt-1 p-2 w-full border" value="{{$airline->ID}}" placeholder="Enter code" required readonly>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Short Name:</label>
                    <input type="text" id="short_name" name="short_name" class="mt-1 p-2 w-full border " value="{{$airline->Short}}" placeholder="Enter short name" required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-10">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" class="mt-1 p-2 w-full border " value="{{$airline->Full}}" placeholder="Enter an full name" required>
                </div>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
        </form>
    </div>
    
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