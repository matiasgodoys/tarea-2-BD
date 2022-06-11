<?php
  session_start();
?>

<?php include '../include/header.php'; ?>
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
          <h1>Login</h1>
        </div>
        <div class="card-body">
          <form action="../controllers/ingreso.php" method="POST">
            <div class="my-3">
              <input type="email" name="email" class="form-control"
                placeholder="Email">
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control"
                placeholder="Password">
            </div>
            <input name="ingresar" class="btn btn-primary w-100"
              value="Ingresar" type="submit">
          </form>
        </div>
        <div class="card-footer">

        </div>
      </div>
    </div>
  </div>
</body>
</html>