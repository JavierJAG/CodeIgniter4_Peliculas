<?php if (session('mensaje')) : ?>
    <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
        <?= session('mensaje') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>