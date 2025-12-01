@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            Minha Conta
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

<form action="{{ route('cadastro.update') }}" method="POST">
    @csrf
    @method('PUT')

    {{-- NOME --}}
    <div class="form-group mb-3">
        <label for="name">Nome:</label>
        <input 
            type="text"
            name="name"
            id="name"
            class="form-control"
            value="{{ old('name', $user->name) }}"
            required
        >
    </div>

    {{-- EMAIL --}}
    <div class="form-group mb-3">
        <label for="email">E-mail:</label>
        <input 
            type="email"
            name="email"
            id="email"
            class="form-control"
            value="{{ $user->email }}"
            readonly
        >
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

    {{-- PASSWORD --}}
    <div class="form-group mb-3">
        <label for="password">
            Nova senha (opcional)
        </label>
        <input 
            type="password"
            name="password"
            id="password"
            placeholder="Deixe em branco para manter a senha atual"
            class="form-control"
        >
    </div>

    {{-- CONFIRMA --}}
    <div class="form-group mb-4">
        <label for="password_confirmation">
            Confirmar nova senha
        </label>
        <input 
            type="password"
            name="password_confirmation"
            id="password_confirmation"
            class="form-control"
        >
    </div>


    {{-- BOTÃO --}}
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">
            Salvar Alterações
        </button>
    </div>

</form>


<p class="text-sm text-gray-600 text-center mt-4">
    Deseja sair?
    <a href="{{ route('logout') }}" 
       class="text-danger text-decoration-underline"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Sair da conta
    </a>
</p>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>

@endsection
