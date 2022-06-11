<?php 
include('db_config.php');
session_start();

if(isset($_POST['editarAlbum'])){
  $id = $_GET['id'];
  $nombre = strtoupper($_POST['nombre']);
  $fecha = $_POST['fecha'];

  if(strlen($nombre) == 0){
    $_SESSION['mensaje'] = "Debe enviar el nombre!";
    $_SESSION['color'] = "danger";
    header('Location: ../views/editarAlbum.php?id='.$id);
    return;
  }

  if(strlen($fecha) == 0){
    $_SESSION['mensaje'] = "Debe enviar la fecha de lanzamiento!";
    $_SESSION['color'] = "danger";
    header('Location: ../views/editarAlbum.php?id='.$id);
    return;
  }

  $path = "img/". basename($_FILES['imagen']['name']); 
  $subido = move_uploaded_file($_FILES['imagen']['tmp_name'], "../".$path);
  
  if($subido){
    $query = "UPDATE ALBUM set nombre='$nombre',imagen='$path',fecha_lanzamiento='$fecha' WHERE ID=$id";
  }else{
    $query = "UPDATE ALBUM set nombre='$nombre',fecha_lanzamiento='$fecha' WHERE ID=$id";
  }
  
  $resultado = pg_query($dbconn,$query);
  if($resultado){
    $_SESSION['mensaje'] = "Album Editado!";
    $_SESSION['color'] = "success";
    header('Location: ../views/dashboard.php');
    return;
  }
  $_SESSION['mensaje'] = "Huvo un problema en la BD!";
  $_SESSION['color'] = "dander";
  header('Location: ../views/dashboard.php');
}
?>