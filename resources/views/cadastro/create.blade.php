@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            Criar Conta
        </li>
    </ol>
</nav>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cadastro.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <div>
                <input type="radio" name="tipo" value="cliente" checked><label>Cliente</label>
            </div>
            <div>
                <input type="radio" name="tipo" value="expositor"><label>Expositor</label>
            </div>
            <div>
                <input type="radio" name="tipo" value="organizador"><label>Organizador</label>
            </div>
            <br>
        </div>
        
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="name" id="name" placeholder="nome" class="form-control" required>
        </div>
 
        <div class="form-group">
            <label for="email">E-mail :</label>
            <input type="email" name="email" id="email" placeholder="seu@email.com" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="phone">Telefone:</label>
            <input 
                type="text"
                name="phone"
                id="phone"
                placeholder="(00) 00000-0000"
                class="form-control"
                value="{{ old('phone', $user->phone) }}"
            >
        </div>

        <div class="form-group">
            <label for="password" class="block text-gray-700 mb-1">Senha:</label>
            <input type="password" name="password" id="password" placeholder="********" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password" class="block text-gray-700 mb-1">Digite a senha novamente:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********" class="form-control" required>
        </div>

        <br>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Criar Conta" />
        </div>
    </form>

    <p class="text-sm text-gray-600 text-center mt-4">
        Já tem conta? <a href="#" class="text-red-500 underline">Entrar</a>
    </p>
@endsection