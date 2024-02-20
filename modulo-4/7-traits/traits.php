<?php
//! TRAITS
//? Compartilhar métodos de classes diferentes
//? Conjunto de métodos que podemos importar para outras classes

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

class Produto extends Record
{
    const TABLENAME = 'produto';
    use ObjectConversionTrait; //* Chamando uma trait
}

//? Poderia colocar dentro de Record, mas acabaria descaracterizando a classe
trait ObjectConversionTrait
{
    public function toXML()
    {
        $xml = new SimpleXMLElement('<'.get_class($this).'/>');
        foreach($this->data as $key => $value)
        {
            $xml->addChild($key, $value);
        }
        return $xml->asXML();
    }
    public function toJSON()
    {
        return json_encode($this->data);
    }
}

$x = new Produto;
$x->nome = 'Chocolate';
$x->preco = 10;
$x->estoque = 100;

print $x->save() . '<br>';
print $x->toJSON() . '<br>';
print $x->toXML();
