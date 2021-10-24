<?php 

namespace App\Models\Entidades;

class Cidade{
private $idCidade;
private $nome;
private $Estado_idEstado;


public function getIdCidade(){
    return $this->idCidade;
}

public function setIdCidade($idCidade){
    $this->idCidade = $idCidade;
}

public function getNome(){
    return $this->nome;
}

public function setNome($nome){
    $this->nome = $nome;
}

public function getEstado_idEstado(){
    return $this->Estado_idEstado;
}

public function setEstado_idEstado($Estado_idEstado){
    $this->Estado_idEstado = $Estado_idEstado;
}

}
?>