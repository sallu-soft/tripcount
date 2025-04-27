<x-app-layout>
    @if(session('employee'))
    @php
        $employee = session('employee');
        // dd($employee['permission']);
        $permissionString = $employee['permission'];
        $permissionsArray = explode(',', $permissionString);
        $role = $employee['role'];
        // dd($role, $employee);
    @endphp
    @else
        @php
            $permissionsArray = ['entry', 'edit', 'delete', 'print', 'view'];
            $role = 'admin';
        @endphp
    @endif
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="mb-4 w-[100%] lg:w-[60%] mx-auto font-bold text-3xl">Add Type</h1>

        <div class="addagent w-[100%] lg:w-[60%] mx-auto bg-white p-5 shadow-lg rounded-lg">
            @if(in_array('entry', $permissionsArray))
            <form autocomplete="off" action="/addtype" method="post" class="flex gap-14 items-center">
                @csrf <!-- Add this line to include CSRF protection in Laravel -->
                <div class="row w-full">
                    <div class="form-group col">
                        <label for="name">Type Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                </div>
    
                <button type="submit" class="mt-3 px-8 py-2 bg-black rounded-xl text-white h-[40px]">Submit</button>
            </form>
            @else
            <div class="alert alert-warning">
                Don't have permission to entry
            </div>
        @endif
        </div>

        <div class="bg-white shadow-md p-6 my-3 w-full md:w-[60%] mx-auto">
            <form method="GET" action="{{ route('type.index') }}" class=" flex justify-end mb-3">
                <div class="flex items-center gap-3">
                    <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
                    <button type="submit" class="bg-black px-5 py-1.5 rounded text-white">Search</button>
                </div>
            </form>
            <table class="table table-hover no-wrap " id="typetable">
                <thead class="bg-[#5dc8cc]">
                    <tr>
                        <th scope="col" class="px-4 py-2 ">Serial</th>
                        <th scope="col" class="px-4 py-2 ">Name</th>
                        
                        <th scope="col" class="px-4 py-2 flex justify-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($types as $index => $type)
                        <tr>
                            <th scope="row" class="px-4 py-2">{{ $index + 1}}</th>
                            <td class="px-4 py-2 ">{{ $type->name }}</td>
                            <td class="px-4 py-2 flex justify-center">
                                @if(in_array('edit', $permissionsArray))
                                <a href="{{ route('type.edit', ['id' => encrypt($type->id)]) }}" class=""><i class="text-xl fa fa-pencil fa-fw"></i></a>
                                @endif
                                @if(in_array('delete', $permissionsArray))
                                <a onclick="confirmDelete('{{ route('type.delete', ['id' => $type->id]) }}')" href="" class=""><i class="text-xl fa fa-trash-o fa-fw"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $types->links() }}
        </div>

    </div>
    <script>
        function confirmDelete(deleteUrl) {
            // Display a confirmation dialog
            const isConfirmed = window.confirm("Are you sure you want to delete?");

            // If the user confirms, proceed with the delete action
            if (isConfirmed) {
                window.location.href = deleteUrl;
            }
        }
        $(document).ready(function() {
            $('.datepicker').datepicker({
                autoclose: true
            });
    
            $('.select2').select2({
                theme:'classic',
            });

            // $('#typetable').DataTable();

        
        });

        
    </script>
</x-app-layout>