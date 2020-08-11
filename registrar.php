 <?php
   require("conexion.php");
   $consulta=mysqli_query($conexion,"SELECT id_grupo FROM grupos WHERE nombre_grupo='ESPECTADOR'");
   while($r=mysqli_fetch_array($consulta)){$id_grupo=$r['id_grupo'];}
   $nombre_usuario=$_REQUEST['nombre_usuario'];
   $email=$_REQUEST['mail'];
   $password=sha1($_REQUEST['contr']);
        if (isset($_REQUEST['registrado']) && !empty($_REQUEST['registrado'])) {
            $registros=mysqli_query($conexion,"SELECT mail FROM usuarios WHERE mail='$email'");
            if(mysqli_num_rows($registros)>0){ 
                  echo "<script>alert('el mail ingresado esta en uso, intente con otro');</script>";          
                  require("registrarse.html");
            }else{
                $insertar=mysqli_query($conexion,"INSERT INTO usuarios VALUES(00,'$nombre_usuario','$email','$password',NULL)");
                $consulta=mysqli_query($conexion,"SELECT id_usuario FROM usuarios WHERE mail='$email'");
                 while ($r=mysqli_fetch_array($consulta)) {$id_usuario=$r['id_usuario'];}
                 $insert2=mysqli_query($conexion,"INSERT INTO grupos_usuarios VALUES($id_grupo,$id_usuario)");
                 echo "<script>alert('fue registrado con exito!');</script>";
                 require("login.html");
            }
          
         }
  ?>
