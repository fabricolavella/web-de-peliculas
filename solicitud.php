<?php 
require("class.phpmailer.php");
require("class.smtp.php");
require("conexion.php");
$email=$_POST['mail'];
$titulo=$_POST['titulo'];
$info=$_POST['info'];
$mensaje="solicitud de peliculas";
$msg=$_POST['mensaje'];
if (isset($_POST['send'])){
    include("sendmail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico
        $smtpHost = "smtp.gmail.com";  // Dominio alternativo brindado en el email de alta 
        $smtpUsuario = ("tuspelisfc@gmail.com");  // Mi cuenta de correo
        $smtpClave = "Pelisfc_1997";  // Mi contraseña
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Port = 587; 
        $mail->IsHTML(true); 
        $mail->CharSet = "utf-8";
   
        // VALORES A MODIFICAR //
        $mail->Host = $smtpHost; 
        $mail->Username = $smtpUsuario; 
        $mail->Password = $smtpClave;
        $mail->setFrom = $smtpUsuario;
        $mail->FromName= "tuspelisfc"; // Email desde donde envío el correo.
        $mail->AddAddress($smtpUsuario); // Esta es la dirección a donde enviamos los datos del formulario
        $mail->Subject = "solicitudes de peliculas para PELISFC"; // Este es el titulo del email.
        $mensajeHtml = nl2br($mensaje);
        $mail->Body = "<html> 
                           <body> 
                                <h1 align='center'>PELISFC</h1>
                                <div style='background:black;color:white;padding:20px'><h2>Solicitud de peliculas</h2></div>
                                <p>email: {$email}</p>
                                <p>nombre de la pelicula: {$titulo}</p>
                                <p>informacion de la pelicula: {$info}</p>
                                <p>mensaje: {$msg}</p>
                           </body> 
                       </html>
                       <br />"; // Texto del email en formato HTML
        $mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
        $mail->SMTPOptions = array(
        'ssl' => array(
           'verify_peer' => false,
           'verify_peer_name' => false,
           'allow_self_signed' => true
          )
        );
        $estadoEnvio = $mail->Send(); 
        if($estadoEnvio){
             header("location:solicitudes.php?estado=1");
        } else {
             header("location:solicitudes.php?estado=2");
              exit();
        }
}
?>