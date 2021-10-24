<?php

namespace App\Models\DAO;

use App\Models\Entidades\Produto;

class ProdutoDAO extends BaseDAO
{
    public function listar($idProduto = null)
    {
        if ($idProduto) {
            $resultado = $this->select(
                "SELECT * FROM produto WHERE idProduto = $idProduto"
            );

            return $resultado->fetchObject(Produto::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM produto ORDER BY nome ASC'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Produto::class);
        }

        return false;
    }

    public function salvar(Produto $produto)
    {
        try {

            $nome = $produto->getNome();
            $quantidadeEstoque = $produto->getQuantidadeEstoque();
            $Fornecedor_cnpj = $produto->getFornecedor_cnpj();

            return $this->insert(
                'produto',
                ":nome, :quantidadeEstoque, :Fornecedor_cnpj",
                [
                    ':nome' => $nome,
                    ':quantidadeEstoque' => $quantidadeEstoque,
                    ':Fornecedor_cnpj' => $Fornecedor_cnpj,
                ]
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
            
        }
    }

    public function atualizar(Produto $produto)
    {
        try {

            $idProduto = $produto->getIdProduto();
            $nome = $produto->getNome();
            $quantidadeEstoque = $produto->getQuantidadeEstoque();
            $Fornecedor_cnpj = $produto->getFornecedor_cnpj();   

            return $this->update(
                'produto',
                "nome = :nome, quantidadeEstoque = :quantidadeEstoque, Fornecedor_cnpj = :Fornecedor_cnpj",
                [
                    ':idProduto' => $idProduto,
                    ':nome' => $nome,
                    ':quantidadeEstoque' => $quantidadeEstoque,
                    ':Fornecedor_cnpj' => $Fornecedor_cnpj,
                ],
                "idProduto = :idProduto"
            );

        } catch (\Exception $e) {
            throw new \Exception($e);
            
        }
    }

    public function excluir(Produto $produto)
    {
        try {
            $idProduto = $produto->getIdProduto();

            $this->delete('produto_has_servico', 'Produto_idProduto', $idProduto);

            return $this->delete('produto', 'idProduto', $idProduto);

        } catch (\Exception $e) {
            throw new \Exception("Erro na exclusão de dados.", 500);
        }
    }

    public function quantidade()
    {
            $resultado = $this->select(
                "SELECT * FROM produto"
            );

        return $resultado->rowCount();
    }


}

