<?php
require("class.phpmailer.php");
require("class.smtp.php");
require("conexion.php");
$user=$_POST['usuario'];
$mensaje="recupere su clave";
if (isset($_POST['send'])){
 include("sendmail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico
 $consulta=mysqli_query($conexion,"SELECT * FROM usuarios WHERE mail='$user'");
 if($r=mysqli_fetch_array($consulta)){
     echo "enviar email a ".$r['mail'];
     $token=uniqid();
     $sql=mysqli_query($conexion,"UPDATE usuarios set token='$token' WHERE mail='{$r['mail']}'");
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
     $mail->AddAddress($user); // Esta es la dirección a donde enviamos los datos del formulario
     $mail->Subject = "formulario de registro para PELISFC"; // Este es el titulo del email.
     $mensajeHtml = nl2br($mensaje);
     $mail->Body = "<html> 
                        <body> 
                             <h1 align='center'>PELISFC</h1>
                             <div style='background:black;color:white;padding:20px'><h2>Solicitud de restablecimiento de contraseña</h2></div>
                             <p>Alguien ha solicitado una nueva contraseña para la siguiente cuenta en PELISFC</p>
                             <p>usuario: {$r['nombre_usuario']}</p>
                             <p>Si no hiciste esta solicitud simplemente ignora este correo electrónico. Si quiere proceder: </p>
                             <a href='http://localhost/Colavella_Fabricio_Final_EDI/recuperar.php?token=$token'>Haz clic aquí para restablecer tu contraseña</a>
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
          header("location:login.php?recuperar=1");
     } else {
          header("location:login.php?recuperar=2");
           exit();
     }
 }else{
    header("location:login.php?recuperar=3");
 }
}
        
?>