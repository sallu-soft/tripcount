<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.head')
    <title>Document</title>
</head>
<body>
   
    <div class="container">
        {{-- @php
            dd($agent->description);
        @endphp --}}
        <form action="{{ route('agent.update', ['id' => $agent->id]) }}" method="post">
            @csrf <!-- Add this line to include CSRF protection in Laravel -->
            <div class="row">
                <div class="form-group col">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{$agent->name}}" required>
                </div>

                <div class="form-group col">
                    <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="{{$agent->phone}}" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter a description" required>{!! $agent->description !!}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>