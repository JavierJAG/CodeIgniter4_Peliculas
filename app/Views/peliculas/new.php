<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva pelicula</title>
</head>
<body>
    <form action="/pelicula/create" method="post">
        <label for="titulo">Título</label>
        <input type="text" name= "titulo" id="titulo" ?>
        <label for="descripcion">Descripción</label>
        <textarea name= "descripcion" id="descripcion"></textarea>
        <button type="submit" value="Enviar">Enviar</button>
    </form>
</body>
</html>