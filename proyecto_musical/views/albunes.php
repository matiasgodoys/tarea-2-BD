<div class="col-md-4 mx-auto">
<?php if(isset($_SESSION['mensaje'])){ ?>
  <div class="alert alert-<?= $_SESSION['color']?> alert-dismissible fade show" role="alert">
    <strong><?= $_SESSION['mensaje']?></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php unset($_SESSION['mensaje']); unset($_SESSION['color']);}?>
<div class="card">
  <div class="card-header">
    <h2>Agregar Album</h2>
  </div>
  <div class="card-body">
    <form action="../controllers/agregarAlbum.php" method="POST" 
      enctype="multipart/form-data">
      <div class="mb-3">
        <input type="text" name="nombre" class="form-control"
          placeholder="Nombre">
      </div>
      <div class="mb-3">
      <label class="form-label" for="imagen">Imagen: </label>
        <input type="file" accept="image/*" name="imagen" class="form-control"
          placeholder="Imagen" id="imagen">
      </div>
      <div class="mb-3">
      <label class="form-label" for="fecha">Fecha lanzamiento: </label>
        <input type="date" name="fecha" 
          class="form-control" id="fecha">
      </div>
      
      <input type="submit" class="w-100 btn btn-primary" name="agregarAlbum"
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
      <th>Imagen</th>
      <th>Fecha lanzamiento</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php
      include('../controllers/db_config.php');
      $query = "SELECT * FROM ALBUM";
      $resultado = pg_query($dbconn, $query);
      $array = pg_fetch_all($resultado);
      if($array){
        foreach ($array as $fila) {
    ?>
      <tr>
        <td><?= $fila['id']?></td>
        <td><?= $fila['nombre']?></td>
        <td>
          <?php if($fila['imagen']){ ?>
            <img src="<?= "../".$fila['imagen']?>" class="rounded mx-auto">
          <?php }else{?>
            <span class="mx-auto d-block-inline">N/A</span>
          <?php }?>
        </td>
        <td><?= $fila['fecha_lanzamiento']?></td>
        <td>
          <a href="editarAlbum.php?id=<?= $fila['id']?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
          <a href="../controllers/eliminarAlbum.php?id=<?= $fila['id']?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
        </td>
      </tr>
    <?php }}?>
  </tbody>
</table>
</div>