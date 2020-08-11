<!DOCTYPE html>
<html>
   <head>
      <title>Inicio</title>
   </head>
   <style>
       .permisos{
           background:#121212;
           padding:20px;
           width:70%;
       }
       .col-md-4{
        background:#fafafa;
        border: 1px solid #ffb74d;
        margin:55px;
        border-radius:10px;
       }
       .col-md-4 input{
           float:left;
       }
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
         margin-left: 10px;
         float:left;
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
   </style>
   <body>
   <?php require("header.php");?>
   <div class="container">
      <div class="row">
        <?php if(isset($_POST['permiso']) && !empty($_POST['permiso'])){?>
          <div  class="col-md-12" style="padding-top:60px;" align="center">
             <form action="permisos.php" method="post" class="permisos">
               <div class="row">
                <div class="col-md-12">
                  <label style="color:white">Crear grupo</label>
                  <input type="text" name="nombre_grupo">
                </div><br><br>
                <div class="col-md-4">
                  <p>Gestion peliculas</p>
                  <label class="checkbox">
                    Alta
                  <input type="checkbox" name="nombre_permiso[]" value="alta pelicula">
                  <span class="check"></span>
                  </label>
                  <label class="checkbox">
                    Baja
                  <input type="checkbox" name="nombre_permiso[]" value="baja pelicula">
                  <span class="check"></span>
                  </label>
                  <label class="checkbox">
                    Modificar
                  <input type="checkbox" name="nombre_permiso[]" value="modificar pelicula">
                  <span class="check"></span>
                  </label>
                  <label class="checkbox">
                    solicitudes
                  <input type="checkbox" name="nombre_permiso[]" value="solicitudes">
                  <span class="check"></span>
                  </label>
                </div>
                <div class="col-md-4">
                  <p>Gestion usuarios</p>
                  <label class="checkbox">
                    Alta
                  <input type="checkbox" name="nombre_permiso[]" value="alta usuario">
                  <span class="check"></span>
                  </label>
                  <label class="checkbox">
                    Baja
                  <input type="checkbox" name="nombre_permiso[]" value="baja usuario">
                  <span class="check"></span>
                  </label>
                  <label class="checkbox">
                    Modificar
                  <input type="checkbox" name="nombre_permiso[]" value="modificar usuario">
                  <span class="check"></span>
                  </label>
                  <label class="checkbox">
                    buscar usuarios
                  <input type="checkbox" name="nombre_permiso[]" value="buscar usuarios">
                  <span class="check"></span>
                  </label>
                </div>
                
                <div class="col-md-12" align="center">
                    <button style="width:40%" type="submit" class="btn btn-light"  name="acept" value="acept">Asignar</button>
                </div>
               </div>
             </form>
          </div>
        <?php }?>
          </div>
      </div>
   </body>
</html>