<!DOCTYPE html>
 <html>
   <head>
    <title><?php if (isset($_GET['id_empleado'])) { echo "Modificar usuario";}else{echo "Alta usuario";}?></title> 
    <style>
      .checkbox {
         position: relative;
         padding-left: 18px;
         margin-bottom: 12px;
         cursor: pointer;
         font-size: 13px;
         -webkit-user-select: none;
         -moz-user-select: none;
         -ms-user-select: none;
         user-select: none;
         margin-left: 20px;
      }
      .checkbox input {
         position: absolute;
         opacity: 0;
         cursor: pointer;
       }
.check {
    position: absolute;
    top:2px;
    left: 0;
    height: 15px;
    width: 15px;
    background-color: #eee;
    border: 1px solid #121212;
}

/* on mouse-over, add border color */
.checkbox:hover input ~ .check {
    border: 2px solid grey;
}

/* add background color when the checkbox is checked */
.checkbox input:checked ~ .check {
    background-color: #212121;
    border:none;
}

/* create the checkmark and hide when not checked */
.check:after {
    content: "";
    position: absolute;
    display: none;
}

/* show the checkmark when checked */
.checkbox input:checked ~ .check:after {
    display: block;
}

/* checkmark style */
.checkbox .check:after {
    left: 5px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
#selectTipo{
    background:#212121;
    color:white;
}

    </style>
   </head>
   <body>
   <?php require ("header.php");
   require ("conexion.php");?>
 
    <div class="container" style="padding-top:40px;">
		<div class="row">
   
            <div align="center" class="col-md-12 alta">
            <?php 
    if (isset($_POST['id_empleado'])) {
       $id_empleado=$_POST['id_empleado'];
       $consulta="SELECT * FROM empleados WHERE id_empleado='$id_empleado'";
       $resultado=mysqli_query($conexion,$consulta);
       $datos=mysqli_fetch_assoc($resultado);
       $dni=$datos['id_tipo_documento'];
       $email=$datos['mail'];
       $consulta2=mysqli_query($conexion,"SELECT descripcion FROM tipos_documentos WHERE id_tipo_documento=$dni");
       while($r=mysqli_fetch_array($consulta2)){
          $tipo_dni=$r['descripcion'];
       }
       $consulta3=mysqli_query($conexion,"SELECT descripcion FROM tipos_documentos");
       $consulta4=mysqli_query($conexion,"SELECT id_usuario FROM usuarios WHERE mail='$email'");
       if($r=mysqli_fetch_array($consulta4)){
         $id_usuario=$r['id_usuario'];
         $consulta5=mysqli_query($conexion,"SELECT id_grupo FROM grupos_usuarios WHERE id_usuario=$id_usuario");
         while($r=mysqli_fetch_array($consulta5)){
           $id_grupo=$r['id_grupo'];
         }
         $consulta6=mysqli_query($conexion,"SELECT nombre_grupo FROM grupos WHERE id_grupo=$id_grupo");
         while($r=mysqli_fetch_array($consulta6)){
          $nombre_grupo=$r['nombre_grupo'];
         }
       }
       $consulta7=mysqli_query($conexion,"SELECT nombre_grupo FROM grupos WHERE nombre_grupo!='ESPECTADOR'");
   ?>
    <form method="POST" action="ABM.php" style="width:70%">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nombre</label>
      <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $datos['nombre'];?>" required placeholder="ingrese su nombre completo">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Apellido</label>
      <input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $datos['apellido'];?>" required placeholder="ingrese su apellido">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
       <label for="selectTipo">Tipo de documento</label>
		<select class="form-control" id="selectTipo" name="descripcion" disabled>
        <?php while($r=mysqli_fetch_array($consulta3)){?>
					<option <?php if($tipo_dni==$r['descripcion']) echo 'Selected'?>><?php echo $r['descripcion'];?></option>
        <?php }?>    
		</select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Numero de documento</label>
      <input type="text" class="form-control" name="numero_documento" id="numero_documento" value="<?php echo $datos['numero_documento'];?>" disabled>
      <input type="text" class="form-control" name="id_empleado" id="id_empleado" value="<?php echo $datos['id_empleado'];?>" hidden>
      <input type="text" class="form-control" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario;?>" hidden>
    </div>
  </div>
    <div class="form-group">
      <label for="inputEmail4">Domicilio</label>
      <input type="text" class="form-control" name="domicilio" id="domicilio" value="<?php echo $datos['domicilio'];?>" required placeholder="ingrese su domicio">
    </div>

    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Fecha de nacimiento</label>
      <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento"value="<?php echo $datos['fecha_nacimiento'];?>" required placeholder="ingrese su nombre completo">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">email</label>
      <input type="email" class="form-control" name="mail" id="mail" value="<?php echo $datos['mail'];?>" disabled>
    </div>
  </div>
  <div class="form-group">
  <label for="selectGrupo">Tipo de grupo</label>
		<select  class="form-control" id="selectTipo" name="nombre_grupo">
        <?php while($r=mysqli_fetch_array($consulta7)){?>
					<option <?php if($nombre_grupo==$r['nombre_grupo']) echo 'Selected'?>><?php echo $r['nombre_grupo'];?></option>
        <?php }?>    
		</select> 
  </div>

  <div class="form-group">
  <button  class="btn btn-dark" style="margin-top: 3%;width: 100%;" value="ModificarUsuario" name="ModificarUsuario"><i class="fas fa-save"></i> Guardar</button>
  <button style="margin-top: 3%;width: 100%;" class="btn btn-dark"><a style="text-decoration: none;color: white;" href="gestionarUsuarios.php"><i class="fas fa-ban"></i> Cancelar</a></button>
  </div>
  
</form>
<?php 
    if (isset($_GET['estado'])&& $_GET['estado']==1) {
	     echo "<script type='text/javascript'>alert('Datos Modificados');</script>";
    }
}
if(isset($_POST['alta']) && !empty($_POST['alta'])){
$select=mysqli_query($conexion,"SELECT * FROM tipos_documentos;");
       $select2=mysqli_query($conexion,"SELECT * FROM grupos WHERE nombre_grupo!='ESPECTADOR';");?>

<form method="POST" action="ABM.php" style="width:70%">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nombre</label>
      <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="ingrese su nombre completo">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Apellido</label>
      <input type="text" class="form-control" name="apellido" id="apellido" required placeholder="ingrese su apellido">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
       <label for="selectTipo">Tipo de documento</label>
		<select class="form-control" id="selectTipo" name="descripcion">
        <?php while($r=mysqli_fetch_array($select)){?>
					<option><?php echo $r['descripcion'];?></option>
        <?php }?>    
		</select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Numero de documento</label>
      <input type="text" class="form-control" name="numero_documento" id="numero_documento" required placeholder="ingrese solo numeros">
    </div>
  </div>
    <div class="form-group">
      <label for="inputEmail4">Domicilio</label>
      <input type="text" class="form-control" name="domicilio" id="domicilio" required placeholder="ingrese su domicio">
    </div>

    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Fecha de nacimiento</label>
      <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required placeholder="ingrese su nombre completo">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">email</label>
      <input type="email" class="form-control" name="mail" id="mail" required placeholder="ejemplo@ejemplo.com">
    </div>
  </div>
  <div class="form-group">
  <label for="selectGrupo">Tipo de grupo</label>
		<select style="background:#212121;color:white" class="form-control" id="selectGrupo" name="nombre_grupo">
        <?php while($r=mysqli_fetch_array($select2)){?>
					<option><?php echo $r['nombre_grupo'];?></option>
        <?php }?>    
		</select> 
  </div>

  <div class="form-group">
  <button  class="btn btn-dark" style="margin-top: 3%;width: 100%;" value="guardarUsuario" name="guardarUsuario"><i class="fas fa-save"></i> Guardar</button>
  <button style="margin-top: 3%;width: 100%;" class="btn btn-dark"><a style="text-decoration: none;color: white;" href="gestionarUsuarios.php"><i class="fas fa-ban"></i> Cancelar</a></button>
  </div>
  
</form>
<?php
}

 ?>
 </div>

</div>
</div>
        <br><br><br>
    <?php require ("footer.html"); ?>
    <script>
        function Numeros(string){
    var out = '';
    ok=true;
    var filtro = '1234567890';
    for (var i=0; i<string.length; i++)
       if (filtro.indexOf(string.charAt(i)) != -1)
	     out += string.charAt(i);
    
         return out;
}
function filterFloat(evt,input){
        var key = window.Event ? evt.which : evt.keyCode;    
        var chark = String.fromCharCode(key);
        var tempValue = input.value+chark;
        if(key >= 48 && key <= 57){
            if(filter(tempValue)=== false){
                return false;
            }else{       
                return true;
            }
        }else{
              if(key == 8 || key == 13 || key == 0) {     
                  return true;              
              }else if(key == 46){
                    if(filter(tempValue)=== false){
                        return false;
                    }else{       
                        return true;
                    }
              }else{
                  return false;
              }
        }
    }
    function filter(__val__){
        var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
        if(preg.test(__val__) === true){
            return true;
        }else{
           return false;
        }
        
    }
    
    </script>
   </body>
</html>