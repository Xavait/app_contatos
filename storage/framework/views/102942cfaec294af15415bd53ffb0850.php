

<?php $__env->startSection('content'); ?>
    <div class="container">
        
        <br>
        <h1>Lista de Contatos</h1>

        <!--<?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('contatos.create')); ?>" class="btn btn-primary">Adicionar Contato</a>
        <?php endif; ?>-->

        <?php if(Auth::check()): ?>
        <a href="<?php echo e(route('contatos.create')); ?>" class="btn btn-primary">Adicionar Contato</a>

        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-danger">Terminar sessão</button>
    </form>

        <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">Login</a>
        <?php endif; ?>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Contato</th>
                    <th>Email</th>
                    <?php if(auth()->guard()->check()): ?>  <!-- Mostrar opções de editar/excluir apenas para usuários autenticados -->
                    <th>Ações</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody id="contatos-list">
                <?php $__currentLoopData = $contatos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="contato-<?php echo e($contato->id); ?>">
                        <td><?php echo e($contato->id); ?></td>
                        <td><?php echo e($contato->nome); ?></td>
                        <td><?php echo e($contato->contato); ?></td>
                        <td><?php echo e($contato->email); ?></td>
                        <?php if(auth()->guard()->check()): ?>  <!-- Mostrar as ações apenas para usuários autenticados -->
                        <td>
                            <a href="<?php echo e(route('contatos.edit', $contato->id)); ?>" class="btn btn-warning">Editar</a>
                            <button class="btn btn-danger delete-contato" data-id="<?php echo e($contato->id); ?>">Excluir</button>
                            <a href="<?php echo e(route('contatos.show', $contato)); ?>" class="btn btn-info">Detalhes</a>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        _token: '<?php echo e(csrf_token()); ?>',  // Token CSRF para segurança
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app_contactos\resources\views/contatos/index.blade.php ENDPATH**/ ?>