<?= $this->extend('/Layouts/dashboard') ?>

<?= $this->section('titulo') ?>
<title>Crear Película</title>
<?= $this->endSection() ?>

<?= $this->section('body') ?>
<form action="/dashboard/etiqueta/create" method="post">
    <label class="form-label" for="titulo">Título</label>
    <input class="form-control" type="text" name="titulo" id="titulo" />

    <label class="form-label" for="categoria">Categoría</label>
    <select class="form-control" name="categoria_id" id="categoria">
        <?php foreach ($categorias as $c) : ?>
            <option class="form-control" value="<?= $c->id ?>"><?= $c->titulo ?></option>
        <?php endforeach; ?>
    </select>
    
    <button class="btn btn-primary mt-3" type="submit" value="Enviar">Enviar</button>
</form>
<?= $this->endSection() ?>
