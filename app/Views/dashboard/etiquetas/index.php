<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Etiquetas</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<?= view('/partials/_session') ?>
<?= view('/partials/_err') ?>
<h1>Lista de etiquetas</h1>
<h3><a class="btn btn-success btn-lg mb-4" href="/dashboard/etiqueta/new">Crear Etiqueta</a></h3>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Título</th>
        <th>Categoría</th>
        <th>Opciones</th>
    </tr>
    <?php foreach ($etiqueta as $key => $value) : ?>
        <tr>
            <td><?= $value->id ?></td>
            <td><?= $value->titulo ?></td>
            <td><?= $value->categoria ?></td>
            <td>
                <a class="btn btn-secondary btn- mt-1" href="/dashboard/etiqueta/show/<?= $value->id ?>">Mostrar</a>
                <a class="btn btn-primary btn- mt-1"href="/dashboard/etiqueta/edit/<?= $value->id ?>">Editar</a>
                <form action="/dashboard/etiqueta/delete/<?= $value->id ?>" method="post">
                    <button class="btn btn-danger btn- mt-1" type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>

</table>
<?= $pager->links() ?>
<?= $this->endSection() ?>