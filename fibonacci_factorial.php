<?php
require 'include/encabezado.php';
require 'Clases/fibonacci_factorial.php';
?>

<section class="app-panel">
    <h2>2. Fibonacci o Factorial</h2>

    <form method="POST" action="">
        <label for="numero">Número entero:</label>
        <input
            type="number"
            id="numero"
            name="numero"
            min="0"
            step="1"
            required>

        <label>Operación:</label>
        <div class="operaciones-grupo">
            <button type="submit" name="operacion" value="fibonacci">Fibonacci</button>
            <button type="submit" name="operacion" value="factorial">Factorial</button>
        </div>

        <button type="submit">Calcular</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (
            (!empty($_POST["numero"]) || $_POST["numero"] == "0") &&
            !empty($_POST["operacion"])
        ) {
            $numeroIngresado = (int)$_POST["numero"];
            $operacion = $_POST["operacion"];

            if (
                $numeroIngresado < 0 ||
                (string)$numeroIngresado != (string)$_POST["numero"]
            ) {
                echo '<div class="resultado mensaje-error">';
                echo 'Ingresa un número entero positivo.';
                echo '</div>';
            } else if (
                $operacion != "fibonacci" &&
                $operacion != "factorial"
            ) {
                echo '<div class="resultado mensaje-error">';
                echo 'Selecciona una operación válida.';
                echo '</div>';
            } else if (
                $operacion == "fibonacci" &&
                $numeroIngresado < 1
            ) {
                echo '<div class="resultado mensaje-error">';
                echo 'Para Fibonacci debes ingresar al menos un término.';
                echo '</div>';
            } else {
                $appSecuencia = new Secuencia($numeroIngresado);

                echo '<div class="resultado">';

                if ($operacion == "fibonacci") {
                    echo '<strong>Sucesión de Fibonacci:</strong><br>';
                    echo $appSecuencia->generarFibonacci();
                } else {
                    echo '<strong>Factorial de ' . $numeroIngresado . ':</strong><br>';
                    echo $appSecuencia->calcularFactorial();
                }

                echo '</div>';
            }
        } else {
            echo '<div class="resultado mensaje-error">';
            echo 'Ingresa un número válido y selecciona una operación.';
            echo '</div>';
        }
    }
    ?>

</section>