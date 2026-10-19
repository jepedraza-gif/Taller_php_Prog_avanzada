<?php
class Estadistica
{
    private $numeros;

    public function __construct($arregloNumeros)
    {
        $this->numeros = $arregloNumeros;
    }

    public function calcularPromedio()
    {
        $cantidad = count($this->numeros);

        if ($cantidad == 0) {
            return 0;
        }

        $suma = 0;

        for ($i = 0; $i < $cantidad; $i++) {
            $suma += $this->numeros[$i];
        }

        return $suma / $cantidad;
    }

    public function calcularMediana()
    {
        $datosOrdenados = $this->numeros;
        $cantidad = count($datosOrdenados);

        if ($cantidad == 0) {
            return 0;
        }

        for ($i = 0; $i < $cantidad - 1; $i++) {
            for ($j = 0; $j < $cantidad - $i - 1; $j++) {
                if ($datosOrdenados[$j] > $datosOrdenados[$j + 1]) {
                    $temporal = $datosOrdenados[$j];
                    $datosOrdenados[$j] = $datosOrdenados[$j + 1];
                    $datosOrdenados[$j + 1] = $temporal;
                }
            }
        }

        if ($cantidad % 2 == 0) {
            $posicion1 = ($cantidad / 2) - 1;
            $posicion2 = $cantidad / 2;

            return (
                $datosOrdenados[$posicion1] +
                $datosOrdenados[$posicion2]
            ) / 2;
        }

        $posicionCentral = (int)(($cantidad - 1) / 2);

        return $datosOrdenados[$posicionCentral];
    }

    public function calcularModa()
    {
        $frecuencias = [];
        $cantidad = count($this->numeros);

        if ($cantidad == 0) {
            return "No hay datos para calcular la moda.";
        }

        for ($i = 0; $i < $cantidad; $i++) {
            $numero = (string)$this->numeros[$i];

            if (empty($frecuencias[$numero])) {
                $frecuencias[$numero] = 1;
            } else {
                $frecuencias[$numero]++;
            }
        }

        $maxRepeticiones = 0;

        foreach ($frecuencias as $repeticiones) {
            if ($repeticiones > $maxRepeticiones) {
                $maxRepeticiones = $repeticiones;
            }
        }

        if ($maxRepeticiones == 1) {
            return "No hay moda porque ningún número se repite.";
        }

        $modas = [];
        $cantidadModas = 0;

        foreach ($frecuencias as $numero => $repeticiones) {
            if ($repeticiones == $maxRepeticiones) {
                $modas[$cantidadModas] = $numero;
                $cantidadModas++;
            }
        }

        $resultado = "";

        for ($i = 0; $i < $cantidadModas; $i++) {
            $resultado .= $modas[$i];

            if ($i < $cantidadModas - 1) {
                $resultado .= ", ";
            }
        }

        return $resultado;
    }
}
