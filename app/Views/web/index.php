<?= $this->extend('/Layouts/web'); ?>
<?= $this->section('titulo') ?>
<title>Log in</title>
<?= $this->endsection() ?>
<?= $this->section('body') ?>
<?= view('/partials/_session')?>
<form action="/web/login" method="post">
<label for="usuario">Usuario</label>
<input type="text" id="usuario" name="usuario" >
<label for="contrasena">Contraseña</label>
<input type="password" name="contrasena" id="contrasena">
<Button>Enviar</Button>
</form>
<form action="/web/new" method="get">
    <button type="submit">Crear</button>
</form>

<?= $this->endsection() ?>