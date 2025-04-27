@php
    $total_tk = 0;
@endphp
<div class="container">
    <h2 class="m-5">Expenditure List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                {{-- <th>Company Name</th> --}}
                <th>Date</th>
                <th>Received From</th>
                <th>From Account</th>
                <th>Towards</th>
                <th>Method</th>
                <th>Remark</th>
                <th>Amount</th>

                {{-- <th>Created At</th>
                <th>Updated At</th>
                <th>User</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($expenditures as $expenditure)
            @php
                $total_tk += $expenditure->amount;
            @endphp
            <tr>
                {{-- <td>{{ $expenditure->id }}</td> --}}
                {{-- <td>{{ $expenditure->company_name }}</td> --}}
                <td>{{ $expenditure->date }}</td>
                <td>{{ $expenditure->receive_from }}</td>
                <td>{{ $expenditure->from_account }}</td>
                <td>{{ $expenditure->toward }}</td>
                <td>{{ $expenditure->method }}</td>
                <td>{{ $expenditure->remark ?? 'N/A' }}</td>
                <td>{{ $expenditure->amount }}</td>

                {{-- <td>{{ $expenditure->created_at }}</td>
                <td>{{ $expenditure->updated_at }}</td>
                <td>{{ $expenditure->user }}</td> --}}
            </tr>
            @endforeach
            <tr>
                <td colspan="6"><b>TOTAL<b></td>
                <td><b> {{ $total_tk }} </b></td>
            </tr>
        </tbody>
    </table>
</div>