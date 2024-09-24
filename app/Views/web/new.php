<?= $this->extend('/Layouts/web'); ?>
<?= $this->section('titulo') ?>
<title>Crear usuario</title>
<?= $this->endsection() ?>
<?= $this->section('body') ?>
<form action="/web/create" method="post">
<label for="usuario">Usuario</label>
<input type="text" id="usuario" name="usuario" >
<label for="email">Email</label>
<input type="text" name="email" id="email">
<label for="contrasena">Contraseña</label>
<input type="password" name="contrasena" id="contrasena">
<Button type="submit">Enviar</Button>
</form>
<?= $this->endsection() ?>