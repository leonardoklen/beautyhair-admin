<?php 

namespace App\Models\Entidades;

class Estado{
private $idEstado;
private $sigla;


public function getIdEstado(){
    return $this->idEstado;
}

public function setIdEstado($idEstado){
    $this->idEstado = $idEstado;
}

public function getSigla(){
    return $this->sigla;
}

public function setSigla($sigla){
    $this->sigla = $sigla;
}

}
?>