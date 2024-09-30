<?= $this->extend('Layouts/blog') ?>
<?= $this->section('titulo') ?>
<title>Peliculas</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<h1>Peliculas por categoria: <?= $categoria->titulo ?></h1>
<hr>
<?php foreach ($pelicula as $p) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <!-- Mostrar imagen principal de la película -->
            <?php if ($p->imagen) : ?>
                <img class="w-25" src="/uploads/peliculas/<?= $p->imagen ?>" alt="imagen">
            <?php endif; ?>

            <h4><?= $p->titulo ?></h4>
            <a class="btn btn-secondary" href=""><?= $p->categoria ?></a>
            <p><?= $p->descripcion ?></p>

            <!-- Enlace para ver más detalles de la película -->
            <a target="_blank" class="btn btn-primary mt-2" href="/blog/<?= $p->id ?>">Ver</a>
            <hr>

            <!-- Mostrar etiquetas asociadas a la película -->
           

                    <span class="btn btn-sm btn-secondary" ><?= $p->etiquetas ?></span> <!-- Mostrar el título de cada etiqueta -->

           
        </div>
    </div>
<?php endforeach; ?>

<?= $pager->links() ?>
<?= $this->endSection() ?>