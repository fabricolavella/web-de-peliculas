
<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
</head>
<body>
   <?php 
      require("header.php");
      

      require("conexion.php");   
   ?>
   <div class="container">
       <div class="row">
        <?php
           $consulta= mysqli_query($conexion,"SELECT * FROM movies WHERE anio=2020");
           if (isset($_SESSION['login'])) {
                $idUser=$_SESSION['login'];
            }?>
            <div class="col-md-8" style="background:#212121">
              <div align="center" id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                     <?php $active="active";
                           while ($r=mysqli_fetch_array($consulta)) {
                     ?>
                   <div class="carousel-item <?php echo $active;?>">
                            <div class="card" style="width: 18.5rem;background:#121212;color:white">
                                <img src="<?php echo $r['imagen'];?>" class="card-img-top">
                                <p><?php echo "<i class='fas fa-star'></i>".$r['puntaje'];?></p>
                                <div class="card-body" style="height:70px">
                                     <p align="center" class="card-text"><?php echo $r['titulo'];?></p>
                                </div>
                                <br>
                                <?php if (isset($_SESSION['login']) && $_SESSION['login']>0) { ?>
                                           <a style="botton:0%;position:absolute" class="btn btn-dark card-text" href="index.php?id_pelicula=<?php echo $r['id_pelicula'];?>&estado=1"><i class="fas fa-bookmark"></i></a>
                                           <a class="btn btn-dark card-text" href="index.php?id_pelicula=<?php echo $r['id_pelicula'];?>&estado=1"><i class="fas fa-bookmark"></i>       Añadir a la lista</a>
                                  <?php }else{ ?>
                                          <a style="botton:0%;position:absolute" class="btn btn-dark card-text" href="#" onclick="lista();"><i class="fas fa-bookmark"></i></a>
                                          <a class="btn btn-dark card-text" href="#" onclick="lista();"><i class="fas fa-bookmark"></i>       Añadir a la lista</a>
                                 <?php  }?>
                                <div>
                                 
                                   <div style="padding-top:25px;">
                                       <a title="más informacion" style="float:right;margin-right:25px;border-radius:30px" class="btn btn-dark card-text" href="#" data-toggle="modal" data-target="#info<?php echo $r['id_pelicula'];?>"><i class="fas fa-info-circle"></i></a>
                                   </div>     
                                </div>
                            </div> 
                   </div>
			        <div  data-backdrop="static"  class="modal" id="info<?php echo $r['id_pelicula'];?>">
                       <div class="modal-dialog modal-lg" >
                            <div class="modal-content">
                               <div class="modal-header" style="background:#212121;color:white">
                                   <h4 class="modal-title">informacion</h4>
                                   <button style="color:white" type="button" class="close" data-dismiss="modal">X</button>
                               </div>
                               <div class="modal-body" style="background:#121212;color:white">
		                               <div class="row">
		                                   <div class="col-md-6">
		                                        <img src="<?php echo $r['imagen'];?>" style="width:50%"><br>
		                                   </div>
		                                  <div class="col-md-6">
		                                        <h6><strong>Titulo: </strong><?php echo $r['titulo'];?></h6>
                                            <h6><strong>Genero: </strong><?php echo $r['genero'];?></h6>
                                            <h6><strong>Duracion: </strong><?php echo $r['duracion']." min";?></h6>
                                            <h6><strong>puntaje: </strong><?php echo "<i class='fas fa-star'></i>".$r['puntaje'];?></h6>
                                            <h6><strong>Año: </strong><?php echo $r['anio'];?></h6>
                                            <h6 align="center"><strong>Descripcion </strong></h6>
                                            <h6><?php echo $r['descripcion'];?></h6>
		                                  </div>
                                      <?php if (isset($_SESSION['login']) && $_SESSION['login']>0) { 
                                               if($nombrePermiso=="baja pelicula"){ ?>
                                                    <div class="col-md-6">
                                                       <br>
                                                       <a class="btn btn-dark" href="ABM.php?borrar=<?php echo $r['id_pelicula']; ?>">Eliminar</a>
                                                    </div>
                                           <?php } 
                                             }?>
                                   </div>
                                </div>
                            </div>
                       </div>
                   </div>
                   <?php 
                          $active="";
                        }
                   ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
      </div>
      <div class="col-md-4" style="color:white">
           <br>
           <h3>Extrenos 2020</h3>
           <?php $consulta= mysqli_query($conexion,"SELECT * FROM movies WHERE anio=2020"); ?>
           <div class="parent">
              <div class="child"> 
                  <?php while ($r=mysqli_fetch_array($consulta)) { ?>
                          <div style="padding:2%;color:grey">
                             <p style="margin-right:20px">
	                               <a href="#" style="text-decoration:none;color:white" data-toggle="modal" data-target="#info<?php echo $r['id_pelicula'];?>"><img src="<?php echo $r['imagen'];?>" style="width:30%" align="left">
                                 <h4><?php echo $r['titulo'];?></h4></a>
                                 <?php echo $r['descripcion'];?>
                             </p>
                             <br clear="all">
                          </div>
                 <?php }?>
              </div>
           </div>
      </div>
      <h2 style="color:white;padding-top:40px">Destacados</h2>
          <div class="scrollmenu">
               <?php
                 $destacados= mysqli_query($conexion,"SELECT * FROM movies WHERE puntaje BETWEEN 7 and 10");
                      while ($r=mysqli_fetch_array($destacados)) {?>
                           <div align="center" style="padding:1%;display:inline-block">
                               <div class="card" style="width: 12.5rem;background:#212121;color:white">
                                      <img src="<?php echo $r['imagen'];?>" class="card-img-top">
                                      <p><?php echo "<i class='fas fa-star'></i>".$r['puntaje'];?></p>
                                      <br>
                                      <?php if (isset($_SESSION['login']) && $_SESSION['login']>0) { ?>
                                                   <a style="botton:0%;position:absolute" class="btn btn-dark card-text" href="index.php?id_pelicula=<?php echo $r['id_pelicula'];?>&estado=1"><i class="fas fa-bookmark"></i></a>
                                                   <a class="btn btn-dark card-text" href="index.php?id_pelicula=<?php echo $r['id_pelicula'];?>&estado=1"><i class="fas fa-bookmark"></i>       Añadir a la lista</a>
                                      <?php }else{ ?>
                                                    <a style="botton:0%;position:absolute" class="btn btn-dark card-text" href="#" onclick="lista();"><i class="fas fa-bookmark"></i></a>
                                                    <a class="btn btn-dark card-text" href="#" onclick="lista();"><i class="fas fa-bookmark"></i>       Añadir a la lista</a>
                                     <?php  }?>
                               </div> 
                           </div>
                           <?php
                       }
                      ?>
          </div>
     </div>
   </div>
   <br><br><br><br><br>
   <?php 
       if (isset($_GET['id_pelicula']) && (isset($_GET['estado']) && $_GET['estado']==1)) {
          $idPelicula=$_GET['id_pelicula'];
          $prod=mysqli_query($conexion,"select * from usuarios_movies where id_usuario='$idUser' and id_pelicula='$idPelicula'");
          if(mysqli_num_rows($prod)>0){ 
               echo "<script>alert('no puede agregar una pelicula que ya se encuentra en la lista');</script>";
          }else{
              $insertar=mysqli_query($conexion,"insert into usuarios_movies(id_usuario,id_pelicula)values('$idUser','$idPelicula')");
              echo "<script>alert('pelicula añadida a la lista');</script>";
          }
       }
       require("footer.html");?>
       <script>
           function lista(){
              alert("debe iniciar sesion para poder agregar peliculas a la lista");
           }
           function init(){
               $('#inicio').attr("class","");
               $('#inicio').attr("class","btn btn-danger");
           }
           window.onload = function () {
             init();
           }
       </script>
 </body>
</html>
