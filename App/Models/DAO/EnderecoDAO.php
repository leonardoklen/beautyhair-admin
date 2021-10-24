<?php

namespace App\Models\DAO;

use App\Models\Entidades\Endereco;

class EnderecoDAO extends BaseDAO
{
    public function listar($id = null)
    {
        if ($id) {
            $resultado = $this->select(
                "SELECT * FROM endereco WHERE idEndereco = $id"
            );

            return $resultado->fetchObject(Endereco::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM endereco'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Endereco::class);
        }
    }

    public function salvar(Endereco $endereco)
    {
        try {

            $cep = $endereco->getCep();
            $logradouro = $endereco->getLogradouro();
            $numero = $endereco->getNumero();
            $bairro = $endereco->getBairro();
            $complemento = $endereco->getComplemento();
            $Cidade_idCidade = $endereco->getCidade_idCidade();

            $this->insert(
                'endereco',
                ":cep, :logradouro, :numero, :bairro, :complemento, :Cidade_idCidade",
                [
                    ':cep' => $cep,
                    ':logradouro' => $logradouro,
                    ':numero' => $numero,
                    ':bairro' => $bairro,
                    ':complemento' => $complemento,
                    ':Cidade_idCidade' => $Cidade_idCidade
                ]
                );

            foreach($this->select("select idEndereco from endereco where idEndereco = (select max(idEndereco) from endereco)") as $row){
                return $row['idEndereco'];
            };

        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function atualizar(Endereco $endereco)
    {
        try {

            $idEndereco = $endereco->getIdEndereco();
            $cep = $endereco->getCep();
            $logradouro = $endereco->getLogradouro();
            $numero = $endereco->getNumero();
            $bairro = $endereco->getBairro();
            $complemento = $endereco->getComplemento();
            $Cidade_idCidade = $endereco->getCidade_idCidade();

            return $this->update(
                'endereco',
                "cep = :cep, logradouro = :logradouro, numero = :numero, bairro = :bairro, complemento = :complemento, Cidade_idCidade = :Cidade_idCidade",
                [
                    ':idEndereco' => $idEndereco,
                    ':cep' => $cep,
                    ':logradouro' => $logradouro,
                    ':numero' => $numero,
                    ':bairro' => $bairro,
                    ':complemento' => $complemento,
                    ':Cidade_idCidade' => $Cidade_idCidade
                ],
                "idEndereco = :idEndereco"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro na atualização de dados.", 500);
        }
    }

    public function excluir(Endereco $endereco)
    {
        try {
            $id = $endereco->getIdEndereco();

            return $this->delete('endereco', 'idEndereco', $id);

        } catch (\Exception $e) {
            throw new \Exception("Erro na exclusão de dados.", 500);
        }
    }
}
