<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Pelicula</h1>
    <p>Vamos a ver <?php foreach($pelicula as $key=>$value){
        echo $value['titulo'];
    } ?></p>
</body>
</html>