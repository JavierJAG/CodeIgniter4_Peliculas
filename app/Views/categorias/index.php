<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
</head>

<body>
    <h1>Categorías</h1>
    <h3><a href="/categoria/new">Crear Categoria</a></h3>
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
                    <a href="/categoria/show/<?= $value['id'] ?>">Mostrar</a>
                    <a href="/categoria/edit/<?= $value['id'] ?>">Editar</a>
                    <form action="/categoria/delete/<?= $value['id'] ?>" method="post">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>

    </table>

</body>

</html>