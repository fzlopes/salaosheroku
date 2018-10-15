@extends('layouts.auth')

@section('content')

    <form class="login-form" role="form" method="POST" action="{{ url('/password/reset') }}">

        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <h3 class="form-title font-green">Resetar senha</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->has('email'))
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span> {{ $errors->first('email') }} </span>
            </div>
        @endif

        @if ($errors->has('password'))
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span> {{ $errors->first('password') }} </span>
            </div>
        @endif


        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">E-mail</label>
            <input class="form-control form-control-solid placeholder-no-fix" id="email" type="email" placeholder="E-mail" name="email" value="{{ $email or old('email') }}" required autofocus>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Senha" name="password" required>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Confirma password</label>
            <input class="form-control form-control-solid placeholder-no-fix" id="password-confirm" type="password" autocomplete="off" placeholder="Confirma senha" name="password_confirmation" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn green uppercase">Resetar senha</button>
        </div>

    </form>

@endsection
