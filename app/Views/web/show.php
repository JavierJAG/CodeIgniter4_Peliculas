<?= $this->extend('/Layouts/web'); ?>
<?= $this->section('titulo') ?>
<title>Ver datos</title>
<?= $this->endsection() ?>
<?= $this->section('body') ?>
<?php $usuario = session()->get('usuario') ?>
<?= 'Hola '. $usuario->usuario ?>
<form action="/web/logout" method="post">
    <button type="submit">Salir</button>
</form>
<?= $this->endsection() ?>