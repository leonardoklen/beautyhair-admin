<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Colaborador;
use App\Models\DAO\ColaboradorDAO;

class ColaboradorValidador{

    public function validar(Colaborador $colaborador, $confirmarSenha)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($colaborador->getCpf()))
        {
            $resultadoValidacao->addErro('cpf',"CPF: Este campo não pode ser vazio");
        }

        if(empty($colaborador->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome completo: Este campo não pode ser vazio");
        }
        
        if(empty($colaborador->getTelefone()))
        {
            $resultadoValidacao->addErro('telefone',"Telefone: Este campo não pode ser vazio");
        }

        if(empty($colaborador->getSexo()))
        {
            $resultadoValidacao->addErro('sexo',"Sexo: Este campo não pode ser vazio");
        }

        if(empty($colaborador->getLogin()))
        {
            $resultadoValidacao->addErro('login',"Login: Este campo não pode ser vazio");
        }

        if(empty($colaborador->getSenha()))
        {
            $resultadoValidacao->addErro('senha',"Senha: Este campo não pode ser vazio");
        }

        if($colaborador->getSenha()!=$confirmarSenha)
        {
            $resultadoValidacao->addErro('senha',"Confirmação de senha: As senhas digitadas não coincidem");
        }

        return $resultadoValidacao;
    }

    public function validarLogin(Colaborador $colaborador){

        $resultadoValidacao = new ResultadoValidacao();

        if(empty($colaborador->getLogin()) || empty($colaborador->getSenha())){
            if(empty($colaborador->getLogin()) && !empty($colaborador->getSenha())){
                $resultadoValidacao->addErro('login',"Login: Este campo não pode ser vazio");
            }else if(empty($colaborador->getSenha()) && !empty($colaborador->getLogin())){
                $resultadoValidacao->addErro('senha',"Senha: Este campo não pode ser vazio");
            }else if(empty($colaborador->getLogin()) && empty($colaborador->getSenha())){
                $resultadoValidacao->addErro('login',"Login: Este campo não pode ser vazio");
                $resultadoValidacao->addErro('senha',"Senha: Este campo não pode ser vazio");
            }
        }

        return $resultadoValidacao;
    }

    public function validarCpf(Colaborador $colaborador){
        $resultadoValidacao = new ResultadoValidacao();

        $colaboradorDAO = new ColaboradorDAO();

        if(!empty($colaboradorDAO->listar($colaborador->getCpf()))){
            $resultadoValidacao->addErro('cpf',"CPF já existe na base de dados.");
        }

        return $resultadoValidacao;
    }

    public function validarFolga($cpfColaborador, $data){
        $resultadoValidacao = new ResultadoValidacao();

        $colaboradorDAO = new ColaboradorDAO();

        if($colaboradorDAO->validarFolga($cpfColaborador, $data)>0){
            $resultadoValidacao->addErro('data',"Colaborador possui agendamentos marcados para esta data.");
        }

        return $resultadoValidacao;
    }
}