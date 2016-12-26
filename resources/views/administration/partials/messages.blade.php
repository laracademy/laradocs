@if(session()->has('success'))
    <div class="alert alert-success">
        <h4>
            Nice Work!
        </h4>
        @foreach(session()->get('success') as $message)
            <p>
                {{ $message }}
            </p>
        @endforeach
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <h4>
            Oh No!
        </h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif