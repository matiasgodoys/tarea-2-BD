<?php 
  include('../include/navbar.php');
?>
<body>
  
  <div class="container">
    <div class="card mx-auto mt-5" style="width: 25rem;">
      <img src="../img/perfil.webp" class=" img-fluid" alt="Perfil">
      <div class="card-body">
        <h5 class="card-title">
          <?php 
            echo $_SESSION['usuario']['nombre']." ".$_SESSION['usuario']['apellido'];
            if($_SESSION['usuario']['tipo'] == 'artista'){ 
              if($_SESSION['usuario']['verificado'] == "t"){?>
              <i class="fa fa-check-circle text-primary" aria-hidden="true"></i>
          <?php }}?>
        </h5>
        <p class="card-text">
          Email: <?= strtolower($_SESSION['usuario']['email'])?>
          <?php if($_SESSION['usuario']['tipo'] == 'artista'){
            if($_SESSION['usuario']['nombreArtistico']){?>  
            <br>
            Nombre artistico: <?= $_SESSION['usuario']['nombreArtistico']?>
          <?php }}?>    
        </p>
      </div>
    </div>
  </div>
</body>
</html>