<?php
    $data = json_decode(file_get_contents("php://input"), TRUE);

    switch($_SERVER["REQUEST_METHOD"]) {
        // SUMA //    
        case "POST": 
            if(isset($data)) {
                $n1 = trim($data["a"]);
                $n2 = trim($data["b"]);
                $r = $n1 + $n2;

                $v = ["ok"=>TRUE, "Suma"=>$r];
                echo json_encode($v);
            }
            else {
                echo json_encode(["ok"=> FALSE, "error"=>"No se encontraron los Datos 'a' y 'b'"]);
            }
            break;

        // RESTA //
        case "PUT": 
            if(isset($data)) {
                $n1 = trim($data["a"]);
                $n2 = trim($data["b"]);
                $r = $n1 - $n2;

                $v = ["ok"=>TRUE, "Resta"=>$r];
                echo json_encode($v);
            }
            else {
                echo json_encode(["ok"=>FALSE, "error"=>"No se encontraron los Datos 'a' y 'b'"]);
            }
            break;

        // MULTIPLICACION //
        case "PATCH": 
            if(isset($data)){
                $n1 = trim($data["a"]);
                $n2 = trim($data["b"]);
                $r = $n1 * $n2;

                $v = ["ok"=>TRUE, "Multiplicacion"=>$r];
                echo json_encode($v);
            }
            else {
                echo json_encode(["ok"=>FALSE, "error"=>"No se encontraron los Datos 'a' y 'b'"]);
            }
            break;

        // DIVISION //
        case "DELETE": 
            if(isset($data)){
                $n1 = trim($data["a"]);
                $n2 = trim($data["b"]);
                
                if($n2 != 0) {
                    $r = $n1 / $n2;

                    $v = ["ok"=>TRUE, "Division"=>$r];
                    echo json_encode($v);
                }
                else {
                    echo json_encode(["ok"=>FALSE, "error"=>"El denominador debe ser diferente de 0"]);
                }
            }
            else {
                echo json_encode(["ok"=>FALSE, "error"=>"No se encontraron los Datos 'a' y 'b'"]);
            }
            break;

        // POTENCIA //
        case "COPY": 
            if(isset($data)){
                $n1 = trim($data["a"]);
                $n2 = trim($data["b"]);
                $r = $n1 ** $n2;

                $vData = ["Exponente"=> $n1, "Base"=> $n2];
                $v = ["ok"=>TRUE, "Potencia"=>$r, "Data"=>$vData];
                echo json_encode($v);
            }
            else {
                echo json_encode(["ok"=>FALSE, "error"=>"No se encontraron los Datos 'a' y 'b'"]);
            }
            break;

        // CAMBIO DE BASE //
        case "OPTIONS":
            if(isset($data)){
                $n1 = trim($data["a"]);
                $rBin = decbin($n1);
                $rOct = decoct($n1);
                $rHex = dechex($n1);

                //$vData = ["Binario"=>$rBin, "Octal"=>$rOct, "Hexadecimal"=>$rHex];
                $v = ["ok"=>TRUE, "Binario"=>$rBin, "Octal"=>$rOct, "Hexadecimal"=>$rHex];
                echo json_encode($v);
            }
            else {
                echo json_encode(["ok"=>FALSE, "error"=>"No se encontraron los Datos 'a' y 'b'"]);
            }
            break;
            
        // INTEGRANTES //
        case "GET": 
            echo json_encode(["INTEGRANTES"]);
            $name = "Cabrera Pablo Daniel";
            $code = "55547";

            $v = ["ok"=>TRUE, "Nombre"=>$name, "Legajo"=>$code];
            echo json_encode($v);
            break;

        default:
            echo json_encode(["NO SE INGRESO NINGUNO DE LOS CASOS VALIDOS (GET, POST, PUT, PATCH, DELETE, COPY, OPTIONS)"]);
            break;
    }
?>