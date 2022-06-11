<?php
include('db_config.php');
session_start();

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $query = "DELETE FROM CANCIONES WHERE ID=$id";
  $resultado = pg_query($dbconn, $query);
  if($resultado){
    $_SESSION['mensaje'] = "Canción eliminada!";
    $_SESSION['color'] = "success";
    header('Location: ../views/canciones.php');
    return;
  }
  $_SESSION['mensaje'] = "Huvo un problema en la BD!";
  $_SESSION['color'] = "danger";
  header('Location: ../views/canciones.php');
}
?>