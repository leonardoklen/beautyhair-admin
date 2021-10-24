<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Fornecedor;
use App\Models\DAO\FornecedorDAO;

class FornecedorValidador{

    public function validar(Fornecedor $fornecedor)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($fornecedor->getCnpj()))
        {
            $resultadoValidacao->addErro('cnpj',"Cnpj: este campo não pode ser vazio");
        }

        if(empty($fornecedor->getRazaoSocial()))
        {
            $resultadoValidacao->addErro('razaoSocial',"Razão Social: este campo não pode ser vazio");
        }

        if(empty($fornecedor->getNomeFantasia()))
        {
            $resultadoValidacao->addErro('nomeFantasia',"Nome Fantasia: este campo não pode ser vazio");
        }

        if(empty($fornecedor->getNomeContato()))
        {
            $resultadoValidacao->addErro('nomeContato',"Nome Contato: este campo não pode ser vazio");
        }

        if(empty($fornecedor->getTelefoneFixo()))
        {
            $resultadoValidacao->addErro('telefoneFixo',"Telefone Fixo: este campo não pode ser vazio");
        }

        if(empty($fornecedor->getTelefoneCelular()))
        {
            $resultadoValidacao->addErro('telefoneCelular',"Telefone Celular: este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }

    public function validarCnpj(Fornecedor $fornecedor){
        $resultadoValidacao = new ResultadoValidacao();

        $fornecedorDAO = new FornecedorDAO();

        if(!empty($fornecedorDAO->listar($fornecedor->getCnpj()))){
            $resultadoValidacao->addErro('cnpj',"CNPJ já existe na base de dados.");
        }

        return $resultadoValidacao;
    }
}