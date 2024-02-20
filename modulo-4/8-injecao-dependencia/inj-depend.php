<?php
//? Diminuir dependencia de uma classe

class Record
{
    protected $data;

    public function __set($prop, $value)
    {
        $this->data[$prop] = $value;
    }
    public function __get($prop)
    {
        return $this->data[$prop];
    }
    public function save()
    {
        return "INSERT INTO " . $this::TABLENAME . 
                '(' . implode(',', array_keys($this->data)) . ')' .
                ' values ' .
                "('" . implode("','", array_values($this->data)) . "')";
    }
    public function delete($id)
    {
        return "DELETE FROM " . $this::TABLENAME . " WHERE id={$id} ";
    }

    public function load($id)
    {
        return "SELECT * FROM " . $this::TABLENAME . " WHERE id={$id} ";
    }
}

interface ExporterInterface
{
    public function export($data);
}
class JSONExporter implements ExporterInterface
{
    public function export($data)
    {
        return json_encode($data);
    }
}
class Pessoa extends Record
{
    const TABLENAME = 'pessoas';

    public function export(ExporterInterface $exporter)
    {
        // $je = new JSONExporter;
        // return $je->export($this->data);
        return $exporter->export($this->data);
    }
}

$p = new Pessoa;
$p->nome = 'Maria';
$p->endereco = 'Rua das Flores';
$p->numero = '123';
print $p->export(new JSONExporter);