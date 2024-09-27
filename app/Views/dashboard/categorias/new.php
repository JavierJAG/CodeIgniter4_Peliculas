<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Crear categoría</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<form action="/dashboard/categoria/create" method="post">
    <label class="form-label" for="titulo">Título</label>
    <input class="form-control" type="text" name="titulo" id="titulo" ?>
    <button class="btn btn-primary mt-4" type="submit" value="Enviar">Enviar</button>
</form>
<?= $this->endSection() ?>