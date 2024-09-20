<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pelicula</title>
</head>
<body>
    <form action="/dashboard/pelicula/update/<?= $pelicula['id']?>" method="post">
        <label for="titulo">Título</label>
        <input type="text" name= "titulo" id="titulo" value="<?= $pelicula['titulo'] ?>">
        <label for="descripcion">Descripción</label>
        <textarea name= "descripcion" id="descripcion"> <?= $pelicula['descripcion'] ?></textarea>
        <button type="submit" value="Enviar">Enviar</button>
    </form>
</body>
</html>