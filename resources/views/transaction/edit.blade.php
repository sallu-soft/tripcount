<x-app-layout>
   
    
    <div class="container">
        {{-- @php
            dd($transaction->description);
        @endphp --}}
        <form autocomplete="off" action="{{ route('transaction.update', ['id' => $transaction->id]) }}" method="post">
            @csrf <!-- Add this line to include CSRF protection in Laravel -->
            <div class="row">
                <div class="form-group col">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{$transaction->name}}" required>
                </div>

            </div>
            
            <div class="row">
                <div class="form-group col">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter a description" required>{!! $transaction->description !!}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
</x-app-layout>