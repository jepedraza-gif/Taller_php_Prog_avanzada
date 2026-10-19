<?php
require 'include/encabezado.php';
require 'Clases/binario.php';
?>

<section class="contenedor-app">
    <h2>5. Conversión de entero a binario</h2>
    <p>Ingresa un número entero igual o mayor que cero.</p>

    <form method="POST" action="">
        <label for="numero">Número entero:</label>
        <input
            type="number"
            id="numero"
            name="numero"
            min="0"
            step="1"
            required>

        <button type="submit">Convertir</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["numero"]) || $_POST["numero"] == "0") {

            $numeroIngresado = $_POST["numero"];

            if (
                (int)$numeroIngresado < 0 ||
                (string)(int)$numeroIngresado != (string)$numeroIngresado
            ) {
                echo '<div class="resultado mensaje-error">';
                echo '<p>Ingresa un número entero igual o mayor que cero.</p>';
                echo '</div>';
            } else {
                $appBinario = new ConversorBinario($numeroIngresado);

                echo '<div class="resultado">';
                echo '<p>Número decimal: ' . htmlspecialchars($numeroIngresado) . '</p>';
                echo '<p>Sistema binario: ' . $appBinario->convertir() . '</p>';
                echo '</div>';
            }
        } else {
            echo '<div class="resultado mensaje-error">';
            echo '<p>Ingresa un número válido.</p>';
            echo '</div>';
        }
    }
    ?>
</section>