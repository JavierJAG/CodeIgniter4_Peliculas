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
    </tr>
</table>

<?= $this->endSection() ?>