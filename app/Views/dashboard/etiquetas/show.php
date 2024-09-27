<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Información película</title>
<?= $this->endSection() ?>
<?= $this->section('body') ?>
<h1>Información</h1>
<table class="table">
    <tr>
        <th>
            ID
        </th>
        <th>
            TITULO
        </th>
    </tr>
    <tr>
        <td>
            <?= $etiqueta->id ?>
        </td>
        <td>
            <?= $etiqueta->titulo ?>
        </td>


    </tr>
</table>

<?= $this->endSection() ?>