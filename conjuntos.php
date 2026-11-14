<?php
require 'include/encabezado.php';
require 'Clases/conjuntos.php';
?>

<section class="contenedor-app">
    <h2>4. Operaciones con conjuntos</h2>
    <p>Ingresa entre 1 y 20 enteros por conjunto, separados por comas.</p>

    <form method="POST" action="">
        <div class="conjuntos-formulario">
            <div class="conjunto-columna">
                <h3>Conjunto A</h3>
                <label for="conjuntoA">Elementos de A:</label>
                <input
                    type="text"
                    id="conjuntoA"
                    name="conjuntoA"
                    placeholder="Ejemplo: 0, 1, 2, 3"
                    required>
            </div>

            <div class="conjunto-columna">
                <h3>Conjunto B</h3>
                <label for="conjuntoB">Elementos de B:</label>
                <input
                    type="text"
                    id="conjuntoB"
                    name="conjuntoB"
                    placeholder="Ejemplo: -2, 0, 3, 4"
                    required>
            </div>
        </div>

        <button type="submit">Calcular operaciones</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $textoA = "";
        $textoB = "";

        foreach ($_POST as $campo => $valor) {
            if (is_string($valor)) {
                if ($campo == "conjuntoA") {
                    $textoA = trim($valor);
                } elseif ($campo == "conjuntoB") {
                    $textoB = trim($valor);
                }
            }
        }

        $arregloA = [];
        $arregloB = [];
        $datosValidos = true;

        if (
            (empty($textoA) && $textoA !== "0") ||
            (empty($textoB) && $textoB !== "0")
        ) {
            $datosValidos = false;
        } else {
            $textoA .= ",";
            $elemento = "";

            for ($i = 0; $i < strlen($textoA); $i++) {
                if ($textoA[$i] != ",") {
                    $elemento .= $textoA[$i];
                } else {
                    $elemento = trim($elemento);

                    if (
                        (empty($elemento) && $elemento !== "0") ||
                        (string)(int)$elemento !== $elemento
                    ) {
                        $datosValidos = false;
                        break;
                    }

                    $arregloA[] = (int)$elemento;
                    $elemento = "";
                }
            }

            $textoB .= ",";
            $elemento = "";

            for ($i = 0; $i < strlen($textoB); $i++) {
                if ($textoB[$i] != ",") {
                    $elemento .= $textoB[$i];
                } else {
                    $elemento = trim($elemento);

                    if (
                        (empty($elemento) && $elemento !== "0") ||
                        (string)(int)$elemento !== $elemento
                    ) {
                        $datosValidos = false;
                        break;
                    }

                    $arregloB[] = (int)$elemento;
                    $elemento = "";
                }
            }

            if (
                count($arregloA) < 1 || count($arregloA) > 20 ||
                count($arregloB) < 1 || count($arregloB) > 20
            ) {
                $datosValidos = false;
            }
        }

        if (!$datosValidos) {
            echo '<div class="resultado mensaje-error">';
            echo '<p>Ingresa entre 1 y 20 enteros válidos por conjunto, ';
            echo 'sin dejar posiciones vacías entre las comas.</p>';
            echo '</div>';
        } else {
            $appConjuntos = new OperacionesConjuntos($arregloA, $arregloB);

            echo '<div class="resultado">';

            echo '<p>Conjunto A: ';
            echo $appConjuntos->formatearSalida($arregloA);
            echo '</p>';

            echo '<p>Conjunto B: ';
            echo $appConjuntos->formatearSalida($arregloB);
            echo '</p>';

            echo '<p>Unión (A ∪ B): ';
            echo $appConjuntos->formatearSalida($appConjuntos->union());
            echo '</p>';

            echo '<p>Intersección (A ∩ B): ';
            echo $appConjuntos->formatearSalida($appConjuntos->interseccion());
            echo '</p>';

            echo '<p>Diferencia (A - B): ';
            echo $appConjuntos->formatearSalida($appConjuntos->diferenciaAB());
            echo '</p>';

            echo '<p>Diferencia (B - A): ';
            echo $appConjuntos->formatearSalida($appConjuntos->diferenciaBA());
            echo '</p>';

            echo '</div>';
        }
    }
    ?>
</section>