<?php
//? Conjunto de classes para série de tarefas comuns, em estruturas de dados, iterators, recursiva,
//? exceções, carregamento de arquivo, etc...

//? Operação sem SPL
//*     Teria que fazer as classes para fazer a manipulação de uma tarefa 'x'
//*     Ex.: manipulação de arquivos

//? Operação com SPL
// $file = new SplFileInfo('manipulacao-arquivos.php'); //* Lê informações sobre o arquivo
// print "Nome: {$file->getFilename()}<br>";
// print "Extensão: {$file->getExtension()}<br>";
// print "Tamanho: {$file->getSize()}<br>";
// print "Tipo: {$file->getType()}<br>";
// print "Permissão escrita: {$file->isWritable()}<br>";

$file = new SplFileObject('manipulacao-arquivos.php'); //* Manipula arquivos
print "Nome: {$file->getFilename()}<br>";
print "Extensão: {$file->getExtension()}<br>";
print "Tamanho: {$file->getSize()}<br>";
print "Tipo: {$file->getType()}<br>";
print "Permissão escrita: {$file->isWritable()}<br>";

// $file2 = new SplFileObject('novo.txt', 'w'); //* Criando um arquivo .txt
// $bytes = $file2->fwrite('Olá mundo PHP');
// print "Bytes: {$bytes}";

// while(!$file->eof()){
//     print $file->fgets();
// }

foreach($file as $line => $content){
    print "$line : $content <br>";
}