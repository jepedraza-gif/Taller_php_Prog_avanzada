<?php
require 'Clases/nodo.php';

class ArbolBinario
{
    public $raiz;
    private $nodosDibujo = [];
    private $columnaActual = 0;
    private $nivelMaximo = 0;

    public function __construct($preordenTexto, $inordenTexto, $postordenTexto)
    {
        $preorden = $this->convertirArreglo($preordenTexto);
        $inorden = $this->convertirArreglo($inordenTexto);
        $postorden = $this->convertirArreglo($postordenTexto);
        $this->raiz = null;

        if (!empty($preorden) && !empty($inorden)) {
            $this->raiz = $this->construirPreIn($preorden, $inorden);
        } else if (!empty($inorden) && !empty($postorden)) {
            $this->raiz = $this->construirInPost($inorden, $postorden);
        } else if (!empty($preorden) && !empty($postorden)) {
            $this->raiz = $this->construirPrePost($preorden, $postorden);
        }

        if (!empty($this->raiz)) {
            if (!$this->valoresUnicos($preorden) || !$this->valoresUnicos($inorden) || !$this->valoresUnicos($postorden)) {
                $this->raiz = null;
            } else if (
                (!empty($preorden) && !$this->arreglosIguales($preorden, $this->obtenerPreorden($this->raiz))) ||
                (!empty($inorden) && !$this->arreglosIguales($inorden, $this->obtenerInorden($this->raiz))) ||
                (!empty($postorden) && !$this->arreglosIguales($postorden, $this->obtenerPostorden($this->raiz)))
            ) {
                $this->raiz = null;
            }
        }
    }private function convertirArreglo($texto)
    {
        $arreglo = []; $palabra = "";
        for ($i = 0; $i < strlen($texto); $i++) {
            $caracter = $texto[$i];
            if ($caracter != " " && $caracter != "\n" && $caracter != "\t") {
                $palabra .= $caracter;
            } else if (!empty($palabra)) {
                $arreglo[] = $palabra; $palabra = "";
            }
        }
        if (!empty($palabra)) { $arreglo[] = $palabra; }
        return $arreglo;
    }

    private function buscarIndice($arreglo, $valor)
    {
        for ($i = 0; $i < count($arreglo); $i++) {
            if ($arreglo[$i] == $valor) { return $i; }
        }
        return -1;
    }

    private function subArreglo($arreglo, $inicio, $longitud)
    {
        $resultado = [];
        for ($i = 0; $i < $longitud; $i++) {
            $indice = $inicio + $i;
            if ($indice < count($arreglo)) { $resultado[] = $arreglo[$indice]; }
        }
        return $resultado;
    }

    private function valoresUnicos($arreglo)
    {
        for ($i = 0; $i < count($arreglo); $i++) {
            for ($j = $i + 1; $j < count($arreglo); $j++) {
                if ($arreglo[$i] == $arreglo[$j]) { return false; }
            }
        }
        return true;
    }

    private function arreglosIguales($arreglo1, $arreglo2)
    {
        if (count($arreglo1) != count($arreglo2)) { return false; }
        for ($i = 0; $i < count($arreglo1); $i++) {
            if ($arreglo1[$i] != $arreglo2[$i]) { return false; }
        }
        return true;
    }

    private function construirPreIn($preorden, $inorden)
    {
        if (empty($preorden) || count($preorden) != count($inorden)) { return null; }
        $indiceRaiz = $this->buscarIndice($inorden, $preorden[0]);
        if ($indiceRaiz == -1) { return null; }
        $nodo = new Nodo($preorden[0]);
        $nodo->izquierdo = $this->construirPreIn($this->subArreglo($preorden, 1, $indiceRaiz), $this->subArreglo($inorden, 0, $indiceRaiz));
        $nodo->derecho = $this->construirPreIn($this->subArreglo($preorden, $indiceRaiz + 1, count($preorden) - $indiceRaiz - 1), $this->subArreglo($inorden, $indiceRaiz + 1, count($inorden) - $indiceRaiz - 1));
        return $nodo;
    }

    private function construirInPost($inorden, $postorden)
    {
        if (empty($inorden) || count($inorden) != count($postorden)) { return null; }
        $valorRaiz = $postorden[count($postorden) - 1];
        $indiceRaiz = $this->buscarIndice($inorden, $valorRaiz);
        if ($indiceRaiz == -1) { return null; }
        $nodo = new Nodo($valorRaiz);
        $nodo->izquierdo = $this->construirInPost($this->subArreglo($inorden, 0, $indiceRaiz), $this->subArreglo($postorden, 0, $indiceRaiz));
        $nodo->derecho = $this->construirInPost($this->subArreglo($inorden, $indiceRaiz + 1, count($inorden) - $indiceRaiz - 1), $this->subArreglo($postorden, $indiceRaiz, count($postorden) - $indiceRaiz - 1));
        return $nodo;
    }

    private function construirPrePost($preorden, $postorden)
    {
        if (empty($preorden) || count($preorden) != count($postorden) || $preorden[0] != $postorden[count($postorden) - 1]) { return null; }
        $nodo = new Nodo($preorden[0]);
        if (count($preorden) == 1) { return $nodo; }
        $indiceHijo = $this->buscarIndice($postorden, $preorden[1]);
        if ($indiceHijo == -1 || $indiceHijo == count($postorden) - 1) { return null; }
        $tamanoIzquierdo = $indiceHijo + 1;
        $nodo->izquierdo = $this->construirPrePost($this->subArreglo($preorden, 1, $tamanoIzquierdo), $this->subArreglo($postorden, 0, $tamanoIzquierdo));
        $nodo->derecho = $this->construirPrePost($this->subArreglo($preorden, $tamanoIzquierdo + 1, count($preorden) - $tamanoIzquierdo - 1), $this->subArreglo($postorden, $tamanoIzquierdo, count($postorden) - $tamanoIzquierdo - 1));
        return $nodo;
    }

    private function obtenerPreorden($nodo)
    {
        $resultado = [];
        if (!empty($nodo)) {
            $resultado[] = $nodo->valor;
            foreach ($this->obtenerPreorden($nodo->izquierdo) as $valor) { $resultado[] = $valor; }
            foreach ($this->obtenerPreorden($nodo->derecho) as $valor) { $resultado[] = $valor; }
        }
        return $resultado;
    }
    private function obtenerInorden($nodo)
    {
        $resultado = [];
        if (!empty($nodo)) {
            foreach ($this->obtenerInorden($nodo->izquierdo) as $valor) { $resultado[] = $valor; }
            $resultado[] = $nodo->valor;
            foreach ($this->obtenerInorden($nodo->derecho) as $valor) { $resultado[] = $valor; }
        }
        return $resultado;
    }

    private function obtenerPostorden($nodo)
    {
        $resultado = [];
        if (!empty($nodo)) {
            foreach ($this->obtenerPostorden($nodo->izquierdo) as $valor) { $resultado[] = $valor; }
            foreach ($this->obtenerPostorden($nodo->derecho) as $valor) { $resultado[] = $valor; }
            $resultado[] = $nodo->valor;
        }
        return $resultado;
    }

    public function imprimirEstructura($nodo, $nivel = 0, $etiqueta = "Raíz")
    {
        if (empty($nodo)) { return ""; }
        $espacios = "";
        for ($i = 0; $i < $nivel; $i++) { $espacios .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; }
        $resultado = "<p>" . $espacios . "└─ " . $etiqueta . ": " . htmlspecialchars((string)$nodo->valor) . "</p>";
        if (!empty($nodo->izquierdo) || !empty($nodo->derecho)) {
            $resultado .= !empty($nodo->izquierdo) ? $this->imprimirEstructura($nodo->izquierdo, $nivel + 1, "Izq") : "<p>" . $espacios . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└─ Izq: (Vacío)</p>";
            $resultado .= !empty($nodo->derecho) ? $this->imprimirEstructura($nodo->derecho, $nivel + 1, "Der") : "<p>" . $espacios . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└─ Der: (Vacío)</p>";
        }
        return $resultado;
    }
    private function recorrerParaDibujo($nodo, $nivel, $padre, $lado)
    {
        if (empty($nodo)) { return; }
        $indiceNodo = count($this->nodosDibujo);
        $this->nodosDibujo[] = ["valor" => $nodo->valor, "nivel" => $nivel, "columna" => 0, "padre" => $padre, "lado" => $lado];
        if ($nivel > $this->nivelMaximo) { $this->nivelMaximo = $nivel; }
        $this->recorrerParaDibujo($nodo->izquierdo, $nivel + 1, $indiceNodo, "izq");
        $this->nodosDibujo[$indiceNodo]["columna"] = $this->columnaActual++;
        $this->recorrerParaDibujo($nodo->derecho, $nivel + 1, $indiceNodo, "der");
    }
    public function obtenerNodos()
    {
        $this->nodosDibujo = []; $this->columnaActual = 0; $this->nivelMaximo = 0;
        $this->recorrerParaDibujo($this->raiz, 0, -1, "raiz");
        return $this->nodosDibujo;
    }
    public function obtenerNivelMaximo() {
        return $this -> nivelMaximo;}
}