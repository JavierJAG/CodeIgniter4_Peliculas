<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Editar Película</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<?= view('partials/_session') ?>
<form action="/dashboard/pelicula/update/<?= $pelicula->id ?>" method="post">
    <label for="titulo">Título</label>
    <input type="text" name="titulo" id="titulo" value="<?= old('titulo', $pelicula->titulo) ?>">
    
    <label for="categoria">Categoría</label>
    <select name="categoria_id" id="categoria">
        <?php foreach ($categorias as $c) : ?>
            <option value="<?= $c->id ?>" <?= (old('categoria_id', $pelicula->categoria_id) == $c->id) ? 'selected' : '' ?>>
                <?= $c->titulo ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion"><?= old('descripcion', $pelicula->descripcion) ?></textarea>

    <button type="submit" value="Enviar">Enviar</button>
</form>
<?= $this->endSection() ?>
