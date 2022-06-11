<?php 
include('db_config.php');
session_start();

if(isset($_POST['agregarCancion'])){
  $nombre = strtoupper($_POST['nombre']);
  $letra = strtoupper($_POST['letra']);
  $fecha = $_POST['fecha'];
  $album = $_POST['album'];

  if(strlen($nombre) == 0){
    $_SESSION['mensaje'] = "Debe enviar el nombre!";
    $_SESSION['color'] = "danger";
    header('Location: ../views/canciones.php');
    return;
  }

  if(strlen($fecha) == 0 && strlen($letra) == 0){
    $query = "INSERT INTO CANCIONES(NOMBRE) VALUES('$nombre')";
  }else if(strlen($fecha) > 0 && strlen($letra) == 0){
    $query = "INSERT INTO CANCIONES(NOMBRE,FECHA_COMPOSICION) VALUES('$nombre','$fecha')";
  }else if(strlen($fecha) == 0 && strlen($letra) > 0){
    $query = "INSERT INTO CANCIONES(NOMBRE,LETRA) VALUES('$nombre','$letra')";
  }else{
    $query = "INSERT INTO CANCIONES(NOMBRE,LETRA,FECHA_COMPOSICION) VALUES('$nombre','$letra','$fecha')";
  }

  $resultado = pg_query($dbconn,$query);
  if(!$resultado){
    $_SESSION['mensaje'] = "Ocurrió un error en la BD!";
    $_SESSION['color'] = "danger";
    header('Location: ../views/canciones.php');
    return;
  }

  $query = "SELECT currval(pg_get_serial_sequence('canciones','id')) as id";
  $resultado = pg_query($dbconn, $query);
  $id = pg_fetch_array($resultado);
    
  $query = "INSERT INTO ARTISTA_COMPUSO_CANCION VALUES({$_SESSION['usuario']['id']},{$id['id']})";
  $resultado = pg_query($dbconn, $query);

  $query = "INSERT INTO ALBUM_TIENE_CANCION VALUES($album,{$id['id']})";
  $resultado = pg_query($dbconn, $query);
  if($resultado){
    $_SESSION['mensaje'] = "Cancion agregada!";
    $_SESSION['color'] = "success";
    header('Location: ../views/canciones.php');
    return;
  }
  $_SESSION['mensaje'] = "Huvo un problema en la BD!";
  $_SESSION['color'] = "dander";
  header('Location: ../views/canciones.php');
}
?>