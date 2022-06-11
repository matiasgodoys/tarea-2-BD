<?php 
include('db_config.php');
session_start();

if(isset($_POST['agregarAlbum'])){
  $nombre = strtoupper($_POST['nombre']);
  $fecha = $_POST['fecha'];

  if(strlen($nombre) == 0){
    $_SESSION['mensaje'] = "Debe enviar el nombre!";
    $_SESSION['color'] = "danger";
    header('Location: ../views/dashboard.php');
    return;
  }

  if(strlen($fecha) == 0){
    $_SESSION['mensaje'] = "Debe enviar la fecha de lanzamiento!";
    $_SESSION['color'] = "danger";
    header('Location: ../views/dashboard.php');
    return;
  }

  $path = "img/". basename($_FILES['imagen']['name']); 
  $subido = move_uploaded_file($_FILES['imagen']['tmp_name'], "../".$path);
  
  if($subido){
    $query = "INSERT INTO ALBUM (nombre,imagen,fecha_lanzamiento) values('$nombre','$path','$fecha')";
  }else{
    $query = "INSERT INTO ALBUM (nombre,fecha_lanzamiento) values('$nombre','$fecha')";
  }
  
  $resultado = pg_query($dbconn,$query);
  if($resultado){
    $_SESSION['mensaje'] = "Album agregado!";
    $_SESSION['color'] = "success";
    header('Location: ../views/dashboard.php');
    return;
  }
  $_SESSION['mensaje'] = "Huvo un problema en la BD!";
  $_SESSION['color'] = "dander";
  header('Location: ../views/dashboard.php');
}
?>