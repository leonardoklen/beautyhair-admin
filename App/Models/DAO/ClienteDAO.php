<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cliente;

class ClienteDAO extends BaseDAO
{
    public function quantidade()
    {
            $resultado = $this->select(
                "SELECT * FROM cliente WHERE cpf != 9999"
            );

        return $resultado->rowCount();
    }

    public function listar(){
        $resultado = $this->select(
            "SELECT * FROM cliente WHERE cpf != 9999"
        );

    return $resultado->fetchAll(\PDO::FETCH_CLASS, Cliente::class);
    }

}
