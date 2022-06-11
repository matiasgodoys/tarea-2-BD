<?php
include('db_config.php');
session_start();

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $query = "DELETE FROM ALBUM WHERE ID=$id";
  $resultado = pg_query($dbconn, $query);
  if($resultado){
    $_SESSION['mensaje'] = "Album eliminado!";
    $_SESSION['color'] = "success";
    header('Location: ../views/dashboard.php');
    return;
  }
  $_SESSION['mensaje'] = "Huvo un problema en la BD!";
  $_SESSION['color'] = "danger";
  header('Location: ../views/dashboard.php');
}
?>