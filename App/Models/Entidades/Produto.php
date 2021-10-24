<?php 

namespace App\Models\Entidades;

class Produto{
private $idProduto;
private $nome;
private $quantidadeEstoque;
private $Fornecedor_cnpj;


public function getIdProduto(){
    return $this->idProduto;
}

public function setIdProduto($idProduto){
    $this->idProduto = $idProduto;
}

public function getNome(){
    return $this->nome;
}

public function setNome($nome){
    $this->nome = $nome;
}

public function getQuantidadeEstoque(){
    return $this->quantidadeEstoque;
}

public function setQuantidadeEstoque($quantidadeEstoque){
    $this->quantidadeEstoque = $quantidadeEstoque;
}

public function getFornecedor_cnpj(){
    return $this->Fornecedor_cnpj;
}

public function setFornecedor_cnpj($Fornecedor_cnpj){
    $this->Fornecedor_cnpj = $Fornecedor_cnpj;
}

}
?>