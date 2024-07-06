<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Potencia</title>
    </head>

    <body>
        <div class="box">
            <div class="operaciones">
                <a class="resta" href="resta.php">Resta</a>
                <a class="suma" href="suma.php">Suma</a>
                <a class="multiplicacion" href="multiplicacion.php">Multiplicacion</a>
                <a class="division" href="division.php">Division</a>
                <a class="potencia" href="potencia.php">Potencia</a>
                <a class="integrantes" href="integrantes.php">Integrantes</a>
            </div>

            <h2>
                <u>Base de Un Numero</u>
            </h2>

            <!--El metodo del formulario siempre debe ser POST porque este tiene que enviar los datos-->
            <form method="POST">
                <label class="lbl1">
                    <u>1er Numero</u>
                </label>
                <input class="ip1" type="text" name="num1" required><br><br>

                <button type="submit" style="width: 100px; height: 50px; font-size: 20px">
                    <strong>Calcular</strong>
                </button>
            </form>
        </div>

        <?php
            if(isset($_POST["num1"])) {
                $n1 = $_POST["num1"];
                $fields = ["a"=> $n1];
                $fields_json = json_encode($fields);
        
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://localhost/tp1/punto-uno/calculadora.php");
                curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "OPTIONS");
                curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_json);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $data = curl_exec($ch);
                curl_close($ch);
                        
                $datos = json_decode($data);
        
                echo "<br><h2><u>El Resultado es Binario</u>: [". $datos->Binario ."], <u>Octal</u>: [". $datos->Octal . "], <u>Hexadecimal</u>: [". $datos->Hexadecimal ."]</h2>";
            }     
        ?>
    </body>
</html>