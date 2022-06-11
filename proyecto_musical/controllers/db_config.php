<?php
/* Detalles de la conexión */
$conn_string = "host=localhost port=5432 dbname=plataforma_musical user=postgres password=admin";
// Recuerde reemplazar "<contraseña>" por su contraseña y "<nombre_db>" por el nombre de su BD. No se incluyen los "<>".
// Establecemos una conexión con el servidor postgresSQL
$dbconn = pg_connect($conn_string);

// Revisamos el estado de la conexión en caso de errores.
if(!$dbconn) {
  echo '<div class="alert alert-danger"><strong>Error:</strong> No se ha podido conectar con la base de datos.</div>';
}
?>