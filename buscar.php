
<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
</head>
<body>
   <?php 
      require("header.php");
      require("conexion.php");
      if(isset($_POST['genero']) || isset($_POST['titulo'])){
      $genero=$_POST['genero'];
      $titulo=$_POST['titulo']; 
      $consulta=mysqli_query($conexion,"SELECT * FROM movies");
      if($genero=="todo"){
        $consulta=mysqli_query($conexion,"SELECT * FROM movies WHERE (titulo like '%$titulo%')");
      }else{
        $consulta=mysqli_query($conexion,"SELECT * FROM movies WHERE (titulo like '%$titulo%') AND (genero like '%$genero%')");
      }
    }
   ?>
   <div class="container">
       <div class="row">
     <?php 
     if(mysqli_num_rows($consulta)>0){
         echo "<div class='col-md-12'><h3 style='color:white'>resultados de la busqueda</h3></div>";
         while ($r = mysqli_fetch_array($consulta)) { ?>
            <div align="center" class="col-md-3" style="padding:1%;">
                <div class="card" style="width: 12.5rem;background:#212121;color:white">
                    <a href="playPelicula.php?titulo=<?php echo $r['titulo'];?>"><img src="<?php echo $r['imagen']; ?>" class="card-img-top"></a>
                    <p><?php echo "<i class='fas fa-star'></i>" . $r['puntaje']; ?></p>
                    <div class="card-body" style="height:70px">
                        <p align="center" class="card-text"><?php echo $r['titulo']; ?></p>
                    </div>
                    <br>
                    <?php if (isset($_SESSION['login']) && $_SESSION['login'] > 0) { ?>
                        <a style="botton:0%;position:absolute" class="btn btn-dark card-text" href="peliculas.php?genero=<?php echo $peliculas;?>&pagina=<?php echo $_GET['pagina'];?>&id_pelicula=<?php echo $r['id_pelicula']; ?>&estado=4"><i class="fas fa-bookmark"></i></a>
                        <a class="btn btn-dark card-text" href="peliculas.php?id_pelicula=<?php echo $r['id_pelicula']; ?>&genero=<?php echo $peliculas; ?>&estado=1"><i class="fas fa-bookmark"></i> Añadir a la lista</a>
                    <?php } else { ?>
                        <a style="botton:0%;position:absolute" class="btn btn-dark card-text" href="#" onclick="lista();"><i class="fas fa-bookmark"></i></a>
                        <a class="btn btn-dark card-text" href="#" onclick="lista();"><i class="fas fa-bookmark"></i> Añadir a la lista</a>
                    <?php  } ?>
                    <div>
                        <?php
                        if (isset($_SESSION['login']) && $_SESSION['login'] > 0) {
                          
                            $grupo=mysqli_query($conexion,"SELECT p.nombre_permiso , up.id_permiso FROM permisos AS p, grupos_permisos AS up WHERE p.id_permiso=up.id_permiso AND up.id_grupo='$idgrupo'");
                            while($rs=mysqli_fetch_array($grupo)){
                                $nombrePermiso=$rs['nombre_permiso'];
                                switch($nombrePermiso) {
                                    case "modificar pelicula":
                        ?>
                                        <form method="POST" action="altaMod.php">
                                            <button style="float: left;margin: 5px;border-radius:30px" type="submit" name="titulo" value="<?php echo $r['titulo']; ?>" class="btn btn-dark"><i class="fas fa-pencil-alt"></i></button>
                                        </form>
                              <?php break; 
                                    case "baja pelicula":
                              ?>
                                        <a style="float: left;margin: 5px;border-radius:30px" class="btn btn-dark" href="#" data-toggle="modal" data-target="#info<?php echo $r['id_pelicula']; ?>"><i class="fas fa-trash-alt"></i></a>
                              <?php break;
                               }
                            }
                         }?>
                                    <div style="padding-top:5px;">
                                        <a title="más informacion" style="float: right;margin-right:5px;border-radius:30px" class="btn btn-dark card-text" href="#" data-toggle="modal" data-target="#info<?php echo $r['id_pelicula']; ?>"><i class="fas fa-info-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div data-backdrop="static" class="modal" id="info<?php echo $r['id_pelicula']; ?>">
                            <div align="center" class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="background:#212121;color:white">
                                        <h4 class="modal-title">informacion</h4>
                                        <button style="color:white" type="button" class="close" data-dismiss="modal">X</button>
                                    </div>
                                    <div class="modal-body" style="background:#121212;color:white">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="<?php echo $r['imagen']; ?>" style="width:50%"><br>
                                            </div>
                                            <div class="col-md-6">
                                                <h6><strong>Titulo: </strong><?php echo $r['titulo']; ?></h6>
                                                <h6><strong>Genero: </strong><?php echo $r['genero']; ?></h6>
                                                <h6><strong>Duracion: </strong><?php echo $r['duracion']." min"; ?></h6>
                                                <h6><strong>puntaje: </strong><?php echo "<i class='fas fa-star'></i>".$r['puntaje']; ?></h6>
                                                <h6><strong>Año: </strong><?php echo $r['anio']; ?></h6>
                                                <h6 align="center"><strong>Descripcion </strong></h6>
                                                <h6><?php echo $r['descripcion']; ?></h6>
                                            </div>
                                            <?php if (isset($_SESSION['login']) && $_SESSION['login'] > 0) {
                                                if ($idgrupo == 1) { ?>
                                                    <div class="col-md-6">
                                                        <br>
                                                        <a class="btn btn-dark" href="ABM.php?borrar=<?php echo $r['id_pelicula']; ?>">Eliminar</a>
                                                    </div>
                                            <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }else{
                        echo "<h3 style='color:white'>no se encontro resultados de la busqueda</h3>";
                    }
                    ?>
     </div>
   </div>
   <br><br><br><br><br>
   <?php require("footer.html");?>
 </body>
</html>
