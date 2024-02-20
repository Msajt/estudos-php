<?php
//! =-=-= TRATAMENTO DE ERROS =-=-= !//

require_once 'classes/CSVParser.php';

$csv = new CSVParser('data.csv', ';');

// if ($csv->parse()) {
//     echo '<pre>';
//     while ($row = $csv->fetch()) {
//         var_dump($row);
//     }
// } else {
//     echo "Erro na leitura do arquivo";
// }
//? Forma de execução com tratamento de exceção
try {
    $csv->parse();
    //echo '<pre>';
    while ($row = $csv->fetch()) {
        //var_dump($row);
        print "{$row['Cliente']} - {$row['Cidade']} <br>";
    }

} catch (Exception $e) {
    //* A mensagem que eu deixei no 'throw new Exception' é exibida aqui
    print $e->getMessage();
}