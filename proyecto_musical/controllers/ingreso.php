<?php
include('db_config.php');
session_start();

if(isset($_POST['ingresar'])){
  $email = strtoupper($_POST['email']);
  $password = $_POST['password'];

  if(strlen($email) == 0){
    $_SESSION['error'] = "Debe enviar el email!";
    header("Location: ../views/login.php");
    return;
  }

  if(strlen($password) < 4){
    $_SESSION['error'] = "El password debe tener al menos 4 dígitos!";
    header("Location: ../views/login.php");
    return;
  }
  
  $query = "SELECT * FROM PERSONAS WHERE email='$email' and password='$password'";
  $resultado = pg_query($dbconn, $query);
  $persona = pg_fetch_array($resultado);
  if($persona){
    $query = "SELECT * FROM ARTISTAS WHERE id={$persona['id']}";
    $resultado = pg_query($dbconn, $query);
    $artista = pg_fetch_array($resultado);
    if($artista){
      $persona['tipo'] = "artista";
      $persona['nombreArtistico'] = $artista['nombre_artistico'];
      $persona['verificado'] = $artista['verificado'];
    }else{
      $query = "SELECT * FROM USUARIOS WHERE id={$persona['id']}";
      $resultado = pg_query($dbconn, $query);
      $usuario = pg_fetch_array($resultado);
      $persona['tipo']='usuario';
      $persona['suscripcionActiva'] = $usuario['suscripcion_activa'];
    }
    $_SESSION['usuario'] = $persona;
    header("Location: ../views/dashboard.php");
    return;
  }
  $_SESSION['error'] = "La credenciales son incorrectas!";
  header("Location: ../views/login.php");
}
?>