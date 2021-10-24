<?php

namespace App\Models\DAO;

use App\Models\Entidades\Fornecedor;
use App\Models\Entidades\Produto;
use App\Models\DAO\ProdutoDAO;

class FornecedorDAO extends BaseDAO
{
    public function listar($cnpj = null)
    {
        if ($cnpj) {
            $resultado = $this->select(
                "SELECT * FROM fornecedor WHERE cnpj = $cnpj"
            );

            return $resultado->fetchObject(Fornecedor::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM fornecedor ORDER BY razaosocial ASC'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Fornecedor::class);
        }

        return false;
    }

    public function salvar(Fornecedor $fornecedor)
    {
        try {

            $cnpj = $fornecedor->getCnpj();
            $razaoSocial = $fornecedor->getRazaoSocial();
            $nomeFantasia = $fornecedor->getNomeFantasia();
            $nomeContato = $fornecedor->getNomeContato();
            $telefoneFixo = $fornecedor->getTelefoneFixo();
            $telefoneCelular = $fornecedor->getTelefoneCelular();
            $Endereco_idEndereco = $fornecedor->getEndereco_idEndereco();
            $Empresa_cnpj = $fornecedor->getEmpresa_cnpj();

            return $this->insert(
                'fornecedor',
                ":cnpj, :razaoSocial, :nomeFantasia, :nomeContato, :telefoneFixo, :telefoneCelular, :Endereco_idEndereco, :Empresa_cnpj",
                [
                    ':cnpj' => $cnpj,
                    ':razaoSocial' => $razaoSocial,
                    ':nomeFantasia' => $nomeFantasia,
                    ':nomeContato' => $nomeContato,
                    ':telefoneFixo' => $telefoneFixo,
                    ':telefoneCelular' => $telefoneCelular,
                    ':Endereco_idEndereco' => $Endereco_idEndereco,
                    ':Empresa_cnpj' => $Empresa_cnpj,
                ]
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
            
        }
    }

    public function atualizar(Fornecedor $fornecedor)
    {
        try {

            $cnpj = $fornecedor->getCnpj();
            $razaoSocial = $fornecedor->getRazaoSocial();
            $nomeFantasia = $fornecedor->getNomeFantasia();
            $nomeContato = $fornecedor->getNomeContato();
            $telefoneFixo = $fornecedor->getTelefoneFixo();
            $telefoneCelular = $fornecedor->getTelefoneCelular();
            $Endereco_idEndereco = $fornecedor->getEndereco_idEndereco();
            $Empresa_cnpj = $fornecedor->getEmpresa_cnpj();        

            return $this->update(
                'fornecedor',
                "razaoSocial = :razaoSocial, nomeFantasia = :nomeFantasia, nomeContato = :nomeContato, telefoneFixo = :telefoneFixo, telefoneCelular = :telefoneCelular, Endereco_idEndereco = :Endereco_idEndereco, Empresa_cnpj = :Empresa_cnpj",
                [
                    ':cnpj' => $cnpj,
                    ':razaoSocial' => $razaoSocial,
                    ':nomeFantasia' => $nomeFantasia,
                    ':nomeContato' => $nomeContato,
                    ':telefoneFixo' => $telefoneFixo,
                    ':telefoneCelular' => $telefoneCelular,
                    ':Endereco_idEndereco' => $Endereco_idEndereco,
                    ':Empresa_cnpj' => $Empresa_cnpj, 
                ],
                "cnpj = :cnpj"
            );

        } catch (\Exception $e) {
            throw new \Exception($e);
            
        }
    }

    public function excluir(Fornecedor $fornecedor)
    {
        try {
            $cnpj = $fornecedor->getCnpj();

            $idProdutos = $this->select("select idProduto from produto where Fornecedor_cnpj = $cnpj");

            foreach($idProdutos as $idProduto){
                $this->delete('produto_has_servico', 'Produto_idProduto', $idProduto['idProduto']);
            }

            $this->delete('produto', 'Fornecedor_cnpj', $cnpj);

            return $this->delete('fornecedor', 'cnpj', $cnpj);

        } catch (\Exception $e) {
            throw new \Exception($e);       }
    }

    public function quantidade()
    {
            $resultado = $this->select(
                "SELECT * FROM fornecedor"
            );

        return $resultado->rowCount();
    }


}

