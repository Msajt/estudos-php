<?php
require_once './classes/Evento.php';

class Palestras
{
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents('./html/palestras.html');
    }

    public function load()
    {
        try {
            //? Listando as palestras disponíveis
            $palestras = Evento::palestras();

            $palestrasDisponiveis = '';
            foreach ($palestras as $palestra) {
                $conteudo = file_get_contents('./html/listaPalestras.html');
                //? Substituindo os valores em {}
                //* str_replace
                $conteudo = str_replace('{id}', $palestra['id'], $conteudo);
                $conteudo = str_replace('{titulo}', $palestra['titulo'], $conteudo);
                $conteudo = str_replace('{palestrante}', $palestra['palestrante'], $conteudo);
                $conteudo = str_replace('{horario}', $palestra['horario'], $conteudo);

                //? Alimentando o conteúdo das tabelas
                $palestrasDisponiveis .= $conteudo;
            }
            $this->html = str_replace("{palestrasDisponiveis}", $palestrasDisponiveis, $this->html);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function show()
    {
        $this->load();
        print $this->html;
    }
}