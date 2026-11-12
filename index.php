<?php
require 'include/encabezado.php';
?>

<section class="bienvenida">
    <h2>Taller PHP</h2>
    <p>Selecciona una de las siguientes aplicaciones e interactua con ellas.</p>
</section>

<section class="grid-aplicaciones">
    <?php
    foreach ($aplicaciones as $app) {
        echo '<article class="tarjeta">';
        echo '<h3><a href="' . $app['archivo'] . '">' . $app['nombre'] . '</a></h3>';
        echo '</article>';
    }
    ?>
</section>