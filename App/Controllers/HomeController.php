<?php

namespace App\Controllers;

use App\Models\DAO\ColaboradorDAO;
use App\Models\DAO\ClienteDAO;
use App\Models\DAO\AgendamentoDAO;
use App\Models\DAO\FornecedorDAO;
use App\Models\DAO\ProdutoDAO;
use App\Models\DAO\ServicoDAO;
use App\Models\DAO\CampanhaDAO;

class HomeController extends Controller
{
    public function index()
    {
        $colaboradorDAO = new ColaboradorDAO();
        $clienteDAO = new ClienteDAO();
        $agendamentoDAO = new AgendamentoDAO();
        $fornecedorDAO = new FornecedorDAO();
        $produtoDAO = new ProdutoDAO();
        $servicoDAO = new ServicoDAO();
        $campanhaDAO = new CampanhaDAO();

        self::setViewParam('quantidadeColaboradores', $colaboradorDAO->quantidade());
        self::setViewParam('quantidadeClientes', $clienteDAO->quantidade());
        self::setViewParam('quantidadeAgendamentos', $agendamentoDAO->quantidade());
        self::setViewParam('quantidadeFornecedores', $fornecedorDAO->quantidade());
        self::setViewParam('quantidadeProdutos', $produtoDAO->quantidade());
        self::setViewParam('quantidadeServicos', $servicoDAO->quantidade());
        self::setViewParam('quantidadeCampanhas', $campanhaDAO->quantidade());

        $this->render('home/index');
    }
}
