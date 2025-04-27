@include('layouts.head')
{{-- @section('content') --}}
<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Welcome to the admin panel.</p>
    <a href="{{ route('admin.pending_users') }}" class="btn btn-primary">View Pending Users</a>
</div>
{{-- @endsection --}}