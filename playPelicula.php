
<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
    <style>
      .embed-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
}
.embed-container iframe {
    position: absolute;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;
}
    </style>
</head>
<body>
   <?php 
      require("header.php");
      require("conexion.php");  
      if (isset($_SESSION['login']) && $_SESSION['login'] > 0) {
        $idUser=$_SESSION['login'];
      }
      if (isset($_GET['titulo'])) {
          $titulo=$_GET['titulo'];
          $select=mysqli_query($conexion,"SELECT * FROM movies WHERE titulo='$titulo'");
       }
   ?>
   <div class="container">
       <div class="row">
       <?php while ($r=mysqli_fetch_array($select)) { $puntaje=$r['puntaje'];?>
          <div class="col-md-2">
             <div align="center">
               <img src="<?php echo $r['imagen'];?>" style="width:130px;height:200px"><br>
               <a style="width:130px" class="btn btn-dark" href="#" data-toggle="modal" data-target="#trailer"><i class="fas fa-video"></i> ver trailer</a>
              </div>
          </div>
          <div class="col-md-10" style="color:white">
               <h3><?php echo $r['titulo']."   ";?></h3>
               <p><?php echo $r['titulo'];?></p>
               <?php for ($i = 1; $i <= $puntaje; $i++){ ?>
                <i class='fas fa-star'></i>
               <?php }?>
               | <span><?php echo $r['duracion']," min |"."          ".$r['anio'];?></span>
               <br><br>
               <h5><?php echo $r['descripcion'];?></h5>
           </div>
          <div class="col-md-12" style="padding-top:40px">
          <div class="embed-container">
              <IFRAME SRC="<?php echo $r['pelicula']?>" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH=560 HEIGHT=315 gesture="media"  allow="encrypted-media" allowfullscreen></IFRAME>
          </div>
          </div>
          <br>
          <div  data-backdrop="static"  class="modal" id="trailer">
                       <div class="modal-dialog modal-lg" >
                            <div class="modal-content">
                               <div class="modal-header" style="background:#212121;color:white">
                                   <h4 class="modal-title"><?php echo $r['titulo'];?></h4>
                                   <button style="color:white" type="button" class="close" data-dismiss="modal">X</button>
                               </div>
                               <div class="modal-body" style="background:#121212;color:white">
                                <div class="embed-container">
                                  <iframe width="578" height="300" src="https://www.youtube.com/embed/<?php echo $r['trailer'];?>" 
                                    frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                  </iframe>
                                </div>
                               </div>
                            </div>
                       </div>
                   </div>
          <?php }?>
          <div class="col-md-12">
              <??>
          </div>
     </div>
   </div>
   <?php require("footer.html");?>
 </body>
</html>
