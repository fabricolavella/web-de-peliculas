
<!DOCTYPE html>
 <html>
   <head>
    <title><?php if (isset($_POST['titulo'])) { echo "Modificar Pelicula";}else{echo "Alta Pelicula";}?></title> 
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


.checkbox:hover input ~ .check {
    border: 2px solid grey;
}


.checkbox input:checked ~ .check {
    background-color: #212121;
    border:none;
}


.check:after {
    content: "";
    position: absolute;
    display: none;
}

.checkbox input:checked ~ .check:after {
    display: block;
}

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
    </style>
   </head>
   <body>
   <?php require ("header.php");
   require ("conexion.php");
   $grupo=mysqli_query($conexion,"SELECT p.nombre_permiso,up.id_permiso FROM permisos AS p, grupos_permisos AS up WHERE p.id_permiso=up.id_permiso AND up.id_grupo='$idgrupo'"); ?>
    <div class="container" style="padding-top:40px;">
		<div class="row">
        
            <div align="center" class="col-md-12 alta">
            <?php 
                 if (isset($_POST['titulo'])) {
                      $titulo=$_POST['titulo'];
                      $consulta="SELECT * FROM movies WHERE titulo='$titulo'";
                      $resultado=mysqli_query($conexion,$consulta);
                      $datos_generos=mysqli_fetch_assoc($resultado);
                      $generos=explode(' ', $datos_generos['genero']);
                      $rta=in_array(' ',$generos);
                  ?>
                       <form method="POST" action="ABM.php" style="width:70%;">
                         <div class="form-row">
                             <div class="form-group col-md-8">
                                <label>Titulo</label>
                                <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $datos_generos['titulo'];?>" required>
                                <input type="text" class="form-control" name="titulo_anterior" id="titulo_anterior" value="<?php echo $datos_generos['titulo'];?>" hidden>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="inputPassword4">Año</label>
                                  <input type="text" class="form-control" value="<?php echo $datos_generos['anio'];?>" name="anio" id="anio">
                              </div>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-8">
                                <label>Duracion</label>
                                <input type="text" class="form-control" name="duracion" id="duracion" value="<?php echo $datos_generos['duracion'];?>" required>
                             </div>
                             <div class="form-group col-md-4">
                                <label for="inputPassword4">Puntaje</label>
                                <input type="text" class="form-control" name="puntaje" id="puntaje" value="<?php echo $datos_generos['puntaje'];?>" required>
                               
                             </div>
                         </div>
                         <div class="form-group">
                            <label>imagen</label>
                            <input type="text" class="form-control" value="<?php echo $datos_generos['imagen'];?>" name="imagen" id="imagen" required>
                         </div>
                         <div class="form-group">
                            <label for="inputEmail4">link de pelicula</label>
                            <input type="text" class="form-control" value="<?php echo $datos_generos['pelicula'];?>" name="pelicula" id="pelicula" required placeholder="ingrese url de la pelicula">
                         </div>
                         <div class="form-group">
                            <label for="inputEmail4">trailer</label>
                            <input type="text" class="form-control" value="<?php echo $datos_generos['trailer'];?>" name="trailer" id="pelicula" required placeholder="ingrese url del trailer">
                         </div>
                         <div class="form-group">
                            <label>Descripcion</label>
                            <textarea type="text" class="form-control" name="descripcion" id="descripcion" rows="3"><?php echo $datos_generos['descripcion'];?></textarea>
                         </div>
                         <p style="color:#fafafa;float:left">Generos</p><br>
                         <div class="form-row"  style="border: 1px solid white;color:#fafafa;padding-top:20px;float:left;width:100%">
                             <div class="form-group">
                                <label class="checkbox">
                                    Fantasia
                                    <input type="checkbox" name="nombre_genero[]" value="Fantasia" <?php if(in_array('Fantasia',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Terror
                                    <input type="checkbox" name="nombre_genero[]" value="Terror" <?php if(in_array('Terror',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Accion
                                   <input type="checkbox" name="nombre_genero[]" value="accion" <?php if(in_array('accion',$generos)){?> checked <?php }?>>
                                   <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Drama
                                    <input type="checkbox" name="nombre_genero[]" value="Drama" <?php if(in_array('Drama',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Comedia
                                    <input type="checkbox" name="nombre_genero[]" value="Comedia" <?php if(in_array('Comedia',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    SCI-FI
                                    <input type="checkbox" name="nombre_genero[]" value="SCI-FI" <?php if(in_array('SCI-FI',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Aventura
                                    <input type="checkbox" name="nombre_genero[]" value="Aventura" <?php if(in_array('Aventura',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Crimen
                                    <input type="checkbox" name="nombre_genero[]" value="Crimen" <?php if(in_array('Crimen',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Romance
                                    <input type="checkbox" name="nombre_genero[]" value="Romance" <?php if(in_array('Romance',$generos)){?> checked <?php }?>>
                                    <span class="check"></span>
                                </label>
                             </div>
                         </div>   
                         <div class="form-group">
                             <button  class="btn btn-dark" style="margin-top: 3%;width: 100%;" value="Modificar" name="Modificar"><i class="fas fa-save"></i> Guardar</button>
                             <button style="margin-top: 3%;width: 100%;" class="btn btn-dark"><a style="text-decoration: none;color: white;" href="javascript:history.go(-1)"><i class="fas fa-ban"></i> Cancelar</a></button>
                         </div>
                       </form>
                      <?php 
                        if (isset($_GET['estado'])&& $_GET['estado']==1) {
	                          echo "<script type='text/javascript'>alert('Datos Modificados');</script>";
                         }
                  }
                 if(isset($_POST['alta']) && !empty($_POST['alta'])){
                    $generos=mysqli_query($conexion,"SELECT * FROM generos;");?>
                    <form method="POST" action="ABM.php" style="width:70%">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                               <label for="inputEmail4">Titulo</label>
                               <input type="text" class="form-control" name="titulo" id="titulo" required placeholder="ingrese nombre de la pelicula">
                            </div>
                            <div class="form-group col-md-4">
                               <label for="inputPassword4">año</label>
                               <input type="text" class="form-control" name="anio" id="anio" required placeholder="ingrese solo numeros enteros" onkeyup="this.value=Numeros(this.value)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                               <label for="inputPassword4">Duracion</label>
                               <input type="text" class="form-control" name="duracion" id="duracion" required placeholder="ingrese duracion en minutos" onkeyup="this.value=Numeros(this.value)">
                            </div>
                            <div class="form-group col-md-4">
                               <label for="inputPassword4">Puntaje</label>
                               <input type="text" class="form-control" name="puntaje" id="puntaje" required placeholder="ingrese solo numeros" onkeypress="return filterFloat(event,this);">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4">imagen</label>
                            <input type="text" class="form-control" name="imagen" id="imagen" required placeholder="ingrese link de la imagen">
                        </div>
                        <div class="form-group">
                           <label for="inputEmail4">link de pelicula</label>
                           <input type="text" class="form-control" name="pelicula" id="pelicula" required placeholder="ingrese url de la pelicula">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4">trailer</label>
                            <input type="text" class="form-control" name="trailer" id="trailer" required placeholder="ingrese url del trailer">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4">Descripcion</label>
                            <textarea type="text" class="form-control" name="descripcion" id="descripcion" required placeholder="ingrese descripcion de la pelicula"></textarea>
                        </div>
                        <p style="color:#fafafa;float:left">Generos</p><br>
                        <div class="form-row"  style="border: 1px solid white;padding-top:20px;color:#fafafa;float:left;width:100%">
                            <div class="form-group generos">
                                <label class="checkbox">
                                    Fantasia
                                    <input type="checkbox" name="nombre_genero[]" value="Fantasia">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Terror
                                    <input type="checkbox" name="nombre_genero[]" value="Terror">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Accion
                                    <input type="checkbox" name="nombre_genero[]" value="accion">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Drama
                                    <input type="checkbox" name="nombre_genero[]" value="Drama">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Comedia
                                    <input type="checkbox" name="nombre_genero[]" value="Comedia">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    SCI-FI
                                    <input type="checkbox" name="nombre_genero[]" value="SCI-FI">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Aventura
                                    <input type="checkbox" name="nombre_genero[]" value="Aventura">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Crimen
                                    <input type="checkbox" name="nombre_genero[]" value="Crimen">
                                    <span class="check"></span>
                                </label>
                                <label class="checkbox">
                                    Romance
                                    <input type="checkbox" name="nombre_genero[]" value="Romance">
                                    <span class="check"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button  class="btn btn-dark" style="margin-top: 3%;width: 100%;" value="guardar" name="guardar"><i class="fas fa-save"></i> Guardar</button>
                            <button style="margin-top: 3%;width: 100%;" class="btn btn-dark"><a style="text-decoration: none;color: white;" href="javascript:history.go(-1)"><i class="fas fa-ban"></i> Cancelar</a></button>
                        </div>
                    </form>
                    <?php
                    if (isset($_GET['estado'])&& $_GET['estado']==1) {
	                      echo "<script type='text/javascript'>alert('Datos Guardados');</script>";
                    }
                    if (isset($_GET['estado'])&& $_GET['estado']==2) {
	                       echo "<script type='text/javascript'>alert('ya existe una pelicula con ese titulo, intente con otro titulo');</script>";
                    }
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