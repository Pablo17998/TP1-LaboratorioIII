<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Correo.php</title>
    </head>

    <body>
        <?php
            require "vendor/autoload.php";

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;

            $mail = new PHPMailer(true); // Instacion PHPMailer para poder acceder a sus funciones

            /*print_r($_POST);
            die();*/

            if(isset($_POST)) {
                $nombre = trim($_POST["nombre"]);
                $apellido = trim($_POST["apellido"]);
                $email = trim($_POST["email"]);
                $clave = trim($_POST["clave"]);
            }
            else {
                print_r("Error al obtener los datos");
            }

            ////////////////////////////////////////
            // Conexion con MySQL
            $db = new mysqli("localhost", "root", "", "tp1p2");

            if($db->connect_error) {
                die("Conexion Fallida: ". $db->connect_error);
            }
            else {
                echo "Conexion Exitosa";
            }

            ////////////////////////////////////////
            // CRUD
            function Insert($db, $nombre, $apellido, $email, $clave) {
                $query = "insert into registrocorreo(nombre, apellido, email, clave) values('".$nombre."', '".$apellido."', '".$email."', '".$clave."')";
                $sendData = $db->prepare($query);

                // Verificacion de envio de datos
                if($sendData === FALSE) {
                    echo "ERROR AL ENVIAR LOS DATOS";
                    $sendData->close();
                }
                else {
                    
                    $sendData->execute(); // Ejecucion de la base de datos
                    echo "DATOS ENVIADOS";
                    $sendData->close();
                }
            }

            ////////////////////////////////////////
            // Solicitudes HTTP
            switch($_SERVER["REQUEST_METHOD"]) {
                case "POST":
                    if(isset($_POST)) {
                        if(Insert($db, $nombre, $apellido, $email, $clave)) {
                            http_response_code(200);
                            $db->close();
                        }
                        else {
                            http_response_code(400);
                            $db->close();
                        }
                    }
                    break;
                default: 
                    http_response_code(500);
                    break;
            }

            ////////////////////////////////////////
            // PHPMailer
            try {
                // Configuraciones del Servidor
                $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Permite visualizar errores (Escriibiendo '0' luegod el igual, desactivamos esta opcion)
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "agaewq98@gmail.com";
                $mail->Password = "";
                $mail->SMTPSecure = "ssl";
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  //Verifica que el dominio (host) tenga el "candadito verde" es decir, el protocolo 'ssl'
                $mail->Port = 465;

                // Configuración de Correos de origen y destino
                if(isset($_POST)) {
                    $correo = $_POST["email"];

                    $mail->setFrom("agaewq98@gmail.com", "<No Responder>"); //Correo de origen (send)
                    $mail->addAddress($correo, ""); //Correo de destino (get)
                }
                else {
                    echo "Error al obtener el correo";
                } 
                
                // Contenido del Correo
                $contenido = "<h3>Hola Mundo</h3>";  //Es opcional guardar el mensaje del body en una variable

                $mail->isHTML(true); //Establece el formato del email en HTML
                $mail->Subject = "PRUEBA TP1-PUNTO2 LABORATORIO III"; // ASUNTO
                $mail->Body = $contenido; //Contenido del correo
                //$mail->AltBody = ""; //Body alternativo para clientes que no soportan HTML (opcional utilizarlo)
                $mail->send();
                echo "Mensaje Enviado a ". $email;
            } catch(Exception $e) {    
                echo "No pudo enviarse el mensaje: {$mail->ErrorInfo}";
            }
        ?>
    </body>
</html>

