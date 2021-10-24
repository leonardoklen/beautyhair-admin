<?php

namespace App\Models\DAO;

use App\Models\Entidades\Campanha;

class CampanhaDAO extends BaseDAO
{
    public function listar($idCampanha = null)
    {
        if ($idCampanha) {
            $resultado = $this->select(
                "SELECT * FROM campanha WHERE idCampanha = $idCampanha"
            );

            return $resultado->fetchObject(Campanha::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM campanha'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Campanha::class);
        }

        return false;
    }

    public function listarEmails()
    {
        return $this->select('SELECT * FROM cliente');
    }

    public function salvar(Campanha $campanha)
    {
        try {

            $descricao = $campanha->getDescricao();
            $de = $campanha->getDe();
            $ate = $campanha->getAte();
            $desconto = $campanha->getDesconto();
            $formaPagamento = $campanha->getFormaPagamento();
            $situacao = $campanha->getSituacao();

            $this->insert(
                'campanha',
                ":descricao, :de, :ate, :desconto, :formaPagamento, :situacao",
                [
                    ':descricao' => $descricao,
                    ':de' => $de,
                    ':ate' => $ate,
                    ':desconto' => $desconto,
                    ':formaPagamento' => $formaPagamento,
                    ':situacao' => $situacao,
                ]
            );

            foreach ($this->select("select idCampanha from campanha where idCampanha = (select max(idCampanha) from campanha)") as $row) {
                return $row['idCampanha'];
            }
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", $e);
        }
    }

    public function salvarServicoHasCampanha($idServico, Campanha $campanha)
    {
        try {

            $Servico_idServico = $idServico;
            $Campanha_idCampanha = $campanha->getIdCampanha();

            return $this->insert(
                'servico_has_campanha',
                ":Servico_idServico, :Campanha_idCampanha",
                [
                    ':Servico_idServico' => $Servico_idServico,
                    ':Campanha_idCampanha' => $Campanha_idCampanha,
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", $e);
        }
    }


    public function excluir(Campanha $campanha)
    {
        try {
            $idCampanha = $campanha->getIdCampanha();

            $this->delete('servico_has_campanha', 'Campanha_idCampanha', $idCampanha);

            return $this->delete('campanha', 'idCampanha', $idCampanha);
        } catch (\Exception $e) {
            throw new \Exception("Erro na exclusão de dados.", 500);
        }
    }

    public function quantidade()
    {
            $resultado = $this->select(
                "SELECT * FROM campanha"
            );

        return $resultado->rowCount();
    }
}
