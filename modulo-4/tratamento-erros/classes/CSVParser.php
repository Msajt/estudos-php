<?php
//! Manipulando o arquivo CSV (data.csv)
class CSVParser
{
    private $filename;
    private $separator;
    private $counter;
    private $data;
    private $header;
    public function __construct($filename, $separator = ',')
    {
        $this->filename = $filename;
        $this->separator = $separator;
        $this->counter = 1; //* Conta a linha atual do arquivo
    }

    //? Leitura do arquivo
    public function parse()
    {
        //^ Tratamento 1 - Verifica se o arquivo existe
        if (!file_exists($this->filename)) {
            // die("Arquivo {$this->filename} não existe");                  //! Para toda a execução do programa após a chamada da função
            // return FALSE;                                                 //! Existem várias situações de erro, para ser mais apropriado
            throw new Exception("Arquivo {$this->filename} não encontrado"); //* Use Exceptions
        }
        //^ Tratamento 2 - Verifica se pode fazer a leitura do arquivo
        if (!is_readable($this->filename)) {
            // die("Arquivo {$this->filename} sem leitura");
            //return FALSE;
            throw new Exception("Arquivo {$this->filename} não pode ser lido");
        }
        $this->data = file($this->filename); //* Pega o arquivo
        $this->header = str_getcsv($this->data[0], $this->separator); //* Transforma a primeira linha no array (cabeçalho)
        return TRUE;
    }
    //? Retornar uma linha por vez
    public function fetch()
    {
        if (isset($this->data[$this->counter])) {
            $row = str_getcsv($this->data[$this->counter++], $this->separator);
            foreach ($row as $key => $value) {
                $row[$this->header[$key]] = $value;
            }
            return $row;
        }
    }
}
