<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Editar categoría</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<?= view('partials/_session') ?>
<form action="/dashboard/categoria/update/<?= $categoria->id ?>" method="post">
    <label class="form-label" for="titulo">Título</label>
    <input class="form-control" type="text" name="titulo" id="titulo" value="<?= old('titulo',$categoria->titulo) ?>">
    <button class="btn btn-primary mt-4" type="submit" value="Enviar">Enviar</button>
</form>
<?= $this->endSection() ?>