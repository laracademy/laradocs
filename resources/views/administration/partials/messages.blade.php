@if(session()->has('success'))
    <div class="alert alert-success">
        <h4>
            Nice Work!
        </h4>
        @foreach(session()->get('success') as $message)
            {{ $message }}
        @endforeach
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <h4>
            Sorry
        </h4>
        @foreach ($errors->all() as $message)
            {{ $message }}
        @endforeach
    </div>
@endif