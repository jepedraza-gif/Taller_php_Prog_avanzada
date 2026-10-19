<?php
require 'include/encabezado.php';
require 'Clases/conjuntos.php';
?>

<section class="contenedor-app">
    <h2>4. Operaciones con conjuntos</h2>
    <p>Ingresa los elementos de los conjuntos A y B.</p>

    <?php
    if (
        $_SERVER["REQUEST_METHOD"] == "POST" &&
        empty($_POST["conjuntoA"]) &&
        empty($_POST["conjuntoB"]) &&
        (!empty($_POST["cantidadA"]) || $_POST["cantidadA"] == "0")
    ) {
        $cantidadA = (int)$_POST["cantidadA"];
        $cantidadB = (int)$_POST["cantidadB"];

        if (
            $cantidadA < 1 || $cantidadA > 20 ||
            $cantidadB < 1 || $cantidadB > 20
        ) {
            echo '<div class="resultado mensaje-error">';
            echo '<p>Cada conjunto debe tener entre 1 y 20 elementos.</p>';
            echo '</div>';
        } else {
    ?>
            <form method="POST" action="">
                <input type="hidden" name="cantidadA" value="<?php echo $cantidadA; ?>">
                <input type="hidden" name="cantidadB" value="<?php echo $cantidadB; ?>">

                <div class="conjuntos-formulario">
                    <div class="conjunto-columna">
                        <h3>Conjunto A</h3>

                        <?php
                        for ($i = 0; $i < $cantidadA; $i++) {
                            echo '<label for="a' . $i . '">Elemento ' . ($i + 1) . ':</label>';
                            echo '<input type="number" id="a' . $i . '" name="conjuntoA[]" step="1" required>';
                        }
                        ?>
                    </div>

                    <div class="conjunto-columna">
                        <h3>Conjunto B</h3>

                        <?php
                        for ($i = 0; $i < $cantidadB; $i++) {
                            echo '<label for="b' . $i . '">Elemento ' . ($i + 1) . ':</label>';
                            echo '<input type="number" id="b' . $i . '" name="conjuntoB[]" step="1" required>';
                        }
                        ?>
                    </div>
                </div>

                <button type="submit">Calcular operaciones</button>
            </form>
        <?php
        }
    } else if (
        $_SERVER["REQUEST_METHOD"] == "POST" &&
        !empty($_POST["conjuntoA"]) &&
        !empty($_POST["conjuntoB"])
    ) {
        $arregloA = $_POST["conjuntoA"];
        $arregloB = $_POST["conjuntoB"];
        $datosValidos = true;

        if (
            count($arregloA) < 1 || count($arregloA) > 20 ||
            count($arregloB) < 1 || count($arregloB) > 20
        ) {
            $datosValidos = false;
        }

        for ($i = 0; $i < count($arregloA); $i++) {
            if (
                $arregloA[$i] == "" ||
                (string)(int)$arregloA[$i] != (string)$arregloA[$i]
            ) {
                $datosValidos = false;
            }
        }

        for ($i = 0; $i < count($arregloB); $i++) {
            if (
                $arregloB[$i] == "" ||
                (string)(int)$arregloB[$i] != (string)$arregloB[$i]
            ) {
                $datosValidos = false;
            }
        }

        if (!$datosValidos) {
            echo '<div class="resultado mensaje-error">';
            echo '<p>Ingresa entre 1 y 20 enteros válidos por conjunto.</p>';
            echo '</div>';
        } else {
            $appConjuntos = new OperacionesConjuntos($arregloA, $arregloB);

            echo '<div class="resultado">';
            echo '<p>Conjunto A: ' . $appConjuntos->formatearSalida($arregloA) . '</p>';
            echo '<p>Conjunto B: ' . $appConjuntos->formatearSalida($arregloB) . '</p>';
            echo '<p>Unión (A ∪ B): ' . $appConjuntos->formatearSalida($appConjuntos->union()) . '</p>';
            echo '<p>Intersección (A ∩ B): ' . $appConjuntos->formatearSalida($appConjuntos->interseccion()) . '</p>';
            echo '<p>Diferencia (A - B): ' . $appConjuntos->formatearSalida($appConjuntos->diferenciaAB()) . '</p>';
            echo '<p>Diferencia (B - A): ' . $appConjuntos->formatearSalida($appConjuntos->diferenciaBA()) . '</p>';
            echo '</div>';

            echo '<p><a class="boton" href="conjuntos.php">';
            echo 'Calcular otros conjuntos</a></p>';
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo '<div class="resultado mensaje-error">';
        echo '<p>Los datos enviados no son válidos.</p>';
        echo '</div>';
    } else {
        ?>
        <form method="POST" action="">
            <label for="cantidadA">Cantidad de elementos de A:</label>
            <input
                type="number"
                id="cantidadA"
                name="cantidadA"
                min="1"
                max="20"
                step="1"
                required>

            <label for="cantidadB">Cantidad de elementos de B:</label>
            <input
                type="number"
                id="cantidadB"
                name="cantidadB"
                min="1"
                max="20"
                step="1"
                required>

            <button type="submit">Generar campos</button>
        </form>
    <?php
    }
    ?>
</section>