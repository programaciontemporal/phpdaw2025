<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $operacion = $_POST["operacion"];
        $resultado = 0;

        switch ($operacion) {
            case "suma":
                $resultado = $num1 + $num2;
                break;
            case "resta":
                $resultado = $num1 - $num2;
                break;
            case "multiplicacion":
                $resultado = $num1 * $num2;
                break;
            case "division":
                if ($num2 != 0) {
                    $resultado = $num1 / $num2;
                } else {
                    echo "Error: No se puede dividir por cero.";
                    exit();
                }
                break;
            default:
                echo "Operación no válida.";
                exit();
        }

        echo "<h2>Resultado</h2>";
        echo "El resultado de la operación es: " . $resultado;
    } else {
        echo "Error en el formulario.";
    }
?>
