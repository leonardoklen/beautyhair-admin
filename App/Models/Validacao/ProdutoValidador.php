<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Produto;

class ProdutoValidador{

    public function validar(Produto $produto)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($produto->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio.");
        }

        if($produto->getQuantidadeEstoque()<0)
        {
            $resultadoValidacao->addErro('quantidadeEstoque',"Quantidade: Este campo deve ser igual ou maior que 0.");
        }

        if(empty($produto->getFornecedor_cnpj())){
            $resultadoValidacao->addErro('fornecedor',"Fornecedor: Este campo não pode ser vazio.");
        }

        return $resultadoValidacao;
    }
}