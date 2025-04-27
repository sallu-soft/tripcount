<x-app-layout>
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="mb-4 text-2xl font-bold text-red-700">Add U Umrah</h1>

        <div class="addagent bg-white shadow-lg rounded-lg p-4">
            <form action="/addtype" method="post">
                @csrf <!-- Add this line to include CSRF protection in Laravel -->
                <div class="row">
                    <div class="form-group col">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                </div>
    
                <button type="submit" class="px-8 py-2 bg-indigo-700 rounded-xl text-white">Submit</button>
            </form>
        </div>

        <div class="bg-white shadow-md p-6 my-3">
            <table class="table table-striped table-bordered table-hover no-wrap" id="typetable">
                <thead>
                    <tr>
                        <th scope="col" class="px-4 py-2 border border-gray-300">Serial</th>
                        <th scope="col" class="px-4 py-2 border border-gray-300">Name</th>
                        
                        <th scope="col" class="px-4 py-2 border border-gray-300">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($types as $index => $type)
                        <tr>
                            <th scope="row" class="px-4 py-2 border border-gray-300">{{ $index + 1 }}</th>
                            <td class="px-4 py-2 border border-gray-300">{{ $type->name }}</td>
                            <td class="px-4 py-2 border border-gray-300">
                                <a href="{{ route('type.edit', ['id' => encrypt($type->id)]) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('type.delete', ['id' => $type->id]) }}" class="btn btn-danger">Delete</a>
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

            $('#typetable').DataTable();

        
        });

        
    </script>
</x-app-layout>