<?php 
include('../include/navbar.php');
  include('../controllers/db_config.php');
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM CANCIONES WHERE ID=$id";
    $resultado = pg_query($dbconn,$query);
    if ($resultado) {
      $array = pg_fetch_array($resultado);
    }else{
      header("Location: dashboard.php");
    }
  }else{
    header("Location: dashboard.php");
  }
?>
  <div class="container p-4">
    <div class="row mt-5">
      <div class="col-md-5 mx-auto">
        <?php if(isset($_SESSION['mensaje'])){ ?>
          <div class="alert alert-<?= $_SESSION['color']?> alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['mensaje']?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php unset($_SESSION['mensaje']); unset($_SESSION['color']);}?>
        <div class="card">
          <div class="card-header">
            <h2>Editar Canción</h2>
          </div>
          <div class="card-body">
            <form action="../controllers/editarCancion.php?id=<?= $array['id']?>" method="POST" 
              enctype="multipart/form-data">
              <div class="mb-3">
                <input type="text" name="nombre" class="form-control"
                  placeholder="Nombre"value="<?= $array['nombre']?>">
              </div>
              <div class="mb-3">
                <textarea type="text" name="letra" class="form-control"
                  placeholder="Letra" rows="4" value="<?= $array['letra']?>"></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label" for="fecha">Fecha composición: </label>
                <input type="date" name="fecha" 
                  class="form-control" id="fecha" value="<?= $array['fecha_composicion'] ?>">
              </div>
              <input type="submit" class="w-100 btn btn-primary" name="editarCancion"
                value="Guardar">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>