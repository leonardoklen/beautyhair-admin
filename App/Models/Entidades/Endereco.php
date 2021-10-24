<?php 

namespace App\Models\Entidades;

class Endereco{
private $idEndereco;
private $cep;
private $logradouro;
private $numero;
private $bairro;
private $complemento;
private $Cidade_idCidade;


public function getIdEndereco(){
    return $this->idEndereco;
}

public function setIdEndereco($idEndereco){
    $this->idEndereco = $idEndereco;
}

public function getCep(){
    return $this->cep;
}

public function setCep($cep){
    $this->cep = $cep;
}

public function getLogradouro(){
    return $this->logradouro;
}

public function setLogradouro($logradouro){
    $this->logradouro = $logradouro;
}

public function getNumero(){
    return $this->numero;
}

public function setNumero($numero){
    $this->numero = $numero;
}

public function getBairro(){
    return $this->bairro;
}

public function setBairro($bairro){
    $this->bairro = $bairro;
}

public function getComplemento(){
    return $this->complemento;
}

public function setComplemento($complemento){
    $this->complemento = $complemento;
}

public function getCidade_idCidade(){
    return $this->Cidade_idCidade;
}

public function setCidade_idCidade($Cidade_idCidade){
    $this->Cidade_idCidade = $Cidade_idCidade;
}

}
?>