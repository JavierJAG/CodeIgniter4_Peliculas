<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Películas</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<?= view('/partials/_session') ?>
<h1>Lista de películas</h1>
<h3><a href="/dashboard/etiqueta/new">Crear Película</a></h3>
<table>
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
                <a href="/dashboard/etiqueta/show/<?= $value->id ?>">Mostrar</a>
                <a href="/dashboard/etiqueta/edit/<?= $value->id ?>">Editar</a>
                <form action="/dashboard/etiqueta/delete/<?= $value->id ?>" method="post">
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>

</table>
<?= $pager->links()?>
<?= $this->endSection() ?>