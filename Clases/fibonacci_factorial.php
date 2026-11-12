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
        if ($this->numero < 1) {
            return "Debes ingresar al menos un término.";
        }

        $anterior = 0;
        $actual = 1;
        $resultado = "";

        for ($i = 0; $i < $this->numero; $i++) {
            $resultado .= $anterior;

            if ($i < $this->numero - 1) {
                $resultado .= ", ";
            }

            $siguiente = $anterior + $actual;
            $anterior = $actual;
            $actual = $siguiente;
        }

        return $resultado;
    }

    public function calcularFactorial()
    {
        if ($this->numero < 0) {
            return "El factorial requiere un entero no negativo.";
        }

        $resultado = 1;

        for ($i = 1; $i <= $this->numero; $i++) {
            $resultado = $resultado * $i;
        }

        return $resultado;
    }
}
