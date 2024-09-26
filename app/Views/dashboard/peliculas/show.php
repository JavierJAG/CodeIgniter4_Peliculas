<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Información película</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<h1>Información</h1>
<table>
    <tr>
        <th>
            ID
        </th>
        <th>
            TITULO
        </th>
        <th>
            DESCRIPCION
        </th>
        <th>
            IMAGENES
        </th>
        <th>
            ETIQUETAS
        </th>
    </tr>
    <tr>
        <td>
            <?= $pelicula->id ?>
        </td>
        <td>
            <?= $pelicula->titulo ?>
        </td>
        <td>
            <?= $pelicula->descripcion ?>
        </td>
        <td>
            <?php foreach ($imagenes as $i) : ?>
                <form action="/dashboard/pelicula/<?= $pelicula->id ?>/imagen/<?= $i->id ?>/delete" method="post">
                    <img src="/uploads/peliculas/<?= $i->imagen ?>" alt="imagen" width="200">
                    <button type="submit">Eliminar</button>
                </form>
                <form action="/dashboard/pelicula/imagen/descargar/<?= $i->id ?>" method="post">
                    <button type="submit">Descargar</button>
                </form>
            <?php endforeach; ?>
        </td>
        <td>
            <ul>
                <?php foreach ($etiquetas as $e) : ?>
                    <li>
                        <button type="button" class="delete_etiqueta" data-url='/dashboard/pelicula/<?= $pelicula->id ?>/etiqueta/<?= $e->id ?>/delete'>
                            <?= $e->titulo ?>
                        </button>
                    </li>
                <?php endforeach ?>
            </ul>

        </td>
    </tr>
</table>

<script>
    document.querySelectorAll('.delete_etiqueta').forEach((b) => {
        b.onclick = function(event) {
            fetch(this.getAttribute('data-url'), {
                method: 'POST'
            }).then(res => res.json()).then(res => {
                console.log(res)
            })
        }
    })
</script>

<?= $this->endSection() ?>