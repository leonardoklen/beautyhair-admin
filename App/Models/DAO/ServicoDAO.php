<?php

namespace App\Models\DAO;

use App\Models\Entidades\Servico;
use App\Models\Entidades\ProdutoHasServico;

class ServicoDAO extends BaseDAO
{
    public function listar($idServico = null)
    {
        if ($idServico) {
            $resultado = $this->select(
                "SELECT * FROM servico WHERE idServico = $idServico"
            );

            return $resultado->fetchObject(Servico::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM servico WHERE idServico != 9999 ORDER BY nome ASC'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Servico::class);
        }

        return false;
    }

    public function listarProdutoHasServico($idServico = null, $idProduto = null)
    {
        if ($idServico and !$idProduto) {
            $resultado = $this->select(
                "SELECT * FROM produto_has_servico WHERE Servico_idServico = $idServico"
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, ProdutoHasServico::class);
        } else if ($idServico and $idProduto) {
            $resultado = $this->select(
                "SELECT * FROM produto_has_servico WHERE Produto_idProduto = $idProduto AND Servico_idServico = $idServico"
            );

            return $resultado->rowCount();
        } else {
            return false;
        }
    }

    public function salvar(Servico $servico)
    {
        try {

            $nome = $servico->getNome();
            $preco = $servico->getPreco();

            $this->insert(
                'servico',
                ":nome, :preco",
                [
                    ':nome' => $nome,
                    ':preco' => $preco,
                ]
            );

            foreach ($this->select("select idServico from servico where idServico = (select max(idServico) from servico)") as $row) {
                return $row['idServico'];
            }
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function salvarProdutoHasServico($idProduto, Servico $servico, $quantidadeProdutoUtilizado)
    {
        try {

            $idServico = $servico->getIdServico();

            return $this->insert(
                'produto_has_servico',
                ":Produto_idProduto, :Servico_idServico, :quantidadeProdutoUtilizado",
                [
                    ':Produto_idProduto' => $idProduto,
                    ':Servico_idServico' => $idServico,
                    ':quantidadeProdutoUtilizado' => $quantidadeProdutoUtilizado,
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function atualizar(Servico $servico)
    {
        try {

            $idServico = $servico->getIdServico();
            $nome = $servico->getNome();
            $preco = $servico->getPreco();

            return $this->update(
                'servico',
                "nome = :nome, preco = :preco",
                [
                    ':idServico' => $idServico,
                    ':nome' => $nome,
                    ':preco' => $preco,
                ],
                "idServico = :idServico"
            );
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function excluir(Servico $servico)
    {
        try {
            $idServico = $servico->getIdServico();

            $this->delete('agendamento', 'Servico_idServico', $idServico);

            $this->delete('produto_has_servico', 'Servico_idServico', $idServico);

            $this->delete('servico_has_campanha', 'Servico_idServico', $idServico);

            return $this->delete('servico', 'idServico', $idServico);
        } catch (\Exception $e) {
            throw new \Exception("Erro na exclusão de dados.", 500);
        }
    }

    public function excluirProdutoHasServico(ProdutoHasServico $produtoHasServico)
    {
        try {
            $idProduto = $produtoHasServico->getProduto_idProduto();
            $idServico = $produtoHasServico->getServico_idServico();

            return $this->deleteNxN('produto_has_servico', 'Produto_idProduto', $idProduto, 'Servico_idServico', $idServico);
        } catch (\Exception $e) {
            throw new \Exception("Erro na exclusão de dados.", 500);
        }
    }

    public function quantidade()
    {
            $resultado = $this->select(
                "SELECT * FROM servico WHERE idServico != 9999"
            );

        return $resultado->rowCount();
    }
}
