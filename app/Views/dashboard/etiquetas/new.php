<?= $this->extend('/Layouts/dashboard') ?>

<?= $this->section('titulo') ?>
<title>Crear Película</title>
<?= $this->endSection() ?>

<?= $this->section('body') ?>
<form action="/dashboard/etiqueta/create" method="post">
    <label for="titulo">Título</label>
    <input type="text" name="titulo" id="titulo" />

    <label for="categoria">Categoría</label>
    <select name="categoria_id" id="categoria">
        <?php foreach ($categorias as $c) : ?>
            <option value="<?= $c->id ?>"><?= $c->titulo ?></option>
        <?php endforeach; ?>
    </select>
    
    <button type="submit" value="Enviar">Enviar</button>
</form>
<?= $this->endSection() ?>
