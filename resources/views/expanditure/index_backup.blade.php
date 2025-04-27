<x-app-layout>

    <main class="mx-auto w-[85%] ">
        <div id="addAgent mt-8">
            <h1 class="mb-4 text-3xl w-[90%] md:w-[60%] mx-auto font-bold">Add Expenditure</h1>
            <div class="addagent w-[90%] md:w-[60%] p-7 mx-auto bg-white shadow-lg rounded-lg">
                
                <form action="/add_expenditure_main" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-10">
                        <div class="mb-4">
                            <label for="branch" class="block text-sm font-medium text-gray-700">Banch:</label>
                            <input type="text" id="branch" name="branch" class="mt-1 py-1 px-2 w-full border " placeholder="Enter your name" value="{{Auth::user()->name}}" readonly>
                        </div>
        
                        <div class="mb-4">
                            <label for="transaction_date" class="block text-sm font-medium text-gray-700">Transaction Date:</label>
                            <input type="date" id="transaction_date" name="transaction_date" class="mt-1 px-2 py-1 w-full border " required placeholder="Enter your phone number" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-10">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                            {{-- <div class="flex gap-2">
                                <select id="from_account" name="name" class="mt-1 px-2 py-1 w-[39%] border" placeholder="Enter a from_account" required>
                                    <option value="">Select</option>
                                    <option value="admin">Admin</option>
                                    <option value="stuff">Stuff</option>
                                    <option value="others">Others</option>
                                </select>
                                <select id="stuff_list" name="from_account" class="mt-1 px-2 py-1 w-[59%] border" placeholder="Enter a from_account">
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="from_account" value="admin" class="mt-1 px-2 py-1 w-full border "  id="admin_part" readonly >
                                <input type="text" name="from_account" class="mt-1 px-2 py-1 w-full border "  id="other_part" >
                            </div> --}}
                            <div class="flex gap-2">
                                <select id="from_account" name="account_type" class="mt-1 px-2 py-1 w-[39%] border" placeholder="Enter a from_account" required>
                                    <option value="">Select</option>
                                    <option value="admin">Admin</option>
                                    <option value="stuff">Stuff</option>
                                    <option value="others">Others</option>
                                </select>
                            
                                <select id="stuff_list" name="from_account" class="mt-1 px-2 py-1 w-[59%] border " placeholder="Enter a from_account">
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            
                                <input type="text" id="admin_part" value="admin" class="mt-1 px-2 py-1 w-full border " readonly>
                                <input type="text" id="other_part" class="mt-1 px-2 py-1 w-full border ">
                            
                                <!-- Hidden input field to hold the selected from_account value -->
                                <input type="hidden" name="from_account" id="selected_account">
                            </div>
                            
                            
                        </div>
            
                        <div class="mb-4">
                            <label for="towards" class="block text-sm font-medium text-gray-700">Towards:</label>
                            <div class="flex items-center gap-2">
                            <select id="towards" name="towards" class="mt-1 px-2 py-1 w-11/12 border" placeholder="Enter a to_account" required>
                                <option value="">Towards</option>
                                @foreach ($expenditures as $expenditure)
                                    <option value="{{ $expenditure->id }}">{{ $expenditure->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                               +
                            </button>
                        </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-10">
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount:</label>
                            <input type="text" id="amount" name="amount" class="mt-1 px-2 py-1 w-full border " placeholder="Enter a amount" required>
                        </div>
                        <div class="mb-4">
                            <label for="remarks" class="block text-sm font-medium text-gray-700">Method:</label>
                            <select id="method" name="method" class="mt-1 px-2 py-1 w-full border" placeholder="Enter a method" required>
                                <option value="">Method</option>
                                @foreach ($transactions as $transfer)
                                    <option value="{{ $transfer->id }}">{{ $transfer->name }}</option>
                                @endforeach
                            </select>
                        </div>
            
                      
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-10">
                        
                        <div class="mb-4">
                            <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks:</label>
                            <textarea id="remarks" name="remarks" class="mt-1 px-2 py-1 w-full border " placeholder="Enter an remarks" ></textarea>
                        </div>
            
                      
                    </div>
                   
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg">Submit</button>
                </form>
            </div>
        </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Expenditure</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form method="post" action="{{ route('add_expenditure_towards')}}">
                @csrf
                <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name" placeholder="Reason" required>
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Description" name="description">
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-2">Submit</button>
           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
</div>


        {{-- <div class="allagents mt-8 shadow-lg bg-white rounded-lg">
            <table class="table table-striped table-hover no-wrap w-full" id="agenttable">
                <thead class="bg-[#7CB0B2]">
                    <tr>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Type</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Amount</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-400">
                        <tr>
                            
                            <td class="px-4 py-2">21-03-2024</td>
                            <td class="px-4 py-2"> Office Rent </td>
                            <td class="px-4 py-2">Jane Alam</td>
                            <td class="px-4 py-2">70000</td>
                            <td class="px-4 py-2">Delete</td>
                            
                        </tr>
                        <tr>
                            
                            <td class="px-4 py-2">21-03-2024</td>
                            <td class="px-4 py-2"> Office Rent </td>
                            <td class="px-4 py-2">Jane Alam</td>
                            <td class="px-4 py-2">70000</td>
                            <td class="px-4 py-2">Delete</td>
                            
                        </tr>
                        <tr>
                            
                            <td class="px-4 py-2">21-03-2024</td>
                            <td class="px-4 py-2"> Office Rent </td>
                            <td class="px-4 py-2">Jane Alam</td>
                            <td class="px-4 py-2">70000</td>
                            <td class="px-4 py-2">Delete</td>
                            
                        </tr>
                        
                </tbody>
            </table>
        </div> --}}
        <div class=" mt-8 shadow-lg bg-white rounded-lg">
            <table class="table table-striped table-hover no-wrap w-full" id="agenttable">
                <thead class="bg-[#7CB0B2]">
                    <tr>
                        <th class="px-4 py-2 text-left">Serial</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">From</th>
                        <th class="px-4 py-2 text-left">To Account</th>
                        <th class="px-4 py-2 text-left">Towards</th>
                        <th class="px-4 py-2 text-left">Amount</th>
                        <th class="px-4 py-2 text-left">Method</th>
                        <th class="px-4 py-2 text-left">Remark</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-400">
                    @foreach ($expendituresmain as $index=>$expan)
                        <tr>
                            <td class="px-4 py-2"> {{$index + 1}} </td>
                            <td class="px-4 py-2">{{$expan->date}}</td>
                            <td class="px-4 py-2">{{$expan->receive_from}}</td>
                            <td class="px-4 py-2"> @foreach ($employees as $index => $emp)
                                @if($emp->id == $expan->from_account)
                                     {{$emp->name}}
                                
                                @endif
                            @endforeach</td>
                            <td class="px-4 py-2">
                                @foreach ($expenditures as $index => $ex)
                                    @if($ex->id == $expan->toward)
                                         {{$ex->name}}
                                    
                                    @endif
                                @endforeach
                                </td>
                            <td class="px-4 py-2">{{$expan->amount}}</td>
                            <td class="px-4 py-2">
                                @foreach ($transactions as $index => $tran)
                                @if($tran->id == $expan->method)
                                     {{$tran->name}}
                                
                                @endif
                            @endforeach</td>
                            <td class="px-4 py-2">{{$expan->remark}}</td>
                            <td class="px-4 py-2">
                                {{-- <a href="{{ route('moneytransfer.edit', ['id' => $transfer->id]) }}" class=" px-2 py-1 rounded-md"><i class="text-xl fa fa-eye fa-fw"></i></a>
                                <a href="{{ route('moneytransfer.delete', ['id' => $transfer->id]) }}" class=" px-2 py-1 rounded-md"><i class="text-xl fa fa-trash-o fa-fw"></i></a> --}}
                            </td>
                        <tr>
                    @endforeach
                       
                </tbody>
            </table>
        </div>
      </main>
     

      <script type="text/javascript">
            $(document).ready(function(){
                $('#stuff_list').hide();
                $('#admin_part').hide();
                $('#other_part').hide();

                $('#from_account').change(function(){
                    var account = $(this).val();
                    $('#stuff_list').hide();
                    $('#admin_part').hide();
                    $('#other_part').hide();
                    $('#selected_account').val('');
                    // console.log(account);
                    if(account == 'admin'){
                        $('#admin_part').show();
                        $('#selected_account').val('admin');
                    } else if(account == 'stuff'){
                        $('#stuff_list').show();
                        $('#selected_account').val($('#stuff_list').val());
                    } else if(account == 'others'){
                        $('#other_part').show();
                        $('#selected_account').val($('#other_part').val());
                    }
                });

                $('#stuff_list').change(function(){
                    $('#selected_account').val($(this).val());
                });

                $('#other_part').on('input', function(){
                    $('#selected_account').val($(this).val());
                });
            });

      </script>
</x-app-layout>