<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Editar Película</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<?= view('partials/_session') ?>
<form action="/dashboard/etiqueta/update/<?= $etiqueta->id ?>" method="post">
    <label for="titulo">Título</label>
    <input type="text" name="titulo" id="titulo" value="<?= old('titulo', $etiqueta->titulo) ?>">
    
    <label for="categoria">Categoría</label>
    <select name="categoria_id" id="categoria">
        <?php foreach ($categorias as $c) : ?>
            <option value="<?= $c->id ?>" <?= (old('categoria_id', $etiqueta->categoria_id) == $c->id) ? 'selected' : '' ?>>
                <?= $c->titulo ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" value="Enviar">Enviar</button>
</form>
<?= $this->endSection() ?>
