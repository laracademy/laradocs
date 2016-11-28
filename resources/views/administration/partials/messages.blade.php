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