<?php
$aplicaciones = [
    ["archivo" => "acronimo.php", "nombre" => "1. Acrónimo", "descripcion" => "Convierte una frase en su acrónimo."],
    ["archivo" => "fibonacci_factorial.php", "nombre" => "2. Fibonacci o Factorial", "descripcion" => "Calcula la sucesión de Fibonacci o el factorial."],
    ["archivo" => "estadistica.php", "nombre" => "3. Estadística", "descripcion" => "Calcula promedio, mediana y moda."],
    ["archivo" => "conjuntos.php", "nombre" => "4. Conjuntos A y B", "descripcion" => "Operaciones de unión, intersección y diferencias."],
    ["archivo" => "binario.php", "nombre" => "5. Entero a Binario", "descripcion" => "Convierte un entero al sistema binario."],
    ["archivo" => "arbol_binario.php", "nombre" => "6. Árbol Binario", "descripcion" => "Construye un árbol a partir de sus recorridos."],
    ["archivo" => "calculadora.php", "nombre" => "7. Calculadora", "descripcion" => "Realiza operaciones matemáticas con historial."]
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