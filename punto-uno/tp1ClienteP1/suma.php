<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Suma</title>
    </head>
    
    <body>
        <div class="box">
            <div class="operaciones">
                <a class="resta" href="resta.php">Resta</a>
                <a class="multiplicacion" href="multiplicacion.php">Multiplicacion</a>
                <a class="division" href="division.php">Division</a>
                <a class="potencia" href="potencia.php">Potencia</a>
                <a class="base" href="base.php">Base</a>
                <a class="integrantes" href="integrantes.php">Integrantes</a>
            </div>

            <h2>
                <u>Suma de Dos Numeros</u>
            </h2>

            <!--El metodo del formulario siempre debe ser POST porque este tiene que enviar los datos-->
            <form method="POST">
                <label class="lbl1">
                    <u>1er Numero</u>
                </label>
                <input class="ip1" type="text" name="num1" required><br><br>

                <label class="lbl2">
                    <u>2do Numero</u>
                </label>
                <input class="ip2" type="text" name="num2" required><br><br>

                <button type="submit" style="width: 100px; height: 50px; font-size: 20px">
                    <strong>Calcular</strong>
                </button>
            </form>
        </div>

        <?php
            if(isset($_POST["num1"])) {
                $n1 = $_POST["num1"];
                $n2 = $_POST["num2"];
                $fields = ["a"=> $n1, "b"=> $n2];
                $fields_json = json_encode($fields);
        
                /*print_r($fields_json);
                die();*/
        
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://localhost/tp1/punto-uno/calculadora.php");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_json);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $data = curl_exec($ch);
                curl_close($ch);
                        
                $datos = json_decode($data);
        
                /*print_r($data);
                die();*/
                        
                echo "<br><h2><u>El Resultado de la Suma es</u>: ". $datos->Suma ."</h2>";
            }     
        ?>
    </body>
</html>



