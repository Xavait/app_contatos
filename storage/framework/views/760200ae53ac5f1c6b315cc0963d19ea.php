

<?php $__env->startSection('content'); ?>
    <div class="container">
        <br>
        <h1>Editar Contato</h1>
        <form action="<?php echo e(route('contatos.update', $contato)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo e($contato->nome); ?>" required>
            </div>
            <div class="form-group">
                <label for="contato">Contato</label>
                <input type="text" name="contato" class="form-control" value="<?php echo e($contato->contato); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo e($contato->email); ?>" required>
            </div>

            <a href="<?php echo e(route('contatos.index')); ?>" class="btn btn-secondary mt-3">Voltar</a>

            <button type="submit" class="btn btn-warning mt-3">Atualizar</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app_contactos\resources\views/contatos/edit.blade.php ENDPATH**/ ?>