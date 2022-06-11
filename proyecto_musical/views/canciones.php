<?php 
include('../include/navbar.php');
include('../controllers/db_config.php');
?>
  <div class="container p-4">
    <div class="row mt-5">
      <div class="col-md-4 mx-auto">
        <?php if(isset($_SESSION['mensaje'])){ ?>
          <div class="alert alert-<?= $_SESSION['color']?> alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['mensaje']?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php unset($_SESSION['mensaje']); unset($_SESSION['color']);}?>
        <div class="card">
          <div class="card-header">
            <h2>Agregar Canción</h2>
          </div>
          <div class="card-body">
            <form action="../controllers/agregarCancion.php" method="POST" 
              enctype="multipart/form-data">
              <div class="mb-3">
                <input type="text" name="nombre" class="form-control"
                  placeholder="Nombre">
              </div>
              <div class="mb-3">
                <textarea type="text" name="letra" class="form-control"
                  placeholder="Letra" rows="4"></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label" for="fecha">Fecha composición: </label>
                <input type="date" name="fecha" 
                  class="form-control" id="fecha">
              </div>
              <div class="mb-3">
                <label for="album">Album: </label>
                <select name="album" id="album" class="form-select">
                  <?php 
                    $query = "SELECT ID,NOMBRE FROM ALBUM";
                    $resultado = pg_query($dbconn, $query);
                    $array = pg_fetch_all($resultado);
                    if($array){
                      foreach ($array as $fila) {?>
                      <option value="<?= $fila['id']?>">
                        <?= $fila['nombre']?>
                      </option>
                  <?php }}?>
                </select>
              </div>
              <input type="submit" class="w-100 btn btn-primary" name="agregarCancion"
                value="Guardar">
            </form>
          </div>
        </div>
        </div>
        <div class="col-md-8 mx-auto">
        <table class="table table-light">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Letra</th>
              <th>Fecha Composición</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = "SELECT CAN.ID,CAN.NOMBRE,CAN.LETRA,CAN.FECHA_COMPOSICION FROM CANCIONES AS CAN
              INNER JOIN ARTISTA_COMPUSO_CANCION AS ACC ON ACC.ID_CANCION = CAN.ID
              WHERE ACC.ID_ARTISTA = {$_SESSION['usuario']['id']}";
              $resultado = pg_query($dbconn, $query);
              $array = pg_fetch_all($resultado);
              if($array){
                foreach ($array as $fila) {
            ?>
              <tr>
                <td><?= $fila['id']?></td>
                <td><?= $fila['nombre']?></td>
                <td><?= $fila['letra']?></td>
                <td><?= $fila['fecha_composicion']?></td>
                <td>
                  <a href="editarCancion.php?id=<?= $fila['id']?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                  <a href="../controllers/eliminarCancion.php?id=<?= $fila['id']?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
              </tr>
            <?php }}?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>