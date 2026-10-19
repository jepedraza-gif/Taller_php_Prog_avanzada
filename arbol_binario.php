<?php
require 'include/encabezado.php';
require 'Clases/arbol_binario.php';
?>

<link rel="stylesheet" href="css/arbol.css">

<section class="contenedor-app">
    <h2>6. Constructor de Árbol Binario</h2>
    <p>Ingresa al menos dos recorridos separados por espacios (Ej: A B D E C). Si ingresas los tres, se calculará por defecto con Preorden e Inorden.</p>

    <form method="POST" action="">
        <label for="pre">Preorden:</label>
        <input type="text" id="pre" name="pre">

        <label for="in">Inorden:</label>
        <input type="text" id="in" name="in">

        <label for="post">Postorden:</label>
        <input type="text" id="post" name="post">

        <button type="submit">Construir Árbol</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pre = $_POST["pre"];
        $in = $_POST["in"];
        $post = $_POST["post"];

        $camposLlenos = 0;
        if (!empty($pre)) $camposLlenos++;
        if (!empty($in)) $camposLlenos++;
        if (!empty($post)) $camposLlenos++;

        if ($camposLlenos < 2) {
            echo '<div class="resultado mensaje-error">';
            echo '<p>Error: Debes ingresar como mínimo dos recorridos.</p>';
            echo '</div>';
        } else {
            $arbol = new ArbolBinario($pre, $in, $post);

            echo '<div class="resultado">';

            if (!empty($pre) && !empty($post) && empty($in)) {
                echo '<p>Nota: Al usar solo Preorden y Postorden existe ambigüedad matemática en nodos con un solo hijo. Por convención, se asignarán a la izquierda.</p>';
            }

            echo '<p>Estructura del árbol reconstruido:</p>';

            if ($arbol->raiz == null) {
                echo '<p>Error de reconstrucción: Verifica que los recorridos coincidan entre sí.</p>';
            } else {
                $nodos = $arbol->obtenerNodos();
                $nivelMaximo = $arbol->obtenerNivelMaximo();
                $total = count($nodos);

                $maxLetras = 1;
                for ($i = 0; $i < $total; $i++) {
                    $largo = strlen((string)$nodos[$i]["valor"]);
                    if ($largo > $maxLetras) {
                        $maxLetras = $largo;
                    }
                }

                $radio = 20;
                if ($maxLetras > 2) {
                    $radio = 20 + ($maxLetras - 2) * 5;
                }

                $separacionX = $radio * 2 + 24;
                $separacionY = $radio * 2 + 40;
                $margen = $radio + 20;

                $ancho = ($total - 1) * $separacionX + $margen * 2;
                $alto = $nivelMaximo * $separacionY + $margen * 2;

                for ($i = 0; $i < $total; $i++) {
                    $nodos[$i]["x"] = $margen + $nodos[$i]["columna"] * $separacionX;
                    $nodos[$i]["y"] = $margen + $nodos[$i]["nivel"] * $separacionY;
                }

                echo '<div class="arbol">';
                echo '<svg class="arbol-svg" xmlns="http://www.w3.org/2000/svg" ';
                echo 'viewBox="0 0 ' . $ancho . ' ' . $alto . '" width="' . $ancho . '">';

                for ($i = 0; $i < $total; $i++) {
                    $indicePadre = $nodos[$i]["padre"];

                    if ($indicePadre != -1) {
                        $clase = "arbol-linea-izq";
                        if ($nodos[$i]["lado"] == "der") {
                            $clase = "arbol-linea-der";
                        }

                        echo '<line class="' . $clase . '" ';
                        echo 'x1="' . $nodos[$indicePadre]["x"] . '" ';
                        echo 'y1="' . $nodos[$indicePadre]["y"] . '" ';
                        echo 'x2="' . $nodos[$i]["x"] . '" ';
                        echo 'y2="' . $nodos[$i]["y"] . '" />';
                    }
                }

                for ($i = 0; $i < $total; $i++) {
                    $clase = "arbol-nodo";
                    if ($nodos[$i]["padre"] == -1) {
                        $clase = "arbol-nodo arbol-raiz";
                    }

                    $valorSeguro = htmlspecialchars((string)$nodos[$i]["valor"]);

                    echo '<circle class="' . $clase . '" ';
                    echo 'cx="' . $nodos[$i]["x"] . '" ';
                    echo 'cy="' . $nodos[$i]["y"] . '" ';
                    echo 'r="' . $radio . '" />';

                    echo '<text class="arbol-texto" ';
                    echo 'x="' . $nodos[$i]["x"] . '" ';
                    echo 'y="' . $nodos[$i]["y"] . '" dy=".35em">';
                    echo $valorSeguro . '</text>';
                }

                echo '</svg>';
                echo '</div>';
                echo '<p class="arbol-leyenda">Azul: hijo izquierdo · Verde: hijo derecho</p>';
            }

            echo '</div>';
        }
    }
    ?>
</section>