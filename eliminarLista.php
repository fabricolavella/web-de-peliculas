<?php 
session_start();
require("conexion.php");
if (isset($_SESSION['login'])) {
  if (isset($_GET['id_pelicula'])) {
      $idPelicula=$_GET['id_pelicula'];
      $idUser=$_SESSION['login'];

  }
}
  $delete=mysqli_query($conexion,"DELETE FROM usuarios_movies WHERE id_pelicula='$idPelicula' and id_usuario='$idUser'");	
  header("location:lista.php?estado=1");
?>