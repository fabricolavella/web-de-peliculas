<!DOCTYPE html>
    <html>

    <head>
        <title>Peliculas</title>
        <style>
            .pagination li a{
                background:white;
                color:black;
            }
            .pagination li a:hover{
                background:#121212;
                color:white;
            }
            .pagination .active a{
                background:#000;
                color:white;
            }
           
        </style>
    </head>
    <body>
        <?php

        if (isset($_GET['genero'])) {
             $peliculas = $_GET['genero'];
             if(!isset($_GET['pagina'])){
               header("location:peliculas.php?genero=$peliculas&pagina=1");
             }
        
         }
         require("header.php");
         $consulta = mysqli_query($conexion, "SELECT * FROM movies where (genero like '%$peliculas%')");
         $peliculas_x_pag = 8;
         $total_peliculas = mysqli_num_rows($consulta);
         $paginas = $total_peliculas / $peliculas_x_pag;
         $paginas = ceil($paginas);
        if (isset($_SESSION['login']) && $_SESSION['login'] > 0) {
            $idUser = $_SESSION['login'];
            $idgrupo=$_SESSION['grupo'];
            $grupo=mysqli_query($conexion,"SELECT p.nombre_permiso,up.id_permiso FROM permisos AS p, grupos_permisos AS up WHERE p.id_permiso=up.id_permiso AND up.id_grupo='$idgrupo'");
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav mr-auto" style="padding-top:10px">
               <?php while($r=mysqli_fetch_array($grupo)){
                    $nombrePermiso=$r['nombre_permiso'];?>
                                <?php if($nombrePermiso=="alta pelicula"){?>
                                 <li class="nav-item">
                                     <form method="POST" action="altaMod.php">
                                        <button  class="btn btn-dark" style="margin-top: 3%;width: 100%;" name="alta" value="alta"><i class="far fa-arrow-alt-circle-up"></i>Alta usuario</button>
                                     </form>
                                 </li>
                                <?php }
                             }?>
                </ul>
              </nav>
                </div>
               <?php if (isset($_GET['pagina'])) {
                    $iniciar = ($_GET['pagina'] - 1) * $peliculas_x_pag;
                    $consulta2 = mysqli_query($conexion, "SELECT * FROM movies WHERE (genero like '%$peliculas%') ORDER BY anio DESC limit $iniciar,$peliculas_x_pag");
                    while ($r = mysqli_fetch_array($consulta2)) { ?>
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
                        <div align="center" data-backdrop="static" class="modal" id="info<?php echo $r['id_pelicula']; ?>">
                            <div class="modal-dialog modal-lg">
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
                                                <h6><strong>puntaje: </strong><?php echo "<i class='fas fa-star'></i>" .$r['puntaje']; ?></h6>
                                                <h6><strong>Año: </strong><?php echo $r['anio']; ?></h6>
                                                <h6 align="center"><strong>Descripcion </strong></h6>
                                                <h6><?php echo $r['descripcion']; ?></h6>
                                            </div>
                                            <?php if (isset($_SESSION['login']) && $_SESSION['login'] > 0) {
                                      
                                      $grupo=mysqli_query($conexion,"SELECT p.nombre_permiso , up.id_permiso FROM permisos AS p, grupos_permisos AS up WHERE p.id_permiso=up.id_permiso AND up.id_grupo='$idgrupo'");
                                      while($rs=mysqli_fetch_array($grupo)){
                                        $nombrePermiso=$rs['nombre_permiso'];
                                        switch($nombrePermiso) {
                                            case "baja pelicula":?>
                                            <div class="col-md-6">
                                                   <form method="POST" action="ABM.php">
                                                        <button style="margin: 5px;" type="submit" name="id_pelicula" value="<?php echo $r['id_pelicula']; ?>" class="btn btn-dark">Eliminar</button>
                                                        <input type="text" name="genero" id="genero" value="<?php echo $peliculas;?>" hidden>
                                                        <input type="text" name="pagina" id="pagina" value="<?php echo $_GET['pagina'];?>" hidden>
                                                    </form>
                                            </div>
                                      <?php }
                                       }
                                      }
                                      ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="container" style="padding-top:40px">
                        <nav arial-label="page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="peliculas.php?genero=<?php echo $peliculas; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
                                <?php for ($i = 1; $i <= $paginas; $i++) : ?>
                                    <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="peliculas.php?genero=<?php echo $peliculas; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php endfor ?>
                                <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="peliculas.php?genero=<?php echo $peliculas; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
                            </ul>
                        </nav>
                    </div>
                    <?php
                    if (isset($_GET['eliminado']) && $_GET['eliminado'] == 1) {
                        echo "<script>alert('la pelicula ha sido eliminada');</script>";
                    }
                    if (isset($_GET['estado']) && $_GET['estado'] == 1) {
                        echo "<script>alert('datos guardados');</script>";
                    }
                    if (isset($_GET['estado']) && $_GET['estado'] == 2) {
                        echo "<script>alert('datos modificados');</script>";
                    }
                    if (isset($_GET['estado']) && $_GET['estado'] == 3) {
                        echo "<script>alert('no se pudo cargar la pelicula con ese titulo porque ya existe');</script>";
                    }
                    if (isset($_GET['id_pelicula']) && (isset($_GET['estado']) && $_GET['estado'] == 4)) {
                        $idPelicula = $_GET['id_pelicula'];
                        $prod = mysqli_query($conexion, "select * from usuarios_movies where id_usuario='$idUser' and id_pelicula='$idPelicula'");
                        if (mysqli_num_rows($prod) > 0) {
                            echo "<script>alert('no puede agregar una pelicula que ya se encuentra en la lista');</script>";
                        } else {
                            $insertar = mysqli_query($conexion, "insert into usuarios_movies(id_usuario,id_pelicula)values('$idUser','$idPelicula')");
                            echo "<script>alert('pelicula agregada');</script>";
                        }
                    }
                }
            
?>
</div>
</div>
<script>
    function lista() {
        alert("debe iniciar sesion para poder agregar peliculas a la lista");
    }
</script>
<?php
require("footer.html")
?>

    </body>
</html>