<?= $this->extend('Layouts/blog') ?>
<?= $this->section('titulo') ?>
<title>Peliculas</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<h1>Peliculas</h1>
<hr>

<div class="card my-3 text-bg-primary">
    <div class="card-body">
        <form action="" method="get">
            <div class="d-flex gap-2">
                <select class="form-control flex-grow-1 categoria_id" id="categoria_id" name="categoria_id">
                    <option value="">Categoria</option>
                    <?php foreach ($categorias as $c): ?>
                        <option value="<?= $c->id ?>" <?= ($c->id == $categoria_id) ? 'selected' : '' ?>><?= $c->titulo ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="form-control flex-grow-1 etiqueta_id" id="etiqueta_id" name="etiqueta_id">
                    <option value="">Etiqueta</option>
                    <?php foreach ($etiquetas as $e) : ?>
                        <option value="<?= $e->id ?>" <?= ($e->id == $etiqueta_id) ? 'selected' : '' ?>><?= $e->titulo ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="d-flex gap-2 mt-2">
                <input class="form-control" placeholder="Buscar..." type="text" name="buscar">
                <input class="btn btn-success" type="submit" value="Enviar">
                <a style="width: 140px; " class="btn btn-secondary" href="<?= base_url() . '/blog' ?>">Limpiar</a>
            </div>

        </form>
    </div>
</div>

<?php foreach ($pelicula as $value) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <!-- Mostrar imagen principal de la película -->
            <?php if ($value->imagen) : ?>
                <img class="w-25" src="/uploads/peliculas/<?= $value->imagen ?>" alt="imagen">
            <?php endif; ?>

            <h4><?= $value->titulo ?></h4>
            <a class="btn btn-secondary" href="/blog/categorias/<?=$value->categoria_id ?>"><?= $value->categoria ?></a>
            <p><?= $value->descripcion ?></p>
            
            <!-- Enlace para ver más detalles de la película -->
            <a class="btn btn-primary mt-2" href="/blog/<?= $value->id ?>">Ver</a>
            <hr>

            <!-- Mostrar etiquetas asociadas a la película -->
            <?php foreach ($etiquetas as $e) : ?>
                <a class="btn btn-sm btn-secondary" href=""><?= $e->titulo ?></a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

<?= $pager->links() ?>

<script>
    document.querySelector('.categoria_id').addEventListener('change', () => {
        fetch('/blog/etiquetas_por_categoria/' + document.getElementById('categoria_id').value)
            .then(res => {
                // Verificar si la respuesta es correcta
                if (!res.ok) {
                    throw new Error('Error en la respuesta: ' + res.statusText);
                }
                return res.text(); // Obtener la respuesta como texto
            })
            .then(text => {
                console.log('Respuesta recibida:', text); // Ver la respuesta en la consola

                try {
                    const res = JSON.parse(text); // Intentar convertir a JSON

                    // Verificar si res es un array
                    if (Array.isArray(res)) {
                        var etiquetas = `<option value="">Etiqueta</option>`;
                        res.forEach((e) => {
                            etiquetas += `<option value="${e.id}">${e.titulo}</option>`;
                        });
                        document.getElementById('etiqueta_id').innerHTML = etiquetas;
                    } else {
                        console.error('La respuesta no es un array:', res);
                    }
                } catch (error) {
                    console.error('Error al convertir a JSON:', error);
                }
            })
            .catch(error => {
                console.error('Error al obtener etiquetas:', error);
            });

    })
</script>
<?= $this->endSection() ?>