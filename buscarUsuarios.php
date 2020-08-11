<?php 
session_start();
  $idgrupo = $_SESSION['grupo'];
  $id_usuario=$_SESSION['login'];
?>
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
		$dato = strtoupper($_REQUEST['dato']);
		require("conexion.php");
        $cant = 0;
        $consulta=mysqli_query($conexion,"SELECT mail FROM usuarios WHERE id_usuario='$id_usuario'"); 
        while($r=mysqli_fetch_array($consulta)){$email=$r['mail'];}
		$sql = "SELECT * FROM empleados WHERE (nombre LIKE'$dato%') AND mail!='$email'";
        $result = mysqli_query($conexion, $sql);
        $grupo=mysqli_query($conexion,"SELECT p.nombre_permiso , up.id_permiso FROM permisos AS p, grupos_permisos AS up WHERE p.id_permiso=up.id_permiso AND up.id_grupo='$idgrupo'");
		$cant = mysqli_num_rows($result);
        mysqli_close($conexion);
                  while($row=mysqli_fetch_array($result)){?>
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
                <?php
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