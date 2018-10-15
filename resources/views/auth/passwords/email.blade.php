@extends('layouts.auth')

@section('content')

    <form class="forget-form" action="{{ url('/password/email') }}" method="post">

        {{ csrf_field() }}

        <h3 class="font-green">Esqueceu a senha?</h3>
        <p> Informe seu e-mail para enviarmos uma nova. </p>

        <div class="form-group">
            <input id="email" class="form-control placeholder-no-fix" type="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required/>
        </div>

        <div class="form-actions">
            <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
        </div>

    </form>

@endsection
