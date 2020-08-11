<!DOCTYPE html>
<html>
   <head>
      <title>Solicitar Peliculas</title>
   </head>
   <body>
     <?php require("header.php");?>
     <div class="container">
         <div class="row">
            <div class="col-md-12 alta" align="center">
            <form method="POST" action="solicitud.php" style="width:50%">
  
    <div class="form-group">
      <label for="inputEmail4">Tu Email</label>
      <input type="text" class="form-control" name="mail" id="mail" required placeholder="ingrese su email">
    </div>
    <div class="form-group">
      <label for="inputPassword4">Titulo de la pelicula</label>
      <input type="text" class="form-control" name="titulo" id="titulo" required placeholder="Endgame">
    </div>

  <div class="form-group">
					
                    <label for="selectGenero">Mas info</label>
                    <textarea style="height:100px" type="text" class="form-control" name="info" id="info" placeholder="Año/Actores/Director"></textarea>
            </div>
    <div class="form-group">
      <label for="inputPassword4">Mensaje</label>
      <textarea style="height:100px" type="text" class="form-control" name="mensaje" id="mensaje" required placeholder="ingrese un mensaje"></textarea>
    </div>
  
  <button style="width:100%" type="submit" class="btn btn-dark" name="send" value="send">Cargar</button>
</form>
            </div>
         </div>
     </div>
     <?php 
     if(isset($_GET['estado']) && $_GET['estado']==1){
          echo "<script>alert('mensaje enviado');</script>";
     }
     if(isset($_GET['estado']) && $_GET['estado']==2){
      echo "<script>alert('Hubo problemas con el envio');</script>";
 }
     require("footer.html");?>
     <script>
     function init(){
               $('#solicitudes').attr("class","");
               $('#solicitudes').attr("class","btn btn-danger");
           }
           window.onload = function () {
             init();
           }
     </script>
   </body>
</html>