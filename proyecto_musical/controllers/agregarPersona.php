<?php
  include('db_config.php');
  session_start();

  if(isset($_POST['registrarse'])){
    $nombre = strtoupper($_POST['nombre']);
    $apellido = strtoupper($_POST['apellido']);
    $email = strtoupper($_POST['email']);
    $password = $_POST['password'];
    $tipo = $_POST['tipo'];
    
    if(strlen($nombre) == 0){
      $_SESSION['error'] = "Debe enviar el nombre!";
      header("Location: ../views/registro.php");
      return;
    }
    
    if(strlen($email) == 0){
      $_SESSION['error'] = "Debe enviar el email!";
      header("Location: ../views/registro.php");
      return;
    }

    if(strlen($password) < 4){
      $_SESSION['error'] = "El password debe tener al menos 4 dígitos!";
      header("Location: ../views/registro.php");
      return;
    }
    
    $query = "SELECT * FROM PERSONAS WHERE email='$email'";
    $resultado = pg_query($dbconn, $query);
    $existeEmail = pg_fetch_object($resultado);
    if($existeEmail != null){
      $_SESSION['error'] = "El email ya esta en uso!";
      header("Location: ../views/registro.php");
      return;
    }

    if(strlen($apellido) == 0){
      $query = "INSERT INTO PERSONAS (NOMBRE,EMAIL,PASSWORD) VALUES('$nombre','$email','$password')";
    }else{
      $query = "INSERT INTO PERSONAS (NOMBRE,APELLIDO,EMAIL,PASSWORD) VALUES('$nombre','$apellido','$email','$password')";
    }
    $resultado = pg_query($dbconn, $query);
    if($resultado == false){
      $_SESSION['error'] = "Ocurrio un error en la BD!";
      header("Location: ../views/registro.php");
      return;
    }

    $query = "SELECT currval(pg_get_serial_sequence('personas','id')) as id";
    $resultado = pg_query($dbconn, $query);
    $id = pg_fetch_array($resultado);
    if($tipo == "artista"){
      $nombreArtistico = $_POST['nombreArtistico'];
      if(strlen($nombreArtistico) == 0){
        $query = "INSERT INTO ARTISTAS (id) values({$id['id']})";
      }else{
        $nombreArtistico = strtoupper($nombreArtistico);
        $query = "INSERT INTO ARTISTAS (id, nombre_artistico) values({$id['id']},'$nombreArtistico')";
      }
    }else{
      $query = "INSERT INTO USUARIOS (id) VALUES({$id['id']})";
    }

    $resultado = pg_query($dbconn, $query);
    if($resultado){
      header("Location: ../views/login.php");
      return;
    }
    $_SESSION['error'] = "Ocurrio un error en la BD!";
    header("Location: ../views/registro.php");
  }
?>