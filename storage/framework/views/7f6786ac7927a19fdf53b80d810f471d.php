

<?php $__env->startSection('content'); ?>
    <div class="container">
        <br>
        <h1>Detalhes do Contato</h1>
        <p><strong>Nome:</strong> <?php echo e($contato->nome); ?></p>
        <p><strong>Contato:</strong> <?php echo e($contato->contato); ?></p>
        <p><strong>Email:</strong> <?php echo e($contato->email); ?></p>
        <a href="<?php echo e(route('contatos.index')); ?>" class="btn btn-secondary">Voltar</a>
        <a href="<?php echo e(route('contatos.edit', $contato)); ?>" class="btn btn-warning">Editar</a>
        <form id="delete-form" method="POST" action="<?php echo e(route('contatos.destroy', $contato->id)); ?>"
        style="display:inline;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>


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
                                window.location.href = "<?php echo e(route('contatos.index')); ?>";  // Redireciona para a lista
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app_contactos\resources\views/contatos/show.blade.php ENDPATH**/ ?>