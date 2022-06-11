<?php 
  include('../include/navbar.php');
  include('../controllers/db_config.php');
?>
  <div class="container p-4">
    <div class="row mt-5">
      <?php 
        if($_SESSION['usuario']['tipo'] == 'artista'){
          include('albunes.php');
        }else if($_SESSION['usuario']['tipo'] == 'usuario'){?>
          <div class="col-md-8 mx-auto">
            <h2 class="text-white">Lista de canciones</h2>
            <table class="table table-light">
              <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Fecha Composición</th>
                <th>Acción</th>
              </thead>
              <tbody>
                <?php
                    $query = "SELECT * FROM CANCIONES";
                    $resultado = pg_query($dbconn, $query);
                    $array = pg_fetch_all($resultado);
                    if($array){
                      foreach ($array as $fila) {
                  ?>
                    <tr>
                      <td><?= $fila['id']?></td>
                      <td><?= $fila['nombre']?></td>
                      <td><?= $fila['fecha_composicion']?></td>
                      <td>
                        <a href="detalleCancion.php?id=<?= $fila['id']?>" title="Ver detalles" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                  <?php }}?>
              </tbody>
            </table>
          </div>
      <?php }?>
    </div>
  </div>
</body>
</html>