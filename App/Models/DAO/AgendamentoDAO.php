<?php

namespace App\Models\DAO;

use App\Models\Entidades\Agendamento;

class AgendamentoDAO extends BaseDAO
{
    public function listar($colaboradorCpf = null)
    {
        if ($colaboradorCpf) {
            $resultado = $this->select(
                "SELECT * FROM agendamento WHERE Cliente_cpf != 9999 AND Colaborador_cpf = $colaboradorCpf AND data >= CURDATE() ORDER BY data, hora ASC"
            );

            return $resultado->fetchAll(\PDO::FETCH_CLASS, Agendamento::class);
        } else {
            $resultado = $this->select(
                "select * from agendamento WHERE Cliente_cpf != 9999 and data >= CURDATE() ORDER BY data, hora ASC"
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Agendamento::class);
        }

        return false;
    }

    public function excluir(Agendamento $agendamento)
    {
        try {
            $idAgendamento = $agendamento->getIdAgendamento();

            return $this->delete('agendamento', 'idAgendamento', $idAgendamento);
        } catch (\Exception $e) {
            throw new \Exception("Erro na exclusão de dados.", 500);
        }
    }

    public function quantidade()
    {
            $resultado = $this->select(
                "SELECT * FROM agendamento WHERE Cliente_cpf != 9999"
            );

        return $resultado->rowCount();
    }
}
