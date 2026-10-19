<?php
class Acronimo
{
    private $frase;

    public function __construct($fraseTexto)
    {
        $this->frase = $fraseTexto;
    }

    public function generar()
    {
        $resultadoAcronimo = '';
        $esNuevaPalabra = true;
        $minusculas = 'abcdefghijklmnopqrstuvwxyz';
        $mayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $i = 0;
        $longitud = strlen($this->frase);

        while ($i < $longitud) {
            $caracter = $this->frase[$i];

            if ($caracter == ' ' || $caracter == '-') {
                $esNuevaPalabra = true;
            } else if ($esNuevaPalabra) {
                for ($j = 0; $j < 26; $j++) {
                    if ($caracter == $minusculas[$j]) {
                        $caracter = $mayusculas[$j];
                        break;
                    }
                }

                if ($caracter >= 'A' && $caracter <= 'Z') {
                    $resultadoAcronimo .= $caracter;
                }

                $esNuevaPalabra = false;
            }

            $i++;
        }

        return $resultadoAcronimo;
    }
}
