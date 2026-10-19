<?php
require 'include/encabezado.php';
require 'Clases/acronimo.php';
?>

<section class="contenedor-app">
    <h2>1. Generador de Acrónimos</h2>

    <p>
        Ingresa una frase para convertirla en su acrónimo.
        Los espacios y guiones separan las palabras.
    </p>

    <form method="POST" action="">
        <label for="frase">Frase original:</label>
        <input type="text" id="frase" name="frase" required>
        <button type="submit">Generar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['frase']) && $_POST["frase"] != "") {
            $fraseIngresada = $_POST["frase"];

            $appAcronimo = new Acronimo($fraseIngresada);
            $resultado = $appAcronimo->generar();

            echo '<div class="resultado">';
            echo '<p>Frase original: ' . htmlspecialchars($fraseIngresada) . '</p>';
            echo '<p>Acrónimo: ' . htmlspecialchars($resultado) . '</p>';
            echo '</div>';
        } else {
            echo '<div class="resultado mensaje-error">';
            echo '<p>Ingresa una frase válida.</p>';
            echo '</div>';
        }
    }
    ?>
</section>