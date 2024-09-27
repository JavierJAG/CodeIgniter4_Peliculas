<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->renderSection('nombre_ventana') ?>
    <link rel="stylesheet" href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg mb-3">
    <div class="container-fluid">
        <a class="navbar-brand">Code 4</a>
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li class="navbar-item">
                    <a href="<?= base_url() ?>/dashboard/categoria" class="nav-link">Categoria</a>
                </li>
                <li class="navbar-item">
                    <a href="<?= base_url() ?>/dashboard/pelicula" class="nav-link">Pelicula</a>
                </li>
                <li class="navbar-item">
                    <a href="<?= base_url() ?>/dashboard/etiqueta" class="nav-link">Etiqueta</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <?= $this->renderSection('body') ?>
            </div>

        </div>

    </div>
    <script src="<?= base_url() ?>/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>