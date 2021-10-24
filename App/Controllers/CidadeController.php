<?php

namespace App\Controllers;

use App\Models\DAO\CidadeDAO;
use App\Models\Entidades\Cidade;

class CidadeController extends Controller
{

    public function __construct(){}

    public function findIdCidade($nomeCidade)
    {
        $estadoController = new EstadoController();
        $estado = $estadoController->findIdEstado($_POST['uf']);
        $idEstado = $estado->getIdEstado();

        $cidadeDAO = new CidadeDAO();
        $nomeCidade = $_POST['cidade'];
        return $cidadeDAO->listar(null, $nomeCidade, $idEstado);

    }

}
