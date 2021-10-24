<?php 

namespace App\Models\Entidades;

class Colaborador{
private $cpf;
private $nome;
private $sexo;
private $telefone;
private $login;
private $senha;
private $Empresa_cnpj;
private $Endereco_idEndereco;


public function getCpf(){
    return $this->cpf;
}

public function setCpf($cpf){
    $this->cpf = $cpf;
}

public function getNome(){
    return $this->nome;
}

public function setNome($nome){
    $this->nome = $nome;
}

public function getSexo(){
    return $this->sexo;
}

public function setSexo($sexo){
    $this->sexo = $sexo;
}

public function getTelefone(){
    return $this->telefone;
}

public function setTelefone($telefone){
    $this->telefone = $telefone;
}

public function getLogin(){
    return $this->login;
}

public function setLogin($login){
    $this->login = $login;
}

public function getSenha(){
    return $this->senha;
}

public function setSenha($senha){
    $this->senha = $senha;
}

public function getEmpresa_cnpj(){
    return $this->Empresa_cnpj;
}

public function setEmpresa_cnpj($Empresa_cnpj){
    $this->Empresa_cnpj = $Empresa_cnpj;
}

public function getEndereco_idEndereco(){
    return $this->Endereco_idEndereco;
}

public function setEndereco_idEndereco($Endereco_idEndereco){
    $this->Endereco_idEndereco = $Endereco_idEndereco;
}

}
?>