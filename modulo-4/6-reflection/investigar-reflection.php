<?php
require_once 'reflection.php';

//? Investigando uma classe
// $rc = new ReflectionClass('Automovel');
// echo '<pre>';

// print "MÉTODOS<br>";
// print_r($rc->getMethods());

// print "PROPRIEDADES<br>";
// print_r($rc->getProperties());

// print "CLASSE PAI<br>";
// print_r($rc->getParentClass());

// echo '<br>';

//* Posso investigar ainda mais a fundo, visualizando a sua documentação

//? Investigando um método específico
$rm = new ReflectionMethod('Automovel', 'setPlaca');
print $rm->getName() . "<br>";
print $rm->isPrivate() ? "Privado" : "Não privado";

//? Investigando uma propriedade
$rp = new ReflectionProperty('Automovel', 'placa');