<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descripción de peliculas</title>
</head>

<body>
    <h1>Información</h1>
    <table>
        <tr>
            <th>
                ID
            </th>
            <th>
                TITULO
            </th>
            <th>
                DESCRIPCION
            </th>
        </tr>
        <tr>
            <td>
                <?= $pelicula['id'] ?>
            </td>
            <td>
                <?= $pelicula['titulo'] ?>
            </td>
            <td>
                <?= $pelicula['descripcion'] ?>
            </td>
        </tr>
    </table>

</body>

</html>