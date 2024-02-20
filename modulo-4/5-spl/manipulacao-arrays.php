<?php
//! Manipulação arrays
$dados = ['salmao', 'tilapia', 'sardinha', 'piranha', 'corvina', 'dourado', 'garoupa', 'bagre', 'cavala'];

$objArray = new ArrayObject($dados);

$objArray->append('bacalhau'); //* Insere novo item
print $objArray->offsetGet(2) . '<br>'; //* O que tem no elemento 'x'
$objArray->offsetSet(2, 'linguado'); //* Substitui valor do item
$objArray->offsetUnset(4); //* Remove elemento
print $objArray->count() . '<br>'; //* Conta elementos
if($objArray->offsetExists(4)) print "Encontrado <br>";
    else print "Não encontrado <br>";

$objArray[] = 'atum';

$objArray->natsort();

foreach($objArray as $item){
    print "Item: {$item}<br>";
}

$objArray->serialize();