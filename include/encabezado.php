<?php
$aplicaciones = [
    ["archivo" => "acronimo.php", "nombre" => "1. Acrónimo"],
    ["archivo" => "fibonacci_factorial.php", "nombre" => "2. Fibonacci o Factorial"],
    ["archivo" => "estadistica.php", "nombre" => "3. Estadística"],
    ["archivo" => "conjuntos.php", "nombre" => "4. Conjuntos A y B"],
    ["archivo" => "binario.php", "nombre" => "5. Entero a Binario"],
    ["archivo" => "arbol_binario.php", "nombre" => "6. Árbol Binario"],
    ["archivo" => "calculadora.php", "nombre" => "7. Calculadora"]
];
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller PHP - Programación Avanzada</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <header>
        <h1>Taller de Programación Avanzada - Aplicaciones</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <?php
            foreach ($aplicaciones as $app) {
                echo '<a href="' . $app['archivo'] . '">' . $app['nombre'] . '</a>';
            }
            ?>
        </nav>
    </header>
    <main>