<?php
class OperacionesConjuntos
{
    private $conjuntoA;
    private $conjuntoB;

    public function __construct($arregloA, $arregloB)
    {
        $this->conjuntoA = $this->quitarDuplicados($arregloA);
        $this->conjuntoB = $this->quitarDuplicados($arregloB);
    }

    private function quitarDuplicados($arreglo)
    {
        $resultado = [];

        for ($i = 0; $i < count($arreglo); $i++) {
            $encontrado = false;

            for ($j = 0; $j < count($resultado); $j++) {
                if ((string)$resultado[$j] == (string)$arreglo[$i]) {
                    $encontrado = true;
                    break;
                }
            }

            if (!$encontrado) {
                $resultado[] = $arreglo[$i];
            }
        }

        return $resultado;
    }

    private function contiene($arreglo, $valor)
    {
        for ($i = 0; $i < count($arreglo); $i++) {
            if ((string)$arreglo[$i] == (string)$valor) {
                return true;
            }
        }

        return false;
    }

    public function union()
    {
        $resultado = $this->conjuntoA;

        for ($i = 0; $i < count($this->conjuntoB); $i++) {
            if (!$this->contiene($resultado, $this->conjuntoB[$i])) {
                $resultado[] = $this->conjuntoB[$i];
            }
        }

        return $resultado;
    }

    public function interseccion()
    {
        $resultado = [];

        for ($i = 0; $i < count($this->conjuntoA); $i++) {
            if ($this->contiene($this->conjuntoB, $this->conjuntoA[$i])) {
                $resultado[] = $this->conjuntoA[$i];
            }
        }

        return $resultado;
    }

    public function diferenciaAB()
    {
        $resultado = [];

        for ($i = 0; $i < count($this->conjuntoA); $i++) {
            if (!$this->contiene($this->conjuntoB, $this->conjuntoA[$i])) {
                $resultado[] = $this->conjuntoA[$i];
            }
        }

        return $resultado;
    }

    public function diferenciaBA()
    {
        $resultado = [];

        for ($i = 0; $i < count($this->conjuntoB); $i++) {
            if (!$this->contiene($this->conjuntoA, $this->conjuntoB[$i])) {
                $resultado[] = $this->conjuntoB[$i];
            }
        }

        return $resultado;
    }

    public function formatearSalida($arreglo)
    {
        if (count($arreglo) == 0) {
            return "Ø (Conjunto vacío)";
        }

        $texto = "{ ";

        for ($i = 0; $i < count($arreglo); $i++) {
            $texto .= $arreglo[$i];

            if ($i < count($arreglo) - 1) {
                $texto .= ", ";
            }
        }

        $texto .= " }";

        return $texto;
    }
}
