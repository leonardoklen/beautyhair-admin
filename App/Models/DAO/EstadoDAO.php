<?php

namespace App\Models\DAO;

use App\Models\Entidades\Estado;

class EstadoDAO extends BaseDAO
{
    public function listar($idEstado, $sigla = null)
    {
        if ($sigla) {
            $resultado = $this->select(
                "SELECT * FROM estado WHERE sigla = '$sigla'"
            );

            return $resultado->fetchObject(Estado::class);
        }else if($idEstado){
            $resultado = $this->select(
                "SELECT * FROM estado WHERE idEstado = $idEstado"
            );

            return $resultado->fetchObject(Estado::class);
        }else {
            $resultado = $this->select(
                'SELECT * FROM estado'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Estado::class);
        }
    }

}
