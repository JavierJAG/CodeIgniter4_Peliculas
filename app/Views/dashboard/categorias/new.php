<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Crear categoría</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<form action="/dashboard/categoria/create" method="post">
    <label for="titulo">Título</label>
    <input type="text" name="titulo" id="titulo" ?>
    <button type="submit" value="Enviar">Enviar</button>
</form>
<?= $this->endSection() ?>