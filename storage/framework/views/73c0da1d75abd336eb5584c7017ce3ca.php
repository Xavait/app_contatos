

<?php $__env->startSection('content'); ?>
    <div class="container">
        <br>
        <h1>Criar Contato</h1>
        <form action="<?php echo e(route('contatos.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo e(old('nome')); ?>" required>
      
    </div>

    <div class="form-group">
        <label for="contato">Contato:</label>
        <input type="text" name="contato" id="contato" 
         minlength = "9"  maxlength = "9"
        class="form-control" value="<?php echo e(old('contato')); ?>" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email')); ?>" required>
    </div>

    <br>
    <a href="<?php echo e(route('contatos.index')); ?>" class="btn btn-secondary">Voltar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>



    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app_contactos\resources\views/contatos/create.blade.php ENDPATH**/ ?>