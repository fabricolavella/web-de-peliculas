<?php 	
	session_start();
	require("conexion.php");
	if (isset($_POST['ingresar'] )&& !empty($_POST['ingresar'])) {
		$usuario=$_POST['usuario'];
		$password=sha1($_POST['contra']);
			$consulta= mysqli_query($conexion,"SELECT * FROM usuarios where nombre_usuario='$usuario' and contr='$password'"); 
			if($p=mysqli_fetch_assoc($consulta)){
				$idUsuario=$p['id_usuario'];
		  		if ($p['nombre_usuario']==$usuario && $p['contr']==$password) {
					$id=$p['id_usuario'];
					$select=mysqli_query($conexion,"SELECT id_grupo FROM grupos_usuarios WHERE id_usuario=$id");
					while($r=mysqli_fetch_array($select)){$idGrupo=$r['id_grupo'];}
                    $_SESSION['grupo']=$idGrupo;
		  			$_SESSION['login']=$p['id_usuario'];
		  			$_SESSION['usuario']=$p['nombre_usuario'];
                    header("location:index.php?id_grupo=$idGrupo");
		  		}
			}else{
				echo "<script>alert('usuario o contraseña incorrectos');</script>";
				require("login.html");		
			}
		}
		if (isset($_GET['invitado'])&& $_GET['invitado']==1){
				$_SESSION['login']=0;
				header("location:index.php");
		 }
		 if (isset($_GET['recuperar'])&& $_GET['recuperar']==1){
			echo '<script> alert("se ha enviado un mail a su correo con el link de restablecer contraseña");</script>';
			require("login.html");
		}
		if (isset($_GET['recuperar'])&& $_GET['recuperar']==2){
			echo '<script> alert("Hubo problemas con el envio");</script>';
			require("login.html");
		}
		if (isset($_GET['recuperar'])&& $_GET['recuperar']==3){
			echo '<script> alert("el usuario no existe");</script>';
			require("login.html");
	    }
		  if(isset($_GET['estado']) && $_GET['estado']==1){
			 echo '<script> alert("su contraseña ha sido cambiada, ingrese con su contraseña nueva");</script>';
			 require("login.html");
		  }
		  if(isset($_GET['estado']) && $_GET['estado']==2){
			echo '<script> alert("su cuenta ha sido creada con exito, ingrese con nombre de usuario y contraseña");</script>';
			require("login.html");
		 }
		
 ?>