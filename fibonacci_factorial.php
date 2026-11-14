<?php
require 'include/encabezado.php';
require 'Clases/fibonacci_factorial.php';

$mensaje = "";
$numeroTexto = "";
$operacion = "";
$terminos = [];
$factorial = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroTexto = $_POST["numero"] ?? "";
    $operacion = $_POST["operacion"] ?? "";

    $numero = filter_var($numeroTexto, FILTER_VALIDATE_INT);

    if ($numero === false || $numero < 0) {
        $mensaje = "Ingresa un número entero igual o mayor que cero.";
    } elseif ($operacion != "fibonacci" && $operacion != "factorial") {
        $mensaje = "Selecciona una operación válida.";
    } elseif ($operacion == "fibonacci" && $numero == 0) {
        $mensaje = "La sucesión debe tener al menos un término.";
    } else {
        $secuencia = new Secuencia($numero);

        if ($operacion == "fibonacci") {
            $terminos = $secuencia->generarFibonacci();
        } else {
            $factorial = $secuencia->calcularFactorial();
        }
    }
}
?>

<section class="app-panel">
    <h2>2. Fibonacci o Factorial</h2>

    <form method="POST" action="">
        <label for="numero">Número entero:</label>
        <input
            type="number"
            id="numero"
            name="numero"
            min="0"
            step="1"
            required>

        <p>
            Para Fibonacci, indica cuántos términos quieres obtener.
            Para factorial, indica el número que deseas calcular.
        </p>

        <div class="operaciones-grupo">
            <button type="submit" name="operacion" value="fibonacci">
                Generar Fibonacci
            </button>

            <button type="submit" name="operacion" value="factorial">
                Obtener factorial
            </button>
        </div>
    </form>

    <?php if ($mensaje != "") { ?>
        <div class="resultado mensaje-error">
            <p><?php echo $mensaje; ?></p>
        </div>

    <?php } elseif ($operacion == "fibonacci" && count($terminos) > 0) { ?>
        <div class="resultado">
            <h3>Sucesión de Fibonacci</h3>
            <p>
                <?php
                foreach ($terminos as $posicion => $termino) {
                    if ($posicion > 0) {
                        echo ", ";
                    }

                    echo $termino;
                }
                ?>
            </p>
            <p>Cantidad de términos: <?php echo count($terminos); ?></p>
        </div>

    <?php } elseif ($factorial !== null) { ?>
        <div class="resultado">
            <h3>Resultado del factorial</h3>
            <p>
                <?php echo $numero . "! = " . $factorial; ?>
            </p>
        </div>
    <?php } ?>
</section>