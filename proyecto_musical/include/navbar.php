<?php  
session_start();
if(!isset($_SESSION['usuario'])){
  header("Location: ../index.php");
}
?>
<?php
include('header.php');
?>
<body class="bg-secondary">
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid d-flex">
      <a class="navbar-brand" href="../views/dashboard.php">SpotyChile</a>
      <div class="ms-auto nav">
        <?php
          if($_SESSION['usuario']['tipo'] == 'artista'){
        ?>
          <a class="navbar-brand" href="../views/canciones.php">Canciones</a>
          <a class="navbar-brand" href="../views/dashboard.php">Álbumes</a>
        <?php }else{?>
          <a class="navbar-brand" href="../views/dashboard.php">Canciones</a>
        <?php }?>
        <a class="navbar-brand" href="perfil.php">Perfil</a>
        <a class="navbar-brand btn btn-danger" 
          href="../controllers/salir.php">Salir</a>
      </div>
    </div>
  </nav>
