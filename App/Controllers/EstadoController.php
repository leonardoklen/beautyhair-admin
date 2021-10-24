<?php

namespace App\Controllers;

use App\Models\DAO\EstadoDAO;

class EstadoController extends Controller
{

    public function __construct(){}

    //Dentro de um Controller, cada método público é em geral uma ação

   public function findIdEstado($sigla){
       $estadoDAO = new EstadoDAO();
       return $estadoDAO->listar(null, $sigla);
   }
}
