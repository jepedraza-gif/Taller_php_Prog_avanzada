<?php
class Secuencia
{
    private $numero;

    public function __construct($numeroIngresado)
    {
        $this->numero = (int)$numeroIngresado;
    }

    public function generarFibonacci()
    {
        $terminos = [];

        for ($posicion = 0; $posicion < $this->numero; $posicion++) {
            if ($posicion < 2) {
                $terminos[$posicion] = $posicion;
            } else {
                $terminos[$posicion] =
                    $terminos[$posicion - 1] + $terminos[$posicion - 2];
            }
        }

        return $terminos;
    }

    public function calcularFactorial()
    {
        $producto = 1;
        $factor = $this->numero;

        while ($factor > 1) {
            $producto *= $factor;
            $factor--;
        }

        return $producto;
    }
}