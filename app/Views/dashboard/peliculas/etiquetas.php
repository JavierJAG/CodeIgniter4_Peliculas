<?= $this->extend('/Layouts/dashboard') ?>

<?= $this->section('titulo') ?>
<title>Etiquetas</title>
<?= $this->endSection() ?>

<?= $this->section('body') ?>

<?php
// Captura la categoría seleccionada desde la URL
$categoria_id = isset($_GET['categoria_id']) ? $_GET['categoria_id'] : ($pelicula->categoria_id ?? '');
?>

<form action="" method="post">
    <label class="form-label" for="categoria_id">Categoría</label>
    <select class="form-control" name="categoria_id" id="categoria_id">
        <option class="form-control" value=""></option>
        <?php foreach ($categorias as $c) : ?>
            <option class="form-control" value="<?= $c->id ?>" <?= $c->id == $categoria_id ? 'selected' : '' ?>><?= $c->titulo ?></option>
        <?php endforeach; ?>
    </select>

    <label class="form-label" for="etiqueta">Etiquetas</label>
    <select class="form-control" name="etiqueta_id" id="etiqueta_id">
        <option class="form-control" value=""></option>
        <?php foreach ($etiquetas as $e) : ?>
            <option class="form-control" value=<?= isset($_POST['etiqueta_id']) && $_POST['etiqueta_id'] == $e->id ? 'selected' : '' ?>>
                <?= $e->titulo ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button class="btn btn-primary mt-4" type="submit" id='send' value="Enviar">Enviar</button>
</form>

<script>
    function disableEnableButton() {
        // Obtener el valor de la etiqueta seleccionada
        if (document.querySelector('[name=etiqueta_id]').value == '') {
            document.querySelector('#send').setAttribute('disabled', 'disabled');
        } else {
            document.querySelector('#send').removeAttribute('disabled');
        }
    }

    // Evento cuando cambia la categoría
    document.querySelector('[name=categoria_id]').onchange = function(event) {
        // Cambia la URL para mantener el valor seleccionado al refrescar
        const selectedCategory = this.value;
        window.location.href = '/dashboard/pelicula/etiquetas/<?= $pelicula->id ?>?categoria_id=' + selectedCategory;
    };

    // Evento cuando cambia la etiqueta
    document.querySelector('[name=etiqueta_id]').onchange = function(event) {
        disableEnableButton();
    };

    // Verificar el estado del botón al cargar la página
    disableEnableButton();
</script>

<?= $this->endSection() ?>
