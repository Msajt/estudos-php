<?php
//! O conceito de Active Record junta as duas características do Table Data Gateway em uma classe só
//? Métodos de persistência + métodos de negócio
//* Fere o princípio da responsabilidade única
class ProdutoTransaction
{
    private $data;

    public function __get($prop)
    {
        return $this->data[$prop];
    }

    public function __set($prop, $value)
    {
        $this->data[$prop] = $value;
    }

    //? Funções de persistência
    public static function find($id){
        $sql = "SELECT * FROM produto WHERE id = '$id'";
        print $sql.'<br>';

        $conn = Transaction::get();
        $result = $conn->query($sql);
        return $result->fetchObject(__CLASS__); //* Constante mágica que representa a propria classe
    }

    public static function all($filter = '')
    {
        $sql = "SELECT * FROM produto";
        if ($filter) {
            $sql .= " WHERE $filter";
        }
        print $sql.'<br>';
        $conn = Transaction::get();
        $result = $conn->query($sql);
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public function delete()
    {
        $sql = "DELETE FROM produto WHERE id = '$this->id'";
        print $sql.'<br>';
        $conn = Transaction::get();
        return $conn->query($sql);
    }

    public function save()
    {
        if (empty ($this->data['id'])) {
            $id = $this->getLastId() + 1;
            $sql = "INSERT INTO produto (id, descricao, estoque, preco_custo, preco_venda, codigo_barras, data_cadastro, origem)
                    VALUES ('{$id}', 
                            '{$this->descricao}',
                            '{$this->estoque}',
                            '{$this->preco_custo}',
                            '{$this->preco_venda}',
                            '{$this->codigo_barras}',
                            '{$this->data_cadastro}',
                            '{$this->origem}'
                           )";
        } else {
            $sql = "UPDATE produto SET descricao     = '{$this->descricao}',
                                       estoque       = '{$this->estoque}',
                                       preco_custo   = '{$this->preco_custo}',
                                       preco_venda   = '{$this->preco_venda}',
                                       codigo_barras = '{$this->codigo_barras}',
                                       data_cadastro = '{$this->data_cadastro}',
                                       origem        = '{$this->origem}'
                                 WHERE id            = '{$this->id}'";
        }
        print "$sql <br>";
        $conn = Transaction::get();
        return $conn->exec($sql);
    }

    public function getLastId()
    {
        $sql = "SELECT max(id) as max FROM produto";
        print $sql.'<br>';
        $conn = Transaction::get();
        $result = $conn->query($sql);
        $data = $result->fetchObject();
        return $data->max;
    }

    //? Funções de regra de negócio
    public function getMargemLucro()
    {
        return (($this->preco_venda - $this->preco_custo)/$this->preco_custo)*100;
    }

    public function registraCompra($custo, $quantidade)
    {
        $this->preco_custo = $custo;
        $this->estoque += $quantidade;
    }
}