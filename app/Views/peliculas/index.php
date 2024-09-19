<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de películas</h1>
    <h3><a href="/pelicula/new">Crear Película</a></h3>
   <table>
    <tr>
        <th>Id</th>
        <th>Título</th>
        <th>Opciones</th>
    </tr>
    <?php foreach($pelicula as $key => $value) : ?>
    <tr>
        <td><?= $value['id']?></td>
        <td><?=$value['titulo']?></td>
        <td>
            <a href="/pelicula/show/<?=$value['id']?>">Show</a>
            <a href="/pelicula/edit/<?=$value['id']?>">Edit</a>
            <form action="/pelicula/delete/<?=$value['id']?>" method="post">
                <button type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    <?php endforeach ?>

   </table>
</body>
</html>