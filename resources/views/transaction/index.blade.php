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
        <div class="container mt-5 xl:w-[50%] w-[80%] mx-auto">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="mb-4 text-xl font-semibold">Add Transaction Method</h1>
    
            <div class="addagent">
                @if(in_array('entry', $permissionsArray))
                <form autocomplete="off" action="/transaction_add" method="post" class="flex gap-4 items-center shadow-lg p-3 rounded-sm bg-white mb-3" >
                    
                    @csrf <!-- Add this line to include CSRF protection in Laravel -->
                    <div class="grid grid-cols-2 w-[80%] gap-x-5">
                        <div class="row">
                            <div class="form-group col">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                            </div>
            
                        
                        </div>
                    
                        <div class="row">
                            <div class="form-group col">
                                <label for="description">Description:</label>
                                <textarea class="form-control" rows="1" id="description" name="description" placeholder="Enter a description"></textarea>
                            </div>
                        </div>
                    </div>
        
                    <button type="submit" class="px-4 py-2 mt-3 bg-black text-white rounded-md font-semibold ">Submit</button>
                </form>
                @else
                    <div class="alert alert-warning">
                        Don't have permission to entry
                    </div>
                @endif
            </div>
    
        <div class="allagents bg-white shadow-lg p-3">
                <table class="table shadow-lg" id="transaction_table">
                    <thead class="bg-[#7CB0B2]">
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Name</th>
                         
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $index => $transaction)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $transaction->name }}</td>
                               
                                <td>{{ $transaction->description }}</td>
                                <td>
                                    @if(in_array('edit', $permissionsArray))
                                    <a href="{{ route('transaction.edit', ['id' => encrypt($transaction->id)]) }}" class=""><i class="fa fa-pencil fa-fw text-xl"></i></a>
                                    @endif
                                    @if(in_array('delete', $permissionsArray))
                                    <a href="" onclick="confirmDelete('{{ route('transaction.delete', ['id' => $transaction->id]) }}')" class=""><i class="fa fa-trash fa-fw text-xl"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
    
        </div>
        <script type="text/javascript">
            function confirmDelete(deleteUrl) {
            // Display a confirmation dialog
            const isConfirmed = window.confirm("Are you sure you want to delete?");

            // If the user confirms, proceed with the delete action
            if (isConfirmed) {
                window.location.href = deleteUrl;
            }
        }
            $('#transaction_table').DataTable();
        </script>
</x-app-layout>