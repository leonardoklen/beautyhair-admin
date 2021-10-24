<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Endereco;

class EnderecoValidador{

    public function validar(Endereco $endereco)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($endereco->getCep()))
        {
            $resultadoValidacao->addErro('cep',"Cep: este campo não pode ser vazio");
        }

        if(empty($endereco->getLogradouro()))
        {
            $resultadoValidacao->addErro('logradouro',"Logradouro: este campo não pode ser vazio");
        }
        
        if(empty($endereco->getNumero()))
        {
            $resultadoValidacao->addErro('numero',"Numero: este campo não pode ser vazio");
        }

        if(empty($endereco->getBairro()))
        {
            $resultadoValidacao->addErro('bairro',"Bairro: este campo não pode ser vazio");
        }

        if(empty($endereco->getCidade_idCidade()))
        {
            $resultadoValidacao->addErro('Cidade_idCidade',"Cidade/UF: estes campos não podem ser vazios");
        }

        return $resultadoValidacao;
    }
}