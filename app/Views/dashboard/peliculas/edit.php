<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Editar Película</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<?= view('partials/_session') ?>
<?= view('/partials/_err') ?>
<form enctype='multipart/form-data' action="/dashboard/pelicula/update/<?= $pelicula->id ?>" method="post">
    <label class="form-label" for="titulo">Título</label>
    <input class="form-control" type="text" name="titulo" id="titulo" value="<?= old('titulo', $pelicula->titulo) ?>">
    
    <label class="form-label" for="categoria">Categoría</label>
    <select class="form-control" name="categoria_id" id="categoria">
        <?php foreach ($categorias as $c) : ?>
            <option class="form-control" value="<?= $c->id ?>" <?= (old('categoria_id', $pelicula->categoria_id) == $c->id) ? 'selected' : '' ?>>
                <?= $c->titulo ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label class="form-label" for="descripcion">Descripción</label>
    <textarea class="form-control" name="descripcion" id="descripcion"><?= old('descripcion', $pelicula->descripcion) ?></textarea>
    <form enctype='multipart/form-data' action="/dashboard/pelicula/update/<?= $pelicula->id ?>" method="post">
    <label class="form-label" for="imagen">Imagen</label>
    <input  class="form-control" type="file" name="imagen" id="imagen">
    <button class="btn btn-primary mt-4" type="submit" value="Enviar">Enviar</button>
</form>

<?= $this->endSection() ?>
