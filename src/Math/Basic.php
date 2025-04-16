<?php 
namespace Projetux\Math;

class Basic{
    /**
     * @return int|float
     */
    public function soma(int|float $numero, int|float $numero2) 
    {
        return $numero + $numero2;
    }
    /**
     * @return int|float
     */
    public function subtrai(int|float $numero, int|float $numero2)
    {
        return $numero - $numero2;
    }

    /**
     * @return int|float
     */
    public function mutipliq(int|float $numero, int|float $numero2)
    {
        return $numero * $numero2;
    }

    public function divicao(int|float $numero, int|float $numero2)
    {
        return $numero / $numero2;
        if ($numero / $numero2 == 0) {
            return "Não é possível dividir por zero";
        }
    }

    public function elevadoaoquadrado(int|float $numero)
    {
        return pow($numero, 2);
    }

    public function raiz(int|float $numero)
    {
        return sqrt($numero);
    }


}

?>