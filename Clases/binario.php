
<?php
class ConversorBinario
{
    private $numero;

    public function __construct($numeroEntero)
    {
        $this->numero = (int)$numeroEntero;
    }

    public function convertir()
    {
        if ($this->numero == 0) {
            return "0";
        }

        if ($this->numero < 0) {
            return "Ingresa un número entero no negativo.";
        }

        $resultadoBinario = "";
        $cociente = $this->numero;

        while ($cociente > 0) {
            $residuo = $cociente % 2;
            $resultadoBinario = $residuo . $resultadoBinario;
            $cociente = (int)($cociente / 2);
        }

        return $resultadoBinario;
    }
}
