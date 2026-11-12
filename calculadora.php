<?php
session_start();
require 'Clases/calculadora.php';

if (empty($_SESSION["historial"])) {
    $_SESSION["historial"] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (
        !empty($_POST["num1"]) || $_POST["num1"] == "0"
    ) {
        if (
            !empty($_POST["num2"]) || $_POST["num2"] == "0"
        ) {
            if (!empty($_POST["operacion"])) {

                $n1 = $_POST["num1"];
                $n2 = $_POST["num2"];
                $op = $_POST["operacion"];

                if (
                    $op == "suma" ||
                    $op == "resta" ||
                    $op == "multiplicacion" ||
                    $op == "division" ||
                    $op == "porcentaje"
                ) {
                    $appCalculadora = new Calculadora($n1, $n2, $op);
                    $textoResultado = $appCalculadora->calcular();

                    $_SESSION["ultimo_resultado"] = $textoResultado;
                    $_SESSION["historial"][] = $textoResultado;
                } else {
                    $_SESSION["ultimo_resultado"] = "Selecciona una operación válida.";
                }
            } else {
                $_SESSION["ultimo_resultado"] = "Selecciona una operación.";
            }
        } else {
            $_SESSION["ultimo_resultado"] = "Ingresa el segundo número.";
        }
    } else {
        $_SESSION["ultimo_resultado"] = "Ingresa el primer número.";
    }

    header("Location: calculadora.php");
    exit;
}

require 'include/encabezado.php';

?>

<section class="contenedor-app">
    <h2>7. Calculadora</h2>
    <p>Realiza operaciones matemáticas y consulta el historial.</p>

    <form method="POST" action="calculadora.php">
        <label for="num1">Primer número:</label>
        <input type="number" step="any" id="num1" name="num1" required>

        <label for="operacion">Operación:</label>
        <select id="operacion" name="operacion" required>
            <option value="">Selecciona una operación</option>
            <option value="suma">Suma (+)</option>
            <option value="resta">Resta (-)</option>
            <option value="multiplicacion">Multiplicación (x)</option>
            <option value="division">División (/)</option>
            <option value="porcentaje">Porcentaje (% de)</option>
        </select>

        <label for="num2">Segundo número:</label>
        <input type="number" step="any" id="num2" name="num2" required>

        <button type="submit">Calcular</button>
    </form>

    <?php
    if (!empty($_SESSION["ultimo_resultado"])) {
        echo '<div class="resultado">';
        echo '<p>Resultado: ' . htmlspecialchars($_SESSION["ultimo_resultado"]) . '</p>';
        echo '</div>';

        unset($_SESSION["ultimo_resultado"]);
    }
    ?>

    <section class="historial">
        <h3>Historial de operaciones</h3>

        <?php
        $cantidadHistorial = count($_SESSION["historial"]);

        if ($cantidadHistorial == 0) {
            echo '<p>No hay operaciones registradas.</p>';
        } else {
            echo '<ul>';

            for ($i = 0; $i < $cantidadHistorial; $i++) {
                echo '<li>';
                echo htmlspecialchars($_SESSION["historial"][$i]);
                echo '</li>';
            }

            echo '</ul>';
        }
        ?>

        <p>
            <a class="boton" href="operaciones/borrar_historial.php">
                Borrar historial
            </a>
        </p>
    </section>
</section>