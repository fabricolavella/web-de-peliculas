
<!DOCTYPE html>
<html>
<head>
    <title>Cambiar contraseña</title>
    <style>
       .form{
          padding-top:100px;
       }
       .form label{
          float:left;
       }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body style="background:black;color:white">
   <?php 
      require("conexion.php");   
   ?>
   <div class="container">
       <div class="row">
        <?php if(isset($_GET['token']) && !isset($_GET['estado'])){
            $token=$_GET['token'];
            $select=mysqli_query($conexion,"SELECT * FROM usuarios WHERE token='$token'");
            if($r=mysqli_fetch_array($select)){
                  $update=mysqli_query($conexion,"UPDATE usuarios SET token= null WHERE id_usuario={$r['id_usuario']}");?>
                  <div class="col-md-12" align="center"><h3><?php echo "bienvenido ".$r['nombre_usuario'];?></h3></div>
                  <div class="col-md-12 form" align="center">
                       <form action="recuperar.php?id_usuario=<?php echo $r['id_usuario'];?>&cambiar" method="POST" onsubmit="return form(this)" style="width:50%" class="rp">
                            <div class="form-row">
                               <div class="form-group col-md-12">
                                  <label for="inputEmail4">Contraseña nueva</label>
                                  <input type="password" class="form-control" name="contr" id="contr" placeholder="ingrese su contraseña nueva">
                               </div>
                               <div class="form-group col-md-12">
                                  <label for="inputPassword4">Repetir contraseña</label>
                                  <input type="password" class="form-control" id="contr2" placeholder="Repetir contraseña">
                               </div>
                            </div>
                            <button  class="btn btn-dark" style="width: 100%;" onclick="form()"><i class="fas fa-save"></i> Restablecer contraseña</button>
                       </form>
                  </div>
        <?php
          } 
        }
        if(isset($_GET['token']) && (isset($_GET['estado']) && $_GET['estado']==1)){
         $token=$_GET['token'];
            $select=mysqli_query($conexion,"SELECT * FROM usuarios WHERE token='$token'");
            if($r=mysqli_fetch_array($select)){?>
                <div class="col-md-12" align="center"><h3><?php echo "bienvenido ".$r['nombre_usuario'];?></h3></div>
                <div class="col-md-12 form" align="center">
                    <form action="recuperar.php?id_usuario=<?php echo $r['id_usuario'];?>&crear" method="POST" onsubmit="return form(this)" style="width:50%" class="rp">
                         <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Nombre de usuario</label>
                                <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" placeholder="nombre de usuario">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Contraseña nueva</label>
                                <input type="password" class="form-control" name="contr" id="contr" placeholder="ingrese su contraseña nueva">
                            </div>
                            <div class="form-group col-md-12">
                               <label for="inputPassword4">Repetir contraseña</label>
                               <input type="password" class="form-control" id="contr2" placeholder="Repetir contraseña">
                            </div>
                         </div>
                         <button  class="btn btn-dark" style="width: 100%;" onclick="form()"><i class="fas fa-save"></i> Crear cuenta</button>
                  </form>
                </div>
      <?php  } 
        }
        ?>
      </div>
   </div>
   <?php if(isset($_GET['id_usuario']) && isset($_GET['crear'])){
             $id=$_GET['id_usuario'];
             $nombre_usuario=$_POST['nombre_usuario'];
             $password=sha1($_POST['contr']);
             $actualizar=mysqli_query($conexion,"UPDATE usuarios SET nombre_usuario='$nombre_usuario',contr='$password',token=null WHERE id_usuario='$id'"); 
             header("location:login.php?estado=2");
         }
         if(isset($_GET['id_usuario']) && isset($_GET['cambiar'])){
            $id=$_GET['id_usuario'];
            $password=sha1($_POST['contr']);
            $actualizar=mysqli_query($conexion,"UPDATE usuarios SET contr='$password',token=null WHERE id_usuario='$id'"); 
            header("location:login.php?estado=1");
         }?>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/2be8605e79.js"></script>
   <script>
       function form(v){
        ok=true;
                msg="falta llenar campos: \n";
                if (v.elements["contr"].value=="") {
                   msg+="contraseña nueva\n";
                   ok=false;
                }
                if (v.elements["contr2"].value=="") {
                   msg+="Repetir contraseña\n";
                   ok=false;
                }
                if(v.elements['contr'].value != v.elements['contr2'].value){
                    msg="las contraseñas no coinciden";
                    ok=false;
                }
                if (ok==false) {
                      alert(msg);
                      return ok;
                }
       }
   </script>
 </body>
</html>
