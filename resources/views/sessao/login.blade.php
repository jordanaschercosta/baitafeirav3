@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="max-width: 400px; margin: 0 auto; padding: 20px;">

    <div class="text-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="" style="max-width: 150px;">
    </div>

    <form action="{{ route('login.submit', ['redirect' => request()->query('redirect') ]) }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="seu@email.com" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" placeholder="********" class="form-control" required>
        </div>

        <p class="text-start mb-3">
            <a href="{{ route('esqueci-a-senha') }}" style="text-decoration: underline;">Esqueceu sua senha?</a>
        </p>

        <div class="form-group mb-3">
            <input type="submit" class="btn btn-lg w-100 btn-custom" value="Entrar" />
        </div>
    </form>

    <p class="text-center mt-3">
        Não possui uma conta ainda? 
        <a href="{{ route('cadastro') }}" class="text-red-500 underline">Criar uma conta</a>
    </p>

</div>
@endsection
