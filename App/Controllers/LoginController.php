<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ColaboradorDAO;
use App\Models\Entidades\Colaborador;
use App\Models\Validacao\ColaboradorValidador;


class LoginController extends Controller
{
    //Dentro de um Controller, cada método público é em geral uma ação
    public function index()
    {

        if ($_SESSION['usuarioAdmin']) {
            header('Location: http://' . APP_HOST . '/home/index');
            exit;
        } else {
            require_once PATH . '/App/Views/layouts/cabecalho.php';
            require_once PATH . '/App/Views/login/index.php';
            require_once PATH . '/App/Views/layouts/rodape.php';
        }

        Sessao::limpaMensagem();
    }

    public function logar()
    {

        $colaborador = new Colaborador();
        $colaborador->setLogin($_POST['login']);
        $colaborador->setSenha($_POST['senha']);
        $colaborador->setCpf($_POST['cpf']);

        Sessao::gravaFormulario($_POST);

        $colaboradorValidador = new ColaboradorValidador();
        $resultadoValidacao = $colaboradorValidador->validarLogin($colaborador);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/login/index');
        }

        $colaboradorDAO = new ColaboradorDAO();

        $newColaborador = $colaboradorDAO->validarLogin($colaborador);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        if ($newColaborador!=false) {
            Sessao::criarSessao('usuarioAdmin', $newColaborador->getNome());
            Sessao::criarSessao('cpfColaborador', $newColaborador->getCpf());
            $this->redirect('/home/index');
        } else {
            Sessao::criarSessao('nao_autenticado', true);
            $this->redirect('/login/index');
        }
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['usuarioAdmin']);
        $this->redirect('/login/index');
    }
}
