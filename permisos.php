<?php
require("conexion.php");
$nombreGrupo=$_POST['nombre_grupo'];
$nombrePermiso=$_POST['nombre_permiso'];
$consulta=mysqli_query($conexion,"SELECT * FROM grupos WHERE nombre_grupo='$nombreGrupo'");
if(mysqli_num_rows($consulta)>0){
    header("location:asignarPermisos.php?estado=1");
}else{
   $insert=mysqli_query($conexion,"INSERT INTO grupos VALUES(00,'$nombreGrupo')");
}
$select=mysqli_query($conexion,"SELECT id_grupo FROM grupos WHERE nombre_grupo='$nombreGrupo'");
while($r=mysqli_fetch_array($select)){$idGrupo=$r['id_grupo'];}
if(!empty($nombrePermiso)){
    // Ciclo para mostrar las casillas checked checkbox.
    foreach($_POST['nombre_permiso'] as $selected){
        $select2=mysqli_query($conexion,"SELECT id_permiso FROM permisos WHERE nombre_permiso='$selected'");
        while($r=mysqli_fetch_array($select2)){$idPermiso=$r['id_permiso'];}
       $insert2=mysqli_query($conexion,"INSERT INTO grupos_permisos VALUES($idGrupo,$idPermiso)");
    }
     header("location:gestionarUsuarios.php?estado=6");
    }
?>