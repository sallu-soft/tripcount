<x-guest-layout>
    @include('layouts.head')
   
    {{-- <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form> --}}
    
    <div class="h-screen bg-gray-50 flex flex-col items-center">
        <h1 class="mt-[30px] text-3xl font-semibold mb-6">Admin Login</h1>
        <div class="py-6 px-8 h-80 w-[30%] bg-white rounded shadow-xl">
          <form method="POST" action="{{ route('admin.login') }}">
            @csrf
           
    
            <div>
              <label for="email" class="block text-gray-800 font-bold">Email:</label>
              <input type="email" name="email" id="email" requried placeholder="@email" class="w-full border border-gray-300 py-2 pl-3 rounded mt-2 outline-none focus:ring-indigo-600 :ring-indigo-600" />
    
              
            </div>
            <div>
              <label for="password" class="block text-gray-800 font-bold">Password:</label>
              <input type="password" name="password" requried id="password" placeholder="@password" class="w-full border border-gray-300 py-2 pl-3 rounded mt-2 outline-none focus:ring-indigo-600 :ring-indigo-600" />
    
              
            </div>
            <button type="submit" class="cursor-pointer py-2 px-4 block mt-6 bg-indigo-500 text-white font-bold w-full text-center rounded">Login</button>
          </form>
        </div>
      </div>
</x-guest-layout>
