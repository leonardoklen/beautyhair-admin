<?php 

namespace App\Models\Entidades;

class Fornecedor{
private $cnpj;
private $razaoSocial;
private $nomeFantasia;
private $nomeContato;
private $telefoneFixo;
private $telefoneCelular;
private $Endereco_idEndereco;
private $Empresa_cnpj;


public function getCnpj(){
    return $this->cnpj;
}

public function setCnpj($cnpj){
    $this->cnpj = $cnpj;
}

public function getRazaoSocial(){
    return $this->razaoSocial;
}

public function setRazaoSocial($razaoSocial){
    $this->razaoSocial = $razaoSocial;
}

public function getNomeFantasia(){
    return $this->nomeFantasia;
}

public function setNomeFantasia($nomeFantasia){
    $this->nomeFantasia = $nomeFantasia;
}

public function getNomeContato(){
    return $this->nomeContato;
}

public function setNomeContato($nomeContato){
    $this->nomeContato = $nomeContato;
}

public function getTelefoneFixo(){
    return $this->telefoneFixo;
}

public function setTelefoneFixo($telefoneFixo){
    $this->telefoneFixo = $telefoneFixo;
}

public function getTelefoneCelular(){
    return $this->telefoneCelular;
}

public function setTelefoneCelular($telefoneCelular){
    $this->telefoneCelular = $telefoneCelular;
}

public function getEndereco_idEndereco(){
    return $this->Endereco_idEndereco;
}

public function setEndereco_idEndereco($Endereco_idEndereco){
    $this->Endereco_idEndereco = $Endereco_idEndereco;
}

public function getEmpresa_cnpj(){
    return $this->Empresa_cnpj;
}

public function setEmpresa_cnpj($Empresa_cnpj){
    $this->Empresa_cnpj = $Empresa_cnpj;
}

}
?>