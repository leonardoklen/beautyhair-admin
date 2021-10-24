<?php 

namespace App\Models\Entidades;

class Agendamento{
private $idAgendamento;
private $data;
private $hora;
private $Cliente_cpf;
private $Colaborador_cpf;
private $Servico_idServico;


public function getIdAgendamento(){
    return $this->idAgendamento;
}

public function setIdAgendamento($idAgendamento){
    $this->idAgendamento = $idAgendamento;
}

public function getData(){
    return $this->data;
}

public function setData($data){
    $this->data = $data;
}

public function getHora(){
    return $this->hora;
}

public function setHora($hora){
    $this->hora = $hora;
}

public function getCliente_cpf(){
    return $this->Cliente_cpf;
}

public function setCliente_cpf($Cliente_cpf){
    $this->Cliente_cpf = $Cliente_cpf;
}

public function getColaborador_cpf(){
    return $this->Colaborador_cpf;
}

public function setColaborador_cpf($Colaborador_cpf){
    $this->Colaborador_cpf = $Colaborador_cpf;
}

public function getServico_idServico(){
    return $this->Servico_idServico;
}

public function setServico_idServico($Servico_idServico){
    $this->Servico_idServico = $Servico_idServico;
}

}
?>