<?php

$dom = new DOMDocument('1.0', 'UTF-8'); //* Inicializando um documento
$dom->formatOutput = true; //* Formatação com a indentação correta

$bases = $dom->createElement('bases'); //? Criando elementos
$base = $dom->createElement('base');
$bases->appendChild($base); //* Encadeando base dentro de bases

$atr = $dom->createAttribute('id'); //? Determinando atributo para base (id='1')
$atr->value = '1';
$base->appendChild($atr);

//? Passando elementos de 'base'
$base->appendChild($dom->createElement('nome', 'teste')); // nome, valor
$base->appendChild($dom->createElement('host', '192.168.0.1')); // nome, valor
$base->appendChild($dom->createElement('type', 'mysql')); // nome, valor
$base->appendChild($dom->createElement('user', 'mary')); // nome, valor

//? Salvando documento
print $dom->saveXML($bases); //* Modulo principal
file_put_contents('bases.xml', $dom->saveXML($bases));