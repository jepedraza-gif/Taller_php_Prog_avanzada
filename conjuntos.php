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
        !empty($_POST["conjuntoA"]) &&
        !empty($_POST["conjuntoB"])
    ) {
        $arregloA = array_map('trim', explode(',', $_POST["conjuntoA"]));
        $arregloB = array_map('trim', explode(',', $_POST["conjuntoB"]));
        $arregloA = array_filter($arregloA, fn($v) => $v !== '');
        $arregloB = array_filter($arregloB, fn($v) => $v !== '');
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
            <div class="conjuntos-formulario">
                <div class="conjunto-columna">
                    <h3>Conjunto A</h3>
                    <label for="conjuntoA">Elementos de A (separados por coma):</label>
                    <input
                        type="text"
                        id="conjuntoA"
                        name="conjuntoA"
                        placeholder="ej: 1, 2, 3, 4"
                        required>
                </div>

                <div class="conjunto-columna">
                    <h3>Conjunto B</h3>
                    <label for="conjuntoB">Elementos de B (separados por coma):</label>
                    <input
                        type="text"
                        id="conjuntoB"
                        name="conjuntoB"
                        placeholder="ej: 3, 4, 5, 6"
                        required>
                </div>
            </div>

            <button type="submit">Calcular operaciones</button>
        </form>
    <?php
    }
    ?>
</section>
