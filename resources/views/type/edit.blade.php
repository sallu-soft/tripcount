<x-app-layout>
   
    <div class="container">
        {{-- @php
            dd($agent->description);
        @endphp --}}
        <form autocomplete="off" action="{{ route('type.update', ['id' => $type->id]) }}" method="post">
            @csrf <!-- Add this line to include CSRF protection in Laravel -->
            <div class="row">
                <div class="form-group col">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{$type->name}}" required>
                </div>

            </div>


            <button type="submit" class="px-8 py-2 bg-indigo-700 rounded-xl text-white">Update</button>
        </form>
    </div>
</x-app-layout>