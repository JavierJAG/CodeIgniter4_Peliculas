<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?= $this->renderSection('nombre_ventana') ?>
   <link rel="stylesheet" href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <?= $this->renderSection('body') ?>
</body>

</html>