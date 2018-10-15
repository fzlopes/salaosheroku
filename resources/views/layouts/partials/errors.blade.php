@if ($errors->count() > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <strong>Erro:</strong> {{ $error }}
        </div>
    @endforeach
@endif