<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Películas</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<?= view('/partials/_session') ?>
<?= view('/partials/_err') ?>
<h1>Lista de películas</h1>
<h3><a class="btn btn-success btn-lg mb-4" href="/dashboard/pelicula/new">Crear Película</a></h3>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Título</th>
        <th>Categoría</th>
        <th>Opciones</th>
    </tr>
    <?php foreach ($pelicula as $key => $value) : ?>
        <tr>
            <td><?= $value->id ?></td>
            <td><?= $value->titulo ?></td>
            <td><?= $value->categoria ?></td>
            <td>
                <a href="/dashboard/pelicula/show/<?= $value->id ?>" class="btn btn-secondary btn- mt-1">Mostrar</a>
                <a href="/dashboard/pelicula/edit/<?= $value->id ?>" class="btn btn-primary btn- mt-1">Editar</a>
                <a href="/dashboard/pelicula/etiquetas/<?= $value->id ?>" class="btn btn-primary btn- mt-1">Tags</a>
                <form action="/dashboard/pelicula/delete/<?= $value->id ?>" method="post">
                    <button type="submit" class="btn btn-danger btn- mt-1">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>

</table>
<?= $pager->links() ?>
<?= $this->endSection() ?>