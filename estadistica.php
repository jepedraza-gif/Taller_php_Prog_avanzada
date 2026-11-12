<?php
require 'include/encabezado.php';
require 'Clases/estadistica.php';
?>

<section class="content">
    <h2>3. Estadística</h2>
    <p>Ingresa números reales para calcular su promedio, mediana y moda.</p>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["numeros"])) {
        $numerosIngresados = array_map('trim', explode(',', $_POST["numeros"]));
        $numerosIngresados = array_filter($numerosIngresados, fn($v) => $v !== '');
        $cantidadNumeros = count($numerosIngresados);
        $datosValidos = true;

        if ($cantidadNumeros < 1 || $cantidadNumeros > 50) {
            $datosValidos = false;
        }

        for ($i = 0; $i < $cantidadNumeros; $i++) {
            if (
                empty($numerosIngresados[$i]) ||
                !is_numeric($numerosIngresados[$i])
            ) {
                $datosValidos = false;
            }
        }

        if (!$datosValidos) {
            echo '<div class="resultado mensaje-error">';
            echo '<p>Ingresa entre 1 y 50 números válidos.</p>';
            echo '</div>';
        } else {
            $appEstadistica = new Estadistica($numerosIngresados);

            echo '<div class="resultado">';

            $cadenaNumeros = "";

            for ($i = 0; $i < $cantidadNumeros; $i++) {
                $cadenaNumeros .= htmlspecialchars((string)$numerosIngresados[$i]);

                if ($i < $cantidadNumeros - 1) {
                    $cadenaNumeros .= ', ';
                }
            }

            echo '<p>Números ingresados: ' . $cadenaNumeros . '</p>';
            echo '<p>Promedio: ' . $appEstadistica->calcularPromedio() . '</p>';
            echo '<p>Mediana: ' . $appEstadistica->calcularMediana() . '</p>';
            echo '<p>Moda: ' . htmlspecialchars($appEstadistica->calcularModa()) . '</p>';

            echo '</div>';

            echo '<p><a class="boton" href="estadistica.php">';
            echo 'Calcular otros números</a></p>';
        }
    } else {
        ?>
        <form method="POST" action="">
            <label for="numeros">Números (separados por coma):</label>
            <input
                type="text"
                id="numeros"
                name="numeros"
                placeholder="ej: 5, 8, 3, 10, 2"
                required>

            <button type="submit">Calcular</button>
        </form>
    <?php
    }
    ?>
</section>
