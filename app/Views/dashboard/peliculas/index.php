<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Películas</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<?= view('/partials/_session') ?>
<h1>Lista de películas</h1>
<h3><a href="/dashboard/pelicula/new">Crear Película</a></h3>
<table>
    <tr>
        <th>Id</th>
        <th>Título</th>
        <th>Opciones</th>
    </tr>
    <?php foreach ($pelicula as $key => $value) : ?>
        <tr>
            <td><?= $value->id ?></td>
            <td><?= $value->titulo ?></td>
            <td>
                <a href="/dashboard/pelicula/show/<?= $value->id ?>">Mostrar</a>
                <a href="/dashboard/pelicula/edit/<?= $value->id ?>">Editar</a>
                <form action="/dashboard/pelicula/delete/<?= $value->id ?>" method="post">
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>

</table>
<?= $this->endSection() ?>