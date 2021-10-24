<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cidade;

class CidadeDAO extends BaseDAO
{
    public function listar($idCidade, $nomeCidade, $idEstado = null)
    {
        if ($nomeCidade and $idEstado) {
            $resultado = $this->select(
                "SELECT * FROM cidade WHERE nome = '$nomeCidade' and Estado_idEstado = $idEstado"
            );

            return $resultado->fetchObject(Cidade::class);
        } else if($idCidade){
            $resultado = $this->select(
                "SELECT * FROM cidade WHERE idCidade = $idCidade"
            );

            return $resultado->fetchObject(Cidade::class);
        }else {
            $resultado = $this->select(
                'SELECT * FROM cidade'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Cidade::class);
        }
    }

}
