<?php if (session('error')) : ?>
    <?php foreach (session('error')->getErrors() as $e) : ?>
        <div class="alert alert-danger alert-dismissible fade show my-4" role="alert">
            <?= $e ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach ?>
<?php endif ?>