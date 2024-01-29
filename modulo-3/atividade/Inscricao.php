<?php
require_once './classes/Evento.php';

class Inscricao
{
    //? Variável da exibição do html na página e coleta dos dados
    private $html;
    private $data;

    //? Inicializa o construtor
    public function __construct()
    {
        //* Inicializando conteúdo da página HTML
        $this->html = file_get_contents('./html/inscricao.html');
        //* Inicializando os dados para inscrição
        $this->data = [
            'nome' => '',
            'email' => '',
            'curso' => '',
            'telefone' => ''
        ];
        //* Colocando cursos na lista de opções
        $palestras = '';
        foreach (Evento::optionPalestras() as $palestra) {
            $id = $palestra['id'];
            $titulo = $palestra['titulo'];

            $palestras .= "<option value='{$id}'>{$titulo}</option>";
        }
        $this->html = str_replace('{palestras}', $palestras, $this->html);
    }

    public function save($param)
    {
        try {
            $this->data = $param;
            Evento::inscricao($this->data);
            print 'Inscrição realizada com sucesso';
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function show()
    {
        //? Substituindo os valores em {}
        //* str_replace
        $this->html = str_replace('{nome}', $this->data['nome'], $this->html);
        $this->html = str_replace('{email}', $this->data['email'], $this->html);
        $this->html = str_replace('{curso}', $this->data['curso'], $this->html);
        $this->html = str_replace('{telefone}', $this->data['telefone'], $this->html);

        //? Exibir o HTML
        print $this->html;
    }
}