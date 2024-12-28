@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h1>Criar Contato</h1>
        <form action="{{ route('contatos.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
      
    </div>

    <div class="form-group">
        <label for="contato">Contato:</label>
        <input type="text" name="contato" id="contato" 
         minlength = "9"  maxlength = "9"
        class="form-control" value="{{ old('contato') }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <br>
    <a href="{{ route('contatos.index') }}" class="btn btn-secondary">Voltar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>



    </div>
@endsection
