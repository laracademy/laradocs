@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        <strong>Nice Work!</strong> {{ session()->get('success') }}
    </div>
@endif