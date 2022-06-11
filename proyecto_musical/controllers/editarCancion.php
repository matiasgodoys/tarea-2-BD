<?php 
include('db_config.php');
session_start();

if(isset($_POST['editarCancion'])){
  $nombre = strtoupper($_POST['nombre']);
  $letra = strtoupper($_POST['letra']);
  $fecha = $_POST['fecha'];
  $id = $_GET['id'];

  if(strlen($nombre) == 0){
    $_SESSION['mensaje'] = "Debe enviar el nombre!";
    $_SESSION['color'] = "danger";
    header('Location: ../views/editarCancion.php');
    return;
  }

  if(strlen($fecha) == 0 && strlen($letra) == 0){
    $query = "UPDATE CANCIONES SET NOMBRE= '$nombre' WHERE ID = $id";
  }else if(strlen($fecha) > 0 && strlen($letra) == 0){
    $query = "UPDATE CANCIONES SET NOMBRE= '$nombre', FECHA_COMPOSICION='$fecha' WHERE ID = $id";
  }else if(strlen($fecha) == 0 && strlen($letra) > 0){
    $query = "UPDATE CANCIONES SET NOMBRE= '$nombre', LETRA='$letra' WHERE ID = $id";
  }else{
    $query = "UPDATE CANCIONES SET NOMBRE= '$nombre', FECHA_COMPOSICION='$fecha', LETRA='$letra' WHERE ID = $id";
  }

  $resultado = pg_query($dbconn,$query);
  if(!$resultado){
    $_SESSION['mensaje'] = "Ocurrió un error en la BD!";
    $_SESSION['color'] = "danger";
    header('Location: ../views/canciones.php');
    return;
  }

  $_SESSION['mensaje'] = "Cancion actualizada!";
  $_SESSION['color'] = "success";
  header('Location: ../views/canciones.php');
}
?>