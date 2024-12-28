@extends('layouts.app')

@section('content')
    <div class="container">
        
        <br>
        <h1>Lista de Contatos</h1>

        <!--@auth
        <a href="{{ route('contatos.create') }}" class="btn btn-primary">Adicionar Contato</a>
        @endauth-->

        @if (Auth::check())
        <a href="{{ route('contatos.create') }}" class="btn btn-primary">Adicionar Contato</a>

        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Terminar sessão</button>
    </form>

        @else
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Contato</th>
                    <th>Email</th>
                    @auth  <!-- Mostrar opções de editar/excluir apenas para usuários autenticados -->
                    <th>Ações</th>
                    @endauth
                </tr>
            </thead>
            <tbody id="contatos-list">
                @foreach ($contatos as $contato)
                    <tr id="contato-{{ $contato->id }}">
                        <td>{{ $contato->id }}</td>
                        <td>{{ $contato->nome }}</td>
                        <td>{{ $contato->contato }}</td>
                        <td>{{ $contato->email }}</td>
                        @auth  <!-- Mostrar as ações apenas para usuários autenticados -->
                        <td>
                            <a href="{{ route('contatos.edit', $contato->id) }}" class="btn btn-warning">Editar</a>
                            <button class="btn btn-danger delete-contato" data-id="{{ $contato->id }}">Excluir</button>
                            <a href="{{ route('contatos.show', $contato) }}" class="btn btn-info">Detalhes</a>
                        </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
    $(document).on('click', '.delete-contato', function() {
        var contatoId = $(this).data('id');

        // Exibir SweetAlert de confirmação antes de excluir
        Swal.fire({
            title: 'Você tem certeza?',
            text: 'Essa ação não pode ser desfeita.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Fazer requisição AJAX para excluir o contato
                $.ajax({
                    url: '/contatos/' + contatoId,  // A URL da rota de delete
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',  // Token CSRF para segurança
                    },
                    success: function(response) {
                        if (response.success) {
                            // Exibir mensagem de sucesso com SweetAlert
                            Swal.fire(
                                'Excluído!',
                                response.message,
                                'success'
                            );
                            
                            // Remover o item da lista na página
                           
                                $('#contato-' + contatoId).remove();
                        } else {
                            // Exibir mensagem de erro
                            Swal.fire(
                                'Erro!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        // Exibir erro genérico
                        Swal.fire(
                            'Erro!',
                            'Ocorreu um erro ao excluir o contato.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>
@endsection
