<?= $this->extend('/Layouts/web') ?>
<?= $this->section('titulo') ?>
<title>Información película</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>

<div class="card">
    <div class="card-body">
        <h1><?= $pelicula->titulo ?></h1>
        <hr>
        
        <!-- Corregir el enlace a la categoría -->
        <a target="_blank" class="btn btn-primary" href="/blog/categorias/<?= $pelicula->categoria_id ?>">
            <?= $pelicula->categoria ?>
        </a>
        
        <p><?= $pelicula->descripcion ?></p>
        
        <h3>Imágenes</h3>
        <div class="d-flex gap-2">
            <!-- Mostrar imágenes -->
            <?php foreach ($imagenes as $i) : ?>
                <img class="w-25" src="/uploads/peliculas/<?= $i->imagen ?>" alt="imagen">
            <?php endforeach; ?>
        </div>

        <h3>Etiquetas</h3>
        <!-- Mostrar etiquetas asociadas -->
        <?php foreach ($etiquetas as $key =>$e) : ?>
            <a target="_blank" class="btn btn-sm btn-warning" href="/blog/etiquetas/<?= $e->id ?>">
                <?= $e->titulo ?>
            </a>
        <?php endforeach ?>
    </div>
</div>


<?= $this->endSection() ?>