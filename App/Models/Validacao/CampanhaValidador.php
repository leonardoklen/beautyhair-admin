<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Campanha;

class CampanhaValidador{

    public function validar(Campanha $campanha)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($campanha->getDescricao()))
        {
            $resultadoValidacao->addErro('descricao',"Descricao: Este campo não pode ser vazio.");
        }

        if(empty($campanha->getDe()))
        {
            $resultadoValidacao->addErro('de',"De: Este campo não pode ser vazio.");
        }

        if(empty($campanha->getAte())){
            $resultadoValidacao->addErro('ate',"Ate: Este campo não pode ser vazio.");
        }

        if(empty($campanha->getDesconto())){
            $resultadoValidacao->addErro('desconto',"Desconto: Este campo não pode ser vazio.");
        }

        if(empty($campanha->getFormaPagamento())){
            $resultadoValidacao->addErro('formaPagamento',"Forma de Pagamento: Este campo não pode ser vazio.");
        }

        if(empty($campanha->getSituacao())){
            $resultadoValidacao->addErro('situacao',"Situação: Este campo não pode ser vazio.");
        }

        date_default_timezone_set('America/Sao_Paulo');

        if($campanha->getAte()< date('Y-m-d')){
            $resultadoValidacao->addErro('ate', "Até: selecione uma data igual ou maior que hoje.");
        }

        return $resultadoValidacao;
    }
}