<?php
require 'include/encabezado.php';
require 'Clases/estadistica.php';
?>

<section class="contenedor-app">
    <h2>3. Estadística</h2>
    <p>Ingresa números reales para calcular su promedio, mediana y moda.</p>

    <?php
    if (!isset($_POST["cantidad"]) && !isset($_POST["numeros"])) {
    ?>
        <form method="POST" action="">
            <label for="cantidad">Cantidad de números:</label>
            <input
                type="number"
                id="cantidad"
                name="cantidad"
                min="1"
                max="50"
                step="1"
                required>

            <button type="submit">Continuar</button>
        </form>

        <?php
    } else if (isset($_POST["cantidad"]) && !isset($_POST["numeros"])) {
        $cantidad = (int)$_POST["cantidad"];

        if ($cantidad < 1 || $cantidad > 50) {
            echo '<div class="resultado mensaje-error">';
            echo '<p>Ingresa una cantidad entre 1 y 50.</p>';
            echo '</div>';
        } else {
        ?>
            <form method="POST" action="">
                <input
                    type="hidden"
                    name="cantidad"
                    value="<?php echo $cantidad; ?>">

                <p>Ingresa los <?php echo $cantidad; ?> números:</p>

                <?php
                for ($i = 0; $i < $cantidad; $i++) {
                    echo '<label for="numero' . $i . '">';
                    echo 'Número ' . ($i + 1) . ':';
                    echo '</label>';

                    echo '<input type="number" step="any" ';
                    echo 'id="numero' . $i . '" ';
                    echo 'name="numeros[]" required>';
                }
                ?>

                <button type="submit">Calcular</button>
            </form>
    <?php
        }
    } else if (isset($_POST["numeros"]) && is_array($_POST["numeros"])) {
        $numerosIngresados = $_POST["numeros"];
        $cantidadNumeros = count($numerosIngresados);
        $datosValidos = true;

        if ($cantidadNumeros < 1 || $cantidadNumeros > 50) {
            $datosValidos = false;
        }

        for ($i = 0; $i < $cantidadNumeros; $i++) {
            if (
                $numerosIngresados[$i] === "" ||
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
    }
    ?>
</section>