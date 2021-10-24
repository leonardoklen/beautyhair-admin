<?php 

namespace App\Models\Entidades;

class Campanha{
private $idCampanha;
private $descricao;
private $de;
private $ate;
private $desconto;
private $formaPagamento;
private $situacao;


public function getIdCampanha(){
    return $this->idCampanha;
}

public function setIdCampanha($idCampanha){
    $this->idCampanha = $idCampanha;
}

public function getDescricao(){
    return $this->descricao;
}

public function setDescricao($descricao){
    $this->descricao = $descricao;
}

public function getDe(){
    return $this->de;
}


public function setDe($de){
    $this->de = $de;
}

public function getAte(){
    return $this->ate;
}

public function setAte($ate){
    $this->ate = $ate;
}

public function getDesconto(){
    return $this->desconto;
}

public function setDesconto($desconto){
    $this->desconto = $desconto;
}

public function getFormaPagamento(){
    return $this->formaPagamento;
}

public function setFormaPagamento($formaPagamento){
    $this->formaPagamento = $formaPagamento;
}

public function getSituacao(){
    return $this->situacao;
}

public function setSituacao($situacao){
    $this->situacao = $situacao;
}

}
?>