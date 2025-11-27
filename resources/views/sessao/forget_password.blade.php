@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <form action="{{ route('forgetPassword.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="seu@email.com" class="form-control" required>
        </div>
        <br>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Enviar" />
        </div>
    </form>

    <p class="text-sm text-gray-600 text-center mt-4">
        <a href="{{ route('login') }}" class="text-decoration-none">
            Retornar para login
        </a><br>
    </p>
@endsection