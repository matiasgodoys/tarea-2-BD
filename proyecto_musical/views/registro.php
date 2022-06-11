<?php 
  include '../include/header.php';
  session_start();
?>
<body class="bg-secondary">
  <nav class="navbar navbar-dark bg-dark">
      <div class="container-fluid d-flex">
          <a class="navbar-brand" href="../">SpotyChile</a>
          <div class="ms-auto nav">
              <a class="navbar-brand btn btn-outline-secondary" 
                  href="login.php">Login</a>
              <a class="navbar-brand btn btn-outline-secondary" 
                  href="registro.php">Registro</a>
          </div>
      </div>
  </nav>
  <div class="container">
    <div class="col-md-6 mx-auto mt-5">
      <?php if(isset($_SESSION['error'])){ ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['error']?></strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      <?php unset($_SESSION['error']); }?>
      <div class="card">
        <div class="card-header text-center">
          <h1>Registro</h1>
        </div>
        <div class="card-body">
          <form action="../controllers/agregarPersona.php" method="POST">
            <div class="my-3">
              <input type="text" name="nombre" class="form-control"
                placeholder="Nombre">
            </div>
            <div class="my-3">
              <input type="text" name="apellido" class="form-control"
                placeholder="Apellido">
            </div>
            <div class="my-3">
              <input type="email" name="email" class="form-control"
                placeholder="Email">
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control"
                placeholder="Password">
            </div>
            <div class="mb-3">
              <label for="">Tipo: </label>
              <div class="form-check ms-2 mt-1">
                <input class="form-check-input" type="radio" name="tipo" onchange="cambiarEstadoNombreArtistico()" id="rbArtista" value="artista">
                <label class="form-check-label" for="exampleRadios1">
                  Artista
                </label>
              </div>
              <div class="form-check ms-2">
                <input class="form-check-input" type="radio" name="tipo" onchange="cambiarEstadoNombreArtistico()" id="rbUsuario" value="usuario" checked>
                <label class="form-check-label" for="exampleRadios2">
                  Usuario
                </label>
              </div>
            </div>
            <div class="mb-4">
              <input type="text" name="nombreArtistico" class="form-control"
                placeholder="Nombre artistico" id="nombreArtistico" disabled>
            </div>
            <input type="submit" class="btn btn-primary w-100" name="registrarse"
              value="Registrarse">
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  function cambiarEstadoNombreArtistico(){
    if (rbArtista.checked == true) {
      nombreArtistico.disabled = false;
    }else{
      nombreArtistico.value = '';
      nombreArtistico.disabled = true;
    }
  }
</script>
</html>