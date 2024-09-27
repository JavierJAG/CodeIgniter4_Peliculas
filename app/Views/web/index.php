<?= $this->extend('/Layouts/web'); ?>
<?= $this->section('titulo') ?>
<title>Log in</title>
<?= $this->endsection() ?>
<?= $this->section('body') ?>
<?= view('/partials/_session') ?>
<?= view('/partials/_err') ?>
<div class="container mt-5">
    <div class="card mx-auto d-block">
        <div class="card-header">
            <h1>Login</h1>
        </div>
        <div class="card-body">
            <form action="/web/login" method="post">
                <label class="form-label" for="usuario">Usuario</label>
                <input class="form-control mb-3" type="text" id="usuario" name="usuario">

                <label class="form-label" for="contrasena">Contraseña</label>
                <input class="form-control mb-4" type="password" name="contrasena" id="contrasena">

                <button class="btn btn-primary btn-block mb-3">Enviar</button>
            </form>
            <form action="/web/new" method="get">
                <button class="btn btn-secondary btn-block" type="submit">Crear</button>
            </form>
        </div>
    </div>
</div>



<?= $this->endsection() ?>