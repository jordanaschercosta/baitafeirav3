@extends('layouts.app')

@section('title', 'Cadastrar')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('resetPassword.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $userId }}">
        <div class="form-group">
            <label for="password" class="block text-gray-700 mb-1">Senha *</label>
            <input type="password" name="password" id="password" placeholder="********" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="block text-gray-700 mb-1">Digite a senha novamente *</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********" class="form-control" required>
        </div>

        <br>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Salvar" />
        </div>
    </form>
@endsection