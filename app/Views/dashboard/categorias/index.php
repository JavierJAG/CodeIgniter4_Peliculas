<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Categorías</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<?= view('partials/_session') ?>
<?= view('/partials/_err') ?>
<h1>Categorías</h1>
<h3><a class="btn btn-success btn-lg mb-4" href="/dashboard/categoria/new">Crear Categoria</a></h3>
<table class="table">
    <tr>
        <th>
            ID
        </th>
        <th>
            TITULO
        </th>
        <th>
            Opciones
        </th>

    </tr>
    <?php foreach ($categoria as $key => $value) : ?>
        <tr>
            <td>
                <?= $value->id ?>
            </td>
            <td>
                <?= $value->titulo ?>
            </td>
            <td>
                <a class="btn btn-secondary btn- mt-1" href="/dashboard/categoria/show/<?= $value->id ?>">Mostrar</a>
                <a class="btn btn-primary btn- mt-1" href="/dashboard/categoria/edit/<?= $value->id ?>">Editar</a>
                <form action="/dashboard/categoria/delete/<?= $value->id ?>" method="post">
                    <button class="btn btn-danger btn- mt-1" type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>

</table>
<?= $pager->links() ?>
<?= $this->endSection() ?>