<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ColaboradorDAO;
use App\Models\DAO\EnderecoDAO;
use App\Models\DAO\CidadeDAO;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\Colaborador;
use App\Models\Validacao\ColaboradorValidador;


class ColaboradorController extends Controller
{
    //Dentro de um Controller, cada método público é em geral uma ação
    public function index()
    {
        $colaboradorDAO = new ColaboradorDAO();

        self::setViewParam('listaColaboradores', $colaboradorDAO->listar());

        $this->render('/colaborador/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {

        $this->render('/colaborador/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $enderecoController = new EnderecoController();
        $endereco = $enderecoController->salvar();

        $colaborador = new Colaborador();
        $colaborador->setCpf($this->limpaCaracteres($_POST['cpf']));
        $colaborador->setNome($_POST['nome']);
        $colaborador->setSexo($_POST['sexo']);
        $colaborador->setTelefone($this->limpaCaracteres($_POST['telefone']));
        $colaborador->setLogin($_POST['login']);
        $colaborador->setSenha($_POST['senha']);
        $colaborador->setEmpresa_cnpj(13810495000166);
        $colaborador->setEndereco_idEndereco($endereco->getIdEndereco());

        Sessao::gravaFormulario($_POST);

        $colaboradorValidador = new ColaboradorValidador();
        $resultadoValidacao = $colaboradorValidador->validar($colaborador, $_POST['confirmarSenha']);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/colaborador/cadastro');
        }

        $resultadoValidacao = $colaboradorValidador->validarCpf($colaborador);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/colaborador/cadastro');
        }

        $colaboradorDAO = new ColaboradorDAO();

        $colaboradorDAO->salvar($colaborador);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/colaborador');
    }

    public function edicao($params)
    {
        $cpf = $params[0];

        $colaboradorDAO = new ColaboradorDAO();

        $colaborador = $colaboradorDAO->listar($cpf);

        if (!$colaborador) {
            Sessao::gravaMensagem("Colaborador inexistente");
            $this->redirect('/colaborador');
        }

        self::setViewParam('colaborador', $colaborador);

        $idEndereco = $colaborador->getEndereco_idEndereco();

        $enderecoDAO = new EnderecoDAO();

        $endereco = $enderecoDAO->listar($idEndereco);

        if (!$endereco) {
            Sessao::gravaMensagem("Endereco inexistente");
            $this->redirect('/colaborador');
        }

        self::setViewParam('endereco', $endereco);

        $idCidade = $endereco->getCidade_idCidade();

        $cidadeDAO = new CidadeDAO();

        $cidade = $cidadeDAO->listar($idCidade, null, null);

        if (!$cidade) {
            Sessao::gravaMensagem("Cidade inexistente");
            $this->redirect('/colaborador');
        }

        self::setViewParam('cidade', $cidade);

        $idEstado = $cidade->getEstado_idEstado();

        $estadoDAO = new EstadoDAO();

        $estado = $estadoDAO->listar($idEstado, null);

        if (!$estado) {
            Sessao::gravaMensagem("Estado inexistente");
            $this->redirect('/colaborador');
        }

        self::setViewParam('estado', $estado);

        $this->render('/colaborador/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $enderecoController = new EnderecoController();
        $enderecoController->atualizar();

        $colaborador = new Colaborador();
        $colaborador->setCpf($this->limpaCaracteres($_POST['cpf']));
        $colaborador->setNome($_POST['nome']);
        $colaborador->setSexo($_POST['sexo']);
        $colaborador->setTelefone($this->limpaCaracteres($_POST['telefone']));
        $colaborador->setLogin($_POST['login']);
        $colaborador->setSenha($_POST['senha']);
        $colaborador->setEmpresa_cnpj(13810495000166);
        $colaborador->setEndereco_idEndereco($_POST['idEndereco']);

        
        Sessao::gravaFormulario($_POST);

        $colaboradorValidador = new ColaboradorValidador();
        $resultadoValidacao = $colaboradorValidador->validar($colaborador, $_POST['confirmarSenha']);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/colaborador/edicao/' . $_POST['cpf']);
        }

        $colaboradorDAO = new ColaboradorDAO();

        $colaboradorDAO->atualizar($colaborador);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/colaborador');
    }

    public function excluir()
    {
        $colaboradorDAO = new ColaboradorDAO();
        $colaborador = $colaboradorDAO->listar($this->limpaCaracteres($_POST['cpf']));

        if (!$colaboradorDAO->excluir($colaborador)) {
            Sessao::gravaMensagem("Colaborador inexistente");
            $this->redirect('/colaborador');
        }

        $enderecoDAO = new EnderecoDAO();
        $endereco = $enderecoDAO->listar($colaborador->getEndereco_idEndereco());

        if (!$enderecoDAO->excluir($endereco)){
            Sessao::gravaMensagem("Endereço do colaborador inexistente");
            $this->redirect('/colaborador');
        };

        Sessao::gravaMensagem("Colaborador excluído com sucesso!");

        $this->redirect('/colaborador');
    }

    public function folga()
    {

        $colaboradorDAO = new ColaboradorDAO();

        self::setViewParam('listaColaboradores', $colaboradorDAO->listar());

        self::setViewParam('listaFolgas', $colaboradorDAO->listarFolgas());

        $this->render('/colaborador/folga');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function folgar(){
        $cpfColaborador = $_POST['colaborador'];
        $data = $_POST['data'];

        Sessao::gravaFormulario($_POST);

        $colaboradorValidador = new ColaboradorValidador();
        $resultadoValidacao = $colaboradorValidador->validarFolga($cpfColaborador, $data);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/colaborador/folga');
        }

        $colaboradorDAO = new ColaboradorDAO();

        $colaboradorDAO->folgar($cpfColaborador, $data);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Folga agendada com sucesso!");

        $this->redirect('/colaborador/folga');
    }

    public function excluirFolga($params){
        $cpf = $params[0];
        $data = $params[1];

        $colaboradorDAO = new ColaboradorDAO();

        $colaboradorDAO->excluirFolga($cpf, $data);

        Sessao::gravaMensagem("Folga excluída com sucesso!");

        $this->redirect('/colaborador/folga');
    }
    
}