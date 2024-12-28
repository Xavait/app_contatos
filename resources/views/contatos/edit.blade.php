@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h1>Editar Contato</h1>
        <form action="{{ route('contatos.update', $contato) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $contato->nome }}" required>
            </div>
            <div class="form-group">
                <label for="contato">Contato</label>
                <input type="text" name="contato" class="form-control" value="{{ $contato->contato }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $contato->email }}" required>
            </div>

            <a href="{{ route('contatos.index') }}" class="btn btn-secondary mt-3">Voltar</a>

            <button type="submit" class="btn btn-warning mt-3">Atualizar</button>
        </form>
    </div>
@endsection
