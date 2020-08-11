<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
</head>
<body>
   <?php 
      require("header.php");
      require("conexion.php");  
      $grupo=mysqli_query($conexion,"SELECT p.nombre_permiso,up.id_permiso FROM permisos AS p, grupos_permisos AS up WHERE p.id_permiso=up.id_permiso AND up.id_grupo='$idgrupo'"); 
   ?>
   <div class="container">
       <div class="row">
       <div class="col-md-12">
               <?php 
               while($r=mysqli_fetch_array($grupo)){
                $nombrePermiso=$r['nombre_permiso'];
                if($nombrePermiso=="alta usuario" || $nombrePermiso=="baja usuario" || $nombrePermiso=="modificar usuario" || $nombrePermiso=="buscar usuario"){?>
               <nav class="navbar navbar-expand-lg navbar-light" style="float:right">
               <ul class="navbar-nav mr-auto" style="padding-top:10px;">
              <?php 
              $grupo=mysqli_query($conexion,"SELECT p.nombre_permiso,up.id_permiso FROM permisos AS p, grupos_permisos AS up WHERE p.id_permiso=up.id_permiso AND up.id_grupo='$idgrupo'");
              while($r=mysqli_fetch_array($grupo)){
                   $nombrePermiso=$r['nombre_permiso'];
                             if($nombrePermiso=="alta usuario"){?>
                                <li class="nav-item" style="margin:10px">
                                    
                                    <form method="POST" action="altaModUsuario.php">
                                        <button  class="btn btn-dark" style="margin-top: 3%;width: 100%;" name="alta" value="alta"><i class="far fa-arrow-alt-circle-up"></i>Alta usuario</button>
                                     </form>
                                </li>
                               <?php }
                                     if($nombrePermiso=="asignar permisos"){?>
                                        <li class="nav-item" style="margin:10px">
                                        <form method="POST" action="asignarPermisos.php">
                                            <button  class="btn btn-dark" style="margin-top: 3%;width: 100%;" name="permiso" value="permiso"><i class="far fa-arrow-alt-circle-up"></i>Alta grupo</button>
                                        </form>
                                        </li>
                                       <?php }
                               ?>
               <?php }?>
               </ul>
             </nav>
           </div>
       <div class="col s12">
				<h3 align="center" style="color:white">Buscar</h3>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<input style="width:100%" type="text" id="dato" autofocus="true" placeholder="Ingerse el nombre a buscar" onkeyup="buscar()">
            </div>
            <br><br>
		</div>
        <div id="result" style="border: 1px solid white; height: 300px; overflow-y: scroll" hidden></div>
        <div id="tabla" style="border: 1px solid white; height: 300px; overflow-y: scroll">
        <table class="table striped" style="color:white">
                <thead>
                <th>Nombre</th>
        <th>Apellido</th>
        <th>Dni</th>
		<th>domicilio</th>
		<th>fecha de nacimiento</th>
        <th>email</th>
        <th></th>
		<th></th>
                </thead>
                <tbody>
                <?php 
                $consulta=mysqli_query($conexion,"SELECT mail FROM usuarios WHERE id_usuario='$id_usuario'"); 
                while($r=mysqli_fetch_array($consulta)){$email=$r['mail'];}               
                $select=mysqli_query($conexion,"SELECT * FROM empleados WHERE mail!='$email'");
                  while($row=mysqli_fetch_array($select)){?>
                    <tr>
				<td>
					<?php echo $row['nombre'];?>
				</td>
				<td>
					<?php echo $row['apellido'];?>
                </td>
                <td>
					<?php echo $row['numero_documento'];?>
				</td>
				<td>
					<?php echo $row['domicilio'];?>
                </td>
                <td>
					<?php echo $row['fecha_nacimiento'];?>
				</td>
				<td>
					<?php echo $row['mail'];?>
                </td>
                <?php $grupo=mysqli_query($conexion,"SELECT p.nombre_permiso , up.id_permiso FROM permisos AS p, grupos_permisos AS up WHERE p.id_permiso=up.id_permiso AND up.id_grupo='$idgrupo'");
                 while($r=mysqli_fetch_array($grupo)){
                    $nombrePermiso=$r['nombre_permiso'];
                    if($nombrePermiso=="baja usuario"){?>
				<td>
                    <a style="border-radius:30px" class="btn btn-dark" href="ABM.php?borrarUsuario=<?php echo $row['id_empleado']; ?>"><i class="fas fa-trash-alt"></i></a>
                </td>
                    <?php }
                    if($nombrePermiso=="modificar usuario"){?>
                <td>
                    <form method="POST" action="altaModUsuario.php">
                        <button style="border-radius:30px" type="submit" name="id_empleado" value="<?php echo $row['id_empleado']; ?>" class="btn btn-dark"><i class="fas fa-pencil-alt"></i></button>
                    </form>
                </td>
                    <?php }
                    }?>
            </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
                <?php }?>
                
              <?php  }?>
     </div>
   </div>
   <br><br><br><br><br>
   <?php require("footer.html");
         if(isset($_GET['eliminado']) && $_GET['eliminado']==1){
              echo "<script>alert('el usuario ha sido eliminado');</script>";
         }
         if (isset($_GET['estado'])&& $_GET['estado']==1){
			echo '<script> alert("datos guardados");</script>';
		}
		if (isset($_GET['estado'])&& $_GET['estado']==2){
			echo '<script> alert("Hubo problemas con el envio");</script>';
		}
		if (isset($_GET['estado'])&& $_GET['estado']==3){
			echo '<script> alert("el usuario no existe");</script>';
        }
        if (isset($_GET['estado'])&& $_GET['estado']==4){
			echo '<script> alert("error, el dni ya existe");</script>';
        }
        if (isset($_GET['estado'])&& $_GET['estado']==5){
			echo '<script> alert("error, el mail ya existe");</script>';
        }
        if (isset($_GET['estado'])&& $_GET['estado']==6){
			echo '<script> alert("el grupo fue creado con sus respectivos permisos");</script>';
        }
        if (isset($_GET['estado'])&& $_GET['estado']==7){
			echo '<script> alert("el usuario fue modificado");</script>';
	    }?>
       <script src="js/jquery-3.4.1.min.js"></script>
	<script>
		function buscar(){
			if(document.getElementById('dato').value.length>0){
                document.getElementById('result').hidden=false;
				document.getElementById('tabla').hidden=true;
				$.ajax({
					url: 'buscarUsuarios.php',
					type: 'POST',
					data: { 
						dato: document.getElementById('dato').value, 
					},
				})
				.done(function(response){
					$("#result").html(response);
				})
				.fail(function(jqXHR){
					console.log(jqXHR.statusText);
				});
			}else{
                document.getElementById('result').hidden=true;
				document.getElementById('tabla').hidden=false;
			}
		}
        function init(){
               $('#GestionarUsuarios').attr("class","");
               $('#GestionarUsuarios').attr("class","btn btn-danger");
           }
           window.onload = function () {
             init();
           }
    </script>

 </body>
</html>
