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
            }).then(res => res.json()).then(res => {console.log(res)})
        }
    })
</script>

<?= $this->endSection() ?>