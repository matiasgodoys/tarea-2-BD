<?php 
  include('../include/navbar.php');
  include('../controllers/db_config.php');
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT
      CAN.NOMBRE AS NOMBRE_CANCION,
      CAN.LETRA,
      CAN.FECHA_COMPOSICION,
      ALB.NOMBRE AS NOMBRE_ALBUM,
      ALB.IMAGEN,
      ART.NOMBRE_ARTISTICO,
      PER.NOMBRE AS NOMBRE_ARTISTA,
      PER.APELLIDO AS APELLIDO_ARTISTA
      FROM CANCIONES AS CAN
      INNER JOIN ALBUM_TIENE_CANCION AS ATC ON CAN.ID=ATC.ID_CANCION
      INNER JOIN ALBUM AS ALB ON ALB.ID = ATC.ID_ALBUM
      INNER JOIN ARTISTA_COMPUSO_CANCION AS ACC ON ACC.ID_CANCION=CAN.ID
      INNER JOIN ARTISTAS AS ART ON ART.ID = ACC.ID_ARTISTA
      INNER JOIN PERSONAS AS PER ON PER.ID = ART.ID
      WHERE CAN.ID = $id";
    $resultado = pg_query($query);
    $array = pg_fetch_array($resultado);
    if(!$array){
      header('Location: ../views/dashboard.php');
      return;
    }
  }

?>
<div class="container p-3">
  <div class="col-md-5 mx-auto mt-5">
    <div class="card">
      <div class="card-header">
        <h1>Detalles de la canción</h1>
      </div>
      <div class="card-body">
        <div class="card-title">
          <h2>
            <?= $array['nombre_cancion']?>
          </h2>
        </div>
        <div class="card-text">
          <strong>Album: </strong>
          <?= $array['nombre_album']?><br>          
          <strong>Artista: </strong>
          <?php 
            if($array['nombre_artistico']){
              echo $array['nombre_artistico'];
            }else{
              echo $array['nombre']." ".$array['apellido'];
            }?>
          <br>  
          <?php if($array['fecha_composicion']) {
            if(strlen($array['fecha_composicion'] > 0)){
              echo "<strong>Fecha composición: </strong>";
              echo $array['fecha_composicion'];
            }
          }?>
          <br>  
          <?php if($array['letra']) {
            if(strlen($array['letra'])>0){
              echo "<strong>Letra: </strong><br>";
              echo $array['letra'];
            }
          }?>
          
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>