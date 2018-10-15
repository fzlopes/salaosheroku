@extends('layouts.auth')

@section('content')

    <form class="login-form" role="form" method="POST" action="{{ url('/login') }}">

        {{ csrf_field() }}

        <h3 class="form-title font-green">Entrar</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->has('email') || $errors->has('password'))
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span> {{ $errors->first('email') }} </span>
            </div>
        @endif

        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> E-mail ou password inválido. </span>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">E-mail</label>
            <input class="form-control form-control-solid placeholder-no-fix" id="email" type="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn green uppercase">Login</button>
            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember_me" />Lembrar-me
                <span></span>
            </label>
            <a href="javascript:;" id="forget-password" class="forget-password">Esqueceu a senha?</a>
        </div>

    </form>

    <form class="forget-form" action="{{ url('/password/email') }}" method="post">

        {{ csrf_field() }}

        <h3 class="font-green">Esqueceu a senha?</h3>
        <p> Informe seu e-mail para enviarmos uma nova. </p>

        <div class="form-group">
            <input id="email" class="form-control placeholder-no-fix" type="email" placeholder="E-mail" name="email" required/>
        </div>

        <div class="form-actions">
            <button type="button" id="back-btn" class="btn green btn-outline">Voltar</button>
            <button type="submit" class="btn btn-success uppercase pull-right">Enviar</button>
        </div>

    </form>

@endsection
