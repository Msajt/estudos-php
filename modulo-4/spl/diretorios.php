<?php
//! Percorrendo diretórios
//? Antes da biblioteca SPL, era usado funções (opendir, readdir, closedir)
//? Com a biblioteca SPL (usando DirectoryIterator)

// foreach (new DirectoryIterator('/var/www/html/curso-php/modulo-4/spl/') as $file) {
//     print "Nome do arquivo: " . $file->getFileName() . "<br>";
//     print "Extensão: " . $file->getExtension() . "<br>";
//     print "Tamanho: " . $file->getSize() . "<br>";
//     print (string) $file . "<br><br>";
// }

//? Acesso a subpastas
$path = '/var/www/html/curso-php/';
foreach (new RecursiveIteratorIterator
            (new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS)) as $item) 
{
    print (string) $item . '<br>';
}