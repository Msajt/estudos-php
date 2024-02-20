<?php
//! Acessando atributos filhos
$xml = simplexml_load_file('exemplo2.xml');

//? Acessando elementos do atributo 'geografia'
print 'Informações geográficas: <br>';
print "Clima: {$xml->geografia->clima} <br>";
print "Clima: {$xml->geografia->costa} <br>";
print "Clima: {$xml->geografia->pico} <br>";