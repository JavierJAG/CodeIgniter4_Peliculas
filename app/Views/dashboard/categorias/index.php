<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
    <title>Categorías</title>
<?= $this->endSection()?>
<?= $this->section('body')?>
    <?= view('partials/_session')?>
    <h1>Categorías</h1>
    <h3><a href="/dashboard/categoria/new">Crear Categoria</a></h3>
    <table>
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
                    <?= $value['id'] ?>
                </td>
                <td>
                    <?= $value['titulo'] ?>
                </td>
                <td>
                    <a href="/dashboard/categoria/show/<?= $value['id'] ?>">Mostrar</a>
                    <a href="/dashboard/categoria/edit/<?= $value['id'] ?>">Editar</a>
                    <form action="/dashboard/categoria/delete/<?= $value['id'] ?>" method="post">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>

    </table>
<?= $this->endSection()?>