
<?php
class Calculadora
{
    private $num1;
    private $num2;
    private $operacion;

    public function __construct($n1, $n2, $op)
    {
        $this->num1 = (float)$n1;
        $this->num2 = (float)$n2;
        $this->operacion = $op;
    }

    public function calcular()
    {
        $resultado = 0;
        $simbolo = "";

        switch ($this->operacion) {
            case "suma":
                $resultado = $this->num1 + $this->num2;
                $simbolo = "+";
                break;

            case "resta":
                $resultado = $this->num1 - $this->num2;
                $simbolo = "-";
                break;

            case "multiplicacion":
                $resultado = $this->num1 * $this->num2;
                $simbolo = "x";
                break;

            case "division":
                if ($this->num2 == 0) {
                    return "Error: No se puede dividir entre cero.";
                }

                $resultado = $this->num1 / $this->num2;
                $simbolo = "/";
                break;

            case "porcentaje":
                $resultado = ($this->num1 * $this->num2) / 100;
                $simbolo = "% de";
                break;

            default:
                return "Operación no válida.";
        }

        return $this->num1 . " " . $simbolo . " " .
            $this->num2 . " = " . $resultado;
    }
}
