<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Editar Película</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<?= view('partials/_session') ?>
<form action="/dashboard/pelicula/update/<?= $pelicula['id'] ?>" method="post">
    <label for="titulo">Título</label>
    <input type="text" name="titulo" id="titulo" value="<?= $pelicula['titulo'] ?>">
    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion"> <?= $pelicula['descripcion'] ?></textarea>
    <button type="submit" value="Enviar">Enviar</button>
</form>
<?= $this->endSection ?>