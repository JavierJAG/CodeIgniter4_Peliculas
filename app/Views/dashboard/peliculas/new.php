<?= $this->extend('/Layouts/dashboard') ?>

<?= $this->section('titulo') ?>
<title>Crear Película</title>
<?= $this->endSection() ?>

<?= $this->section('body') ?>
<?= view('partials/_session') ?>
<?= view('/partials/_err') ?>
<form action="/dashboard/pelicula/create" method="post">
    <label class="form-label" for="titulo">Título</label>
    <input class="form-control" type="text" name="titulo" id="titulo" />

    <label class="form-label" for="categoria">Categoría</label>
    <select class="form-control" name="categoria_id" id="categoria">
        <?php foreach ($categorias as $c) : ?>
            <option class="form-control" value="<?= $c->id ?>"><?= $c->titulo ?></option>
        <?php endforeach; ?>
    </select>

    <label class="form-label" for="descripcion">Descripción</label>
    <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
    
    <button class="btn btn-primary mt-4" type="submit" value="Enviar">Enviar</button>
</form>
<?= $this->endSection() ?>
