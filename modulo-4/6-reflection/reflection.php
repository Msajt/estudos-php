<?php
//! =-=-= REFLECTION =-=-=

//? Forma de investigar o código fonte, saber as características gerais

class Veiculo
{
    protected $ano;
    protected $cor;
    protected $marca;
    protected $parts;

    public function getParts(){}
    public function setMarca($marca){}
}

class Automovel extends Veiculo
{
    private $placa;
    const RODAS=4;

    public function getPlaca(){}
    public function setPlaca($marca){}
}