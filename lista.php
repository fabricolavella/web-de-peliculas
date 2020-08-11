<!DOCTYPE html>
<html>

<head>
  <title>Mi lista</title>
  <style>
    .lista img {
      width: 120px;
      height: 180px;
    }

    .lista {
      color: #e0e0e0;
    }
  </style>
</head>

<body>
  <?php
  require("header.php");
  require("conexion.php");
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if (isset($_SESSION['login'])) {
          $idUser = $_SESSION['login'];
          $consulta = mysqli_query($conexion, "SELECT m.id_pelicula, m.titulo,m.puntaje,
                    m.imagen,m.anio,m.duracion,m.genero,m.descripcion,um.id_usuario from movies AS m,usuarios_movies AS um
                   where m.id_pelicula=um.id_pelicula and um.id_usuario='$idUser'");
          while ($r = mysqli_fetch_array($consulta)) { ?>
            <div class="row">
              <div class="col-md-2">
                <div class="lista">
                  <img src="<?php echo $r['imagen']; ?>">
                </div>
              </div>
              <div class="col-md-10">
                <div class="row">
                  <div class="col-md-8 lista">
                    <h4><?php echo $r['titulo']; ?></h4>
                    <h6><?php echo $r['anio'] . " |" . $r['duracion'] . "min |" . $r['genero']; ?></h6>
                    <br>
                    <h6><?php echo $r['descripcion']; ?></h6>
                  </div>
                  <div align="center" class="col-md-4 lista">
                    <br><br><br>
                    <a href="eliminarLista.php?id_pelicula=<?php echo $r['id_pelicula']; ?>" class="btn btn-danger">Quitar de la lista</a>
                  </div>
                </div>
              </div>
            </div>
            <hr style="background:grey;height:1px">
        <?php }
        } ?>
      </div>
    </div>
  </div>
  <?php if (isset($_GET['estado']) && $_GET['estado'] == 1) {
    echo "<script>alert('pelicula eliminada de la lista');</script>";
  } 
  require("footer.html");
  ?>

  <script>
    function init() {
      $('#lista').attr("class", "");
      $('#lista').attr("class", "btn btn-danger");
    }
    window.onload = function() {
      init();
    }
  </script>
</body>

</html>