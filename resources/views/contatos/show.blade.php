@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h1>Detalhes do Contato</h1>
        <p><strong>Nome:</strong> {{ $contato->nome }}</p>
        <p><strong>Contato:</strong> {{ $contato->contato }}</p>
        <p><strong>Email:</strong> {{ $contato->email }}</p>
        <a href="{{ route('contatos.index') }}" class="btn btn-secondary">Voltar</a>
        <a href="{{ route('contatos.edit', $contato) }}" class="btn btn-warning">Editar</a>
        <form id="delete-form" method="POST" action="{{ route('contatos.destroy', $contato->id) }}"
        style="display:inline;">
            @csrf
            @method('DELETE')


            <button type="submit" class="btn btn-danger" id="delete-btn">Excluir</button>
        </form>
    </div>

    <script>
    // Usando AJAX para excluir o contato
    $('#delete-form').submit(function(event) {
        event.preventDefault();  // Impede o envio tradicional do formulário

        // Exibe um alerta de confirmação
        Swal.fire({
            title: 'Tem certeza?',
            text: "Você não poderá reverter essa ação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar a requisição AJAX para excluir o contato
                $.ajax({
                    url: $(this).attr('action'),  // Pega a URL do formulário (rota de exclusão)
                    type: 'DELETE',  // Método de requisição DELETE
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),  // CSRF Token
                    },
                    success: function(response) {
                        // Se a exclusão for bem-sucedida, mostrar a mensagem de sucesso
                        if (response.success) {
                            Swal.fire(
                                'Excluído!',
                                'O contato foi excluído com sucesso.',
                                'success'
                            ).then(function() {
                                window.location.href = "{{ route('contatos.index') }}";  // Redireciona para a lista
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Erro!',
                            'Ocorreu um erro ao tentar excluir o contato.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>

@endsection
