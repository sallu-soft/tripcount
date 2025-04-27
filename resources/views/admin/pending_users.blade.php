@include('layouts.head')

{{-- @section('content') --}}
<div class="container">
    <h1>Pending User Registrations</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingUsers as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    @if ($user->is_approved == 0)
                        <td>
                            <form action="{{ route('admin.approve_user', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                        </td>
                    @else
                        <td>
                            <span class="text-success">
                                <i class="fas fa-check-circle"></i> Approved
                            </span>
                        </td>
                    @endif
                </tr>
            @endforeach
        
        </tbody>
    </table>
</div>
{{-- @endsection --}}
