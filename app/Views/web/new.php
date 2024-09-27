<?= $this->extend('/Layouts/web'); ?>
<?= $this->section('titulo') ?>
<title>Crear usuario</title>
<?= $this->endsection() ?>
<?= $this->section('body') ?>
<?= view('/partials/_session') ?>
<?= view('/partials/_err') ?>
<div class="container mt-5">
    <div class="card mx-auto d-block">
        <div class="card-header">
            <h1 class="text-center">Crear Usuario</h1>
        </div>
        <div class="card-body">
            <form action="/web/create" method="post">
                <label class="form-label" for="usuario">Usuario</label>
                <input class="form-control" type="text" id="usuario" name="usuario">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email">
                <label class="form-label" for="contrasena">Contraseña</label>
                <input class="form-control" type="password" name="contrasena" id="contrasena">
                <Button class="btn btn-primary btn-block mt-3" type="submit">Enviar</Button>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection() ?>