<?php
//! Leitura dos arquivos utilizando DOM
//? Inicializando
$doc = new DOMDocument;

//? Carregando o arquivo
$doc->load('exemplo.xml');

//* Métodos
$bases = $doc->getElementsByTagName('base');

print '<pre>';
foreach($bases as $base){
    //var_dump($base);
    print "ID: {$base->getAttribute('id')}\n";
    $names = $base->getElementsByTagName('name');
    $hosts = $base->getElementsByTagName('host');
    $types = $base->getElementsByTagName('type');
    $users = $base->getElementsByTagName('user');

    print "Name: {$names->item(0)->nodeValue}\n";
    print "Host: {$hosts->item(0)->nodeValue}\n";
    print "Type: {$types->item(0)->nodeValue}\n";
    print "User: {$users->item(0)->nodeValue}\n";
}