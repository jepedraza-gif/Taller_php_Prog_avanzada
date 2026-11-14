<?php
require 'include/encabezado.php';
require 'Clases/estadistica.php';
?>

<section class="content">
    <h2>3. Estadística</h2>
    <p>Ingresa números reales para calcular su promedio, mediana y moda.</p>

    <form method="POST" action="">
        <label for="numeros">Números separados por coma:</label>
        <input
            type="text"
            id="numeros"
            name="numeros"
            placeholder="Ejemplo: 5, 0, -3, 10.5, 2"
            required>

        <button type="submit">Calcular</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $texto = "";

        // Comprueba que el campo exista antes de leerlo.
        foreach ($_POST as $campo => $valor) {
            if ($campo == "numeros" && is_string($valor)) {
                $texto = trim($valor);
            }
        }

        if (empty($texto) && $texto != "0") {
            echo '<div class="resultado mensaje-error">';
            echo '<p>Ingresa los números que deseas calcular.</p>';
            echo '</div>';
        } else {
            $numerosIngresados = [];
            $numeroActual = "";
            $datosValidos = true;

            $texto .= ",";

            for ($i = 0; $i < strlen($texto); $i++) {
                if ($texto[$i] != ",") {
                    $numeroActual .= $texto[$i];
                } else {
                    $numeroActual = trim($numeroActual);

                    if (
                        (empty($numeroActual) && $numeroActual != "0") ||
                        !is_numeric($numeroActual)
                    ) {
                        $datosValidos = false;
                        break;
                    }

                    $numerosIngresados[] = $numeroActual;
                    $numeroActual = "";
                }
            }

            $cantidadNumeros = count($numerosIngresados);

            if ($cantidadNumeros < 1 || $cantidadNumeros > 50) {
                $datosValidos = false;
            }

            if (!$datosValidos) {
                echo '<div class="resultado mensaje-error">';
                echo '<p>Ingresa entre 1 y 50 números válidos, ';
                echo 'separados por comas y sin dejar posiciones vacías.</p>';
                echo '</div>';
            } else {
                $appEstadistica = new Estadistica($numerosIngresados);

                echo '<div class="resultado">';
                echo '<p>Números ingresados: ';

                for ($i = 0; $i < $cantidadNumeros; $i++) {
                    if ($i > 0) {
                        echo ', ';
                    }

                    echo htmlspecialchars($numerosIngresados[$i]);
                }

                echo '</p>';

                echo '<p>Promedio: ';
                echo $appEstadistica->calcularPromedio();
                echo '</p>';

                echo '<p>Mediana: ';
                echo $appEstadistica->calcularMediana();
                echo '</p>';

                echo '<p>Moda: ';
                echo htmlspecialchars($appEstadistica->calcularModa());
                echo '</p>';

                echo '</div>';
            }
        }
    }
    ?>
</section>