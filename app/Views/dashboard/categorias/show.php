<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de categoría</title>
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
        </tr>
        <tr>
            <td>
                <?= $categoria['id'] ?>
            </td>
            <td>
                <?= $categoria['titulo'] ?>
            </td>
        </tr>
    </table>

</body>

</html>