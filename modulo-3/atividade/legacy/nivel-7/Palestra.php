<?php
require_once './classes/Evento.php';

class Palestra
{
    //? Variável de exibição do HTML e ID da palestra
    private $html;
    private $id;

    //? Inicializando o construtor
    public function __construct()
    {
        $this->html = file_get_contents('./html/inscritos.html');
        $this->id = $_GET['id'];
    }

    public function load()
    {
        try {          
            //? Coletando dados referentes aos inscritos e cabeçalho da palestra
            $header = Evento::cabecalho($this->id);
            $inscritos = Evento::participantes($this->id);

            $inscritosDisponiveis = '';
            foreach ($inscritos as $inscrito) {
                //? Pegando o conteúdo HTML
                //* file_get_contents
                $conteudo = file_get_contents('./html/listaInscritos.html');
                //? Substituindo variáveis que estão em {}
                //* str_replace
                $conteudo = str_replace('{nome}', $inscrito['nome'], $conteudo);
                $conteudo = str_replace('{telefone}', $inscrito['telefone'], $conteudo);
                $conteudo = str_replace('{email}', $inscrito['email'], $conteudo);
                $conteudo = str_replace('{curso}', $inscrito['curso'], $conteudo);

                $inscritosDisponiveis .= $conteudo;
            }

            //? Substituindo conteúdo em {}
            $this->html = str_replace('{titulo}', $header['titulo'], $this->html);
            $this->html = str_replace('{palestrante}', $header['palestrante'], $this->html);
            $this->html = str_replace('{inscritosDisponiveis}', $inscritosDisponiveis, $this->html);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function show(){
        $this->load();
        print $this->html;
    }
}