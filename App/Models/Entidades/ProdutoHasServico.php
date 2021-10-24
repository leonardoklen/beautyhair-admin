<?php 

namespace App\Models\Entidades;

class ProdutoHasServico{
private $Produto_idProduto;
private $Servico_idServico;
private $quantidadeProdutoUtilizado;


public function getProduto_idProduto(){
    return $this->Produto_idProduto;
}

public function setProduto_idProduto($Produto_idProduto){
    $this->Produto_idProduto = $Produto_idProduto;
}

public function getServico_idServico(){
    return $this->Servico_idServico;
}

public function setServico_idServico($Servico_idServico){
    $this->Servico_idServico = $Servico_idServico;
}

public function getQuantidadeProdutoUtilizado(){
    return $this->quantidadeProdutoUtilizado;
}

public function setQuantidadeProdutoUtilizado($quantidadeProdutoUtilizado){
    $this->quantidadeProdutoUtilizado = $quantidadeProdutoUtilizado;
}


}
?>