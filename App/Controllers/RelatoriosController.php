<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\RelatoriosDAO;
use App\Models\DAO\ClienteDAO;
use App\Models\DAO\ColaboradorDAO;
use App\Models\DAO\ServicoDAO;

class RelatoriosController extends Controller
{
    //Dentro de um Controller, cada método público é em geral uma ação
    public function clientes()
    {
        $relatoriosDAO = new RelatoriosDAO();

        self::setViewParam('listaClientes', $relatoriosDAO->listarClientes());

        $this->render('/relatorios/clientes');

        Sessao::limpaMensagem();
    }

    public function agendamentos()
    {
        $this->render('/relatorios/agendamentos');

        Sessao::limpaMensagem();
    }
    
    public function filtrarAgendamentosPorData(){
        $de = $_POST['de'];
        $ate = $_POST['ate'];

        $relatoriosDAO = new RelatoriosDAO();
        $listaAgenda = $relatoriosDAO->listarAgendamentosPorData($de, $ate);

        $ClienteDAO = new ClienteDAO();
        $listaClientes = $ClienteDAO->listar();
        
        $ColaboradorDAO = new ColaboradorDAO();
        $listaColaboradores = $ColaboradorDAO->listar();

        $ServicoDAO = new ServicoDAO();
        $listaServicos = $ServicoDAO->listar();

        if (empty($listaAgenda)) {
                echo '<div class="alert alert-info col-md-12" role="alert">Nenhum agendamento encontrado neste período.</div>';
        }else{

                echo '<div class="container table-responsive">
                    <table class="table table-bordered">
                        <tr class="bg-secondary text-white row">
                            <td class="info col-md-1 text-center">ID</td>
                            <td class="info col-md-3 text-center">Cliente</td>
                            <td class="info col-md-3 text-center">Colaborador</td>
                            <td class="info col-md-2 text-center">Serviço</td>
                            <td class="info col-md-2 text-center">Data</td>
                            <td class="info col-md-1 text-center">Hora</td>
                        </tr>';
                        
                        foreach ($listaAgenda as $agenda) {
                            echo '<tr class="bg-light row">

                                <td class="col-md-1 text-center">'; echo $agenda->getIdAgendamento(); echo '</td>';
                                foreach ($listaClientes as $cliente) {
                                    if ($cliente->getCpf() == $agenda->getCliente_cpf()) {
                                        echo '<td class="col-md-3 text-center">'; echo $cliente->getNome(); echo '</td>';
                                    }
                                }
                                foreach ($listaColaboradores as $colaborador) {
                                    if ($colaborador->getCpf() == $agenda->getColaborador_cpf()) {
                                        echo '<td class="col-md-3 text-center">'; echo $colaborador->getNome(); echo '</td>';
                                    }
                                }
                                foreach ($listaServicos as $servico) {
                                    if ($servico->getIdServico() == $agenda->getServico_idServico()) {
                                        echo '<td class="col-md-2 text-center">'; echo $servico->getNome(); echo '</td>';
                                    }
                                }

                                echo '<td class="col-md-2 text-center">'; echo date('d/m/Y', strtotime($agenda->getData())); echo '</td>
                                <td class="col-md-1 text-center">'; echo $agenda->getHora(); echo ':00h</td>
                            </tr>';
                        }
                    echo '</table>
                </div>';
            }
            
    }

}