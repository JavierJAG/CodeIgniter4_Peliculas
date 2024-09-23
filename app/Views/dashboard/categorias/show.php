<?= $this->extend('/Layouts/dashboard') ?>
<?= $this->section('titulo') ?>
<title>Información de categoría</title>
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
    </tr>
    <tr>
        <td>
            <?= $categoria['id'] ?>
        </td>
        <td>
            <?= $categoria['titulo'] ?>
        </td>
    </tr>
</table>
<?= $this->endSection() ?>