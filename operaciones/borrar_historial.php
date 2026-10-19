<?php
session_start();

unset($_SESSION["historial"]);
unset($_SESSION["ultimo_resultado"]);

header("Location: ../calculadora.php");
exit;
