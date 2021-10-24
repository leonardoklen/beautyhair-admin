<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Servico;

class ServicoValidador{

    public function validar(Servico $servico)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($servico->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio.");
        }

        if($servico->getPreco()<0)
        {
            $resultadoValidacao->addErro('preco',"Preço: Este campo não pode ser vazio.");
        }

        return $resultadoValidacao;
    }
}