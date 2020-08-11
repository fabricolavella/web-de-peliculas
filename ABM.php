<?php
require("class.phpmailer.php");
require("class.smtp.php");
require("conexion.php");
$mensaje="recupere su clave";
if (isset($_POST['guardar']) && !empty($_POST['guardar'])) {
	require("conexion.php");
	$titulo = $_POST['titulo'];
	$duracion = $_POST['duracion'];
	$puntaje = $_POST['puntaje'];
	$imagen = $_POST['imagen'];
	$pelicula = $_POST['pelicula'];
	$trailer = $_POST['trailer'];
	$descripcion = $_POST['descripcion'];
	$anio = $_POST['anio'];
	$generos='';
	if(isset($_POST['nombre_genero'])){
	   foreach($_POST['nombre_genero'] as $selected){
		  $generos=$generos.' '.$selected;
	   }
	}
			$registros=mysqli_query($conexion,"SELECT titulo from movies WHERE titulo='$titulo'");
            if(mysqli_num_rows($registros)>0){  
				$select=mysqli_query($conexion,"SELECT genero FROM movies WHERE titulo='$titulo'");
				while($r=mysqli_fetch_array($select)){$nombre_genero=$r['genero'];}
				header("location:peliculas.php?genero=$nombre_genero&pagina=1&estado=3");         
            }else{
			 $Insert=mysqli_query($conexion,"INSERT INTO movies values (00,'$titulo','$generos','$duracion','$descripcion',$puntaje,'$imagen','$anio','$pelicula','$trailer')");
			 header("location:peliculas.php?genero=$generos&esatado=1");
			}
};
if(isset($_POST['guardarUsuario']) && !empty($_POST['guardarUsuario'])) {
	require("conexion.php");
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$tipo_documento = $_POST['descripcion'];
	$numero_documento = $_POST['numero_documento'];
	$domicilio = $_POST['domicilio'];
	$fecha_nacimiento = $_POST['fecha_nacimiento'];
	$email = $_POST['mail'];
	$grupo = $_POST['nombre_grupo'];
	$consulta=mysqli_query($conexion,"SELECT id_tipo_documento FROM tipos_documentos WHERE descripcion='$tipo_documento'");
	$consulta2=mysqli_query($conexion,"SELECT id_grupo FROM grupos WHERE nombre_grupo='$grupo'");
	while($r=mysqli_fetch_array($consulta)){$id_tipo_documento=$r['id_tipo_documento'];}
	while($r=mysqli_fetch_array($consulta2)){$id_grupo=$r['id_grupo'];}
	$registros=mysqli_query($conexion,"SELECT numero_documento from empleados WHERE numero_documento='$numero_documento'");
	$registro2=mysqli_query($conexion,"SELECT mail FROM usuarios WHERE mail='$email'");
    if(mysqli_num_rows($registros)>0 || mysqli_num_rows($registro2)>0){
		if(mysqli_num_rows($registros)>0){  
		  header("location:gestionarUsuarios.php?estado=4");  
		}
		if(mysqli_num_rows($registro2)>0){  
			header("location:gestionarUsuarios.php?estado=5");  
		  }      
	}else{
		 $Insert=mysqli_query($conexion,"INSERT INTO empleados values (00,$id_tipo_documento,$numero_documento,'$nombre','$apellido','$domicilio','$fecha_nacimiento','$email')");
	     $Insert2=mysqli_query($conexion,"INSERT INTO usuarios values (00,NULL,'$email',NULL,NULL)");
	     $selectIdUser=mysqli_query($conexion,"SELECT id_usuario FROM usuarios WHERE mail='$email'");
	      while($r=mysqli_fetch_array($selectIdUser)){$id_usuario=$r['id_usuario'];}
			$Insert3=mysqli_query($conexion,"INSERT INTO grupos_usuarios values($id_grupo,$id_usuario)");
			include("sendmail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico
			$consulta=mysqli_query($conexion,"SELECT * FROM usuarios WHERE mail='$email'");
            if($r=mysqli_fetch_array($consulta)){
                echo "enviar email a ".$r['mail'];
                $token=uniqid();
                $sql=mysqli_query($conexion,"UPDATE usuarios set token='$token' WHERE mail='{$r['mail']}'");
				$smtpHost = "smtp.gmail.com";  // Dominio alternativo brindado en el email de alta 
                $smtpUsuario = ("tuspelisfc@gmail.com");  // Mi cuenta de correo
                $smtpClave = "Pelisfc_1997";  // Mi contraseña
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->Port = 587; 
                $mail->IsHTML(true); 
                $mail->CharSet = "utf-8";
               // VALORES A MODIFICAR //
                $mail->Host = $smtpHost; 
                $mail->Username = $smtpUsuario; 
                $mail->Password = $smtpClave;
                $mail->setFrom = $smtpUsuario;
                $mail->FromName= "tuspelisfc"; // Email desde donde envío el correo.
                $mail->AddAddress($email); // Esta es la dirección a donde enviamos los datos del formulario
                $mail->Subject = "formulario de activacion de su cuenta para PELISFC"; // Este es el titulo del email.
                $mensajeHtml = nl2br($mensaje);
                $mail->Body = "<html> 
                                   <body> 
                                        <h1 align='center'>PELISFC</h1>
                                        <div style='background:black;color:white;padding:20px'><h2>formulario de activacion de su cuenta</h2></div>
                                        <p>hola {$r['nombre_usuario']},</p>
                                        <p>Ingresa al siguiente link para crear tu cuenta como empleado del sistema: </p>
                                        <a href='http://localhost/Colavella_Fabricio_Final_EDI/recuperar.php?token=$token&estado=1'>Haz clic aquí para crear tu cuenta</a>
                                   </body> 
                               </html>
                               <br />"; // Texto del email en formato HTML
                $mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
                $mail->SMTPOptions = array(
                   'ssl' => array(
                   'verify_peer' => false,
                   'verify_peer_name' => false,
                   'allow_self_signed' => true
                  )
                );
                $estadoEnvio = $mail->Send(); 
                if($estadoEnvio){
                   header("location:gestionarUsuarios.php?estado=1");
                } else {
                   header("location:gestionarUsuarios.php?estado=2");
                   exit();
                }
            }else{
                header("location:gestionarUsuarios.php?estado=3");
          }
			 header("location:gestionarUsuarios.php?estado=1");
		}
}
if (isset($_POST['Modificar']) && !empty($_POST['Modificar'])) {
	require("conexion.php");
	$titulo = $_POST['titulo'];
	$titulo_anterior=$_POST['titulo_anterior'];
	$genero = $_POST['genero'];
	$duracion = $_POST['duracion'];
	$puntaje = $_POST['puntaje'];
	$imagen = $_POST['imagen'];
	$anio = $_POST['anio'];
	$pelicula = $_POST['pelicula'];
	$trailer = $_POST['trailer'];
	$descripcion = $_POST['descripcion'];
	$id = $_POST['id_pelicula'];
	$generos='';
	if(isset($_POST['nombre_genero'])){
	   foreach($_POST['nombre_genero'] as $selected){
		  $generos=$generos.' '.$selected;
	   }
    }
	$Actualizar = "UPDATE movies SET titulo='$titulo',genero='$generos',duracion='$duracion',descripcion='$descripcion',puntaje='$puntaje',imagen='$imagen',anio='$anio',pelicula='$pelicula', trailer='$trailer' WHERE titulo='$titulo_anterior'";
	$enviar = mysqli_query($conexion, $Actualizar);
	header("location:peliculas.php?genero=$generos&pagina=1&esatado=2");
}
if (isset($_POST['ModificarUsuario']) && !empty($_POST['ModificarUsuario'])) {
	require("conexion.php");
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$domicilio = $_POST['domicilio'];
	$fecha_nacimiento = $_POST['fecha_nacimiento'];
	$grupo = $_POST['nombre_grupo'];
	$consulta2=mysqli_query($conexion,"SELECT id_grupo FROM grupos WHERE nombre_grupo='$grupo'");
	while($r=mysqli_fetch_array($consulta2)){
		$id_grupo=$r['id_grupo'];
	}
	$id_usuario = $_POST['id_usuario'];
	$id_empleado = $_POST['id_empleado'];
	$delete=mysqli_query($conexion,"DELETE FROM grupos_usuarios WHERE id_usuario='$id_usuario'");
	$actualizar2=mysqli_query($conexion,"INSERT INTO grupos_usuarios VALUES($id_grupo,$id_usuario)");
	$Actualizar = "UPDATE empleados SET nombre='$nombre',apellido='$apellido',domicilio='$domicilio',fecha_nacimiento='$fecha_nacimiento' WHERE id_empleado=$id_empleado";
	$enviar = mysqli_query($conexion, $Actualizar);	
	header("location:gestionarUsuarios.php?estado=7");
}
if (isset($_POST['id_pelicula'])) {
	$idPelicula = $_POST['id_pelicula'];
	$ngenero=$_POST['genero'];
	$pagina=$_POST['pagina'];
	$select = mysqli_query($conexion, "SELECT genero FROM movies WHERE id_pelicula='$idPelicula'");
	while ($r = mysqli_fetch_array($select)) {
		$genero = $r['genero'];
	}
	$mostrar = mysqli_query($conexion, "select * from movies where id_pelicula='$idPelicula'");
	$delete = mysqli_query($conexion, "delete from usuarios_movies where id_pelicula='$idPelicula'");

	$delete2 = mysqli_query($conexion, "delete from movies where id_pelicula='$idPelicula'");

	header("location:peliculas.php?genero=$ngenero&pagina=$pagina&eliminado=1");
}
if (isset($_GET['borrarUsuario'])) {
	$id_empleado = $_GET['borrarUsuario'];
	$mostrar = mysqli_query($conexion, "SELECT * FROM empleados WHERE id_empleado='$id_empleado'");
	while($r=mysqli_fetch_array($mostrar)){
		$email=$r['mail'];
	}
	$mostrar2 = mysqli_query($conexion, "SELECT id_usuario FROM usuarios WHERE mail='$email'");
	while($r=mysqli_fetch_array($mostrar2)){
		$id_usuario=$r['id_usuario'];
	}
	$delete = mysqli_query($conexion, "DELETE FROM grupos_usuarios WHERE id_usuario='$id_usuario'");
	$delete2 = mysqli_query($conexion, "DELETE FROM usuarios WHERE id_usuario='$id_usuario'");
	$delete3 = mysqli_query($conexion, "DELETE FROM empleados WHERE id_empleado='$id_empleado'");
	header("location:gestionarUsuarios.php?eliminado=1");
}
?>