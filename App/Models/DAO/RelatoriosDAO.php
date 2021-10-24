<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cliente;
use App\Models\Entidades\Agendamento;

class RelatoriosDAO extends BaseDAO
{
    public function listarClientes($cpf = null)
    {
        if ($cpf) {
            $resultado = $this->select(
                "SELECT * FROM cliente WHERE cpf = $cpf"
            );

            return $resultado->fetchObject(Cliente::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM cliente WHERE cpf != 9999 ORDER BY nome ASC'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Cliente::class);
        }

        return false;
    }

    public function listarAgendamentos()
    {
        $resultado = $this->select(
            "select * from agendamento WHERE Cliente_cpf != 9999 ORDER BY data, hora ASC"
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Agendamento::class);
    }

    public function listarAgendamentosPorData($de,$ate)
    {
            
                $resultado = $this->select(
                    "select * from agendamento WHERE Cliente_cpf != 9999 AND data between '$de' AND '$ate'"
                );
                return $resultado->fetchAll(\PDO::FETCH_CLASS, Agendamento::class);
    }
    
}
