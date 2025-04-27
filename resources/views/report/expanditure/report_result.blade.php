<div class="container">
    <h2>Expenditure List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Company Name</th>
                <th>Date</th>
                <th>Received From</th>
                <th>From Account</th>
                <th>Towards</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Remark</th>
                {{-- <th>Created At</th>
                <th>Updated At</th>
                <th>User</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($expenditures as $expenditure)
            <tr>
                {{-- <td>{{ $expenditure->id }}</td> --}}
                <td>{{ $expenditure->company_name }}</td>
                <td>{{ $expenditure->date }}</td>
                <td>{{ $expenditure->receive_from }}</td>
                <td>{{ $expenditure->from_account }}</td>
                <td>{{ $expenditure->toward }}</td>
                <td>{{ $expenditure->amount }}</td>
                <td>{{ $expenditure->method }}</td>
                <td>{{ $expenditure->remark ?? 'N/A' }}</td>
                {{-- <td>{{ $expenditure->created_at }}</td>
                <td>{{ $expenditure->updated_at }}</td>
                <td>{{ $expenditure->user }}</td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>