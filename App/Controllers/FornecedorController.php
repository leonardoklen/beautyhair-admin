<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\FornecedorDAO;
use App\Models\DAO\EnderecoDAO;
use App\Models\DAO\CidadeDAO;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\Fornecedor;
use App\Models\Validacao\FornecedorValidador;

class FornecedorController extends Controller
{
    //Dentro de um Controller, cada método público é em geral uma ação
    public function index()
    {
        $fornecedorDAO = new FornecedorDAO();

        self::setViewParam('listaFornecedores', $fornecedorDAO->listar());

        $this->render('/fornecedor/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/fornecedor/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $enderecoController = new EnderecoController();
        $endereco = $enderecoController->salvar();

        $fornecedor = new Fornecedor();
        $fornecedor->setCnpj($this->limpaCaracteres($_POST['cnpj']));
        $fornecedor->setRazaoSocial($_POST['razaoSocial']);
        $fornecedor->setNomeFantasia($_POST['nomeFantasia']);
        $fornecedor->setNomeContato($_POST['nomeContato']);
        $fornecedor->setTelefoneFixo($this->limpaCaracteres($_POST['telefoneFixo']));
        $fornecedor->setTelefoneCelular($this->limpaCaracteres($_POST['telefoneCelular']));
        $fornecedor->setEndereco_idEndereco($endereco->getIdEndereco());
        $fornecedor->setEmpresa_cnpj(13810495000166);

        Sessao::gravaFormulario($_POST);

        $fornecedorValidador = new FornecedorValidador();
        $resultadoValidacao = $fornecedorValidador->validar($fornecedor);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/fornecedor/cadastro');
        }

        $resultadoValidacao = $fornecedorValidador->validarCnpj($fornecedor);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/fornecedor/cadastro');
        }

        $fornecedorDAO = new FornecedorDAO();

        $fornecedorDAO->salvar($fornecedor);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/fornecedor');
    }

    public function edicao($params)
    {
        $id = $params[0];

        $fornecedorDAO = new FornecedorDAO();

        $fornecedor = $fornecedorDAO->listar($id);

        if (!$fornecedor) {
            Sessao::gravaMensagem("Fornecedor inexistente");
            $this->redirect('/fornecedor');
        }

        self::setViewParam('fornecedor', $fornecedor);

        $idEndereco = $fornecedor->getEndereco_idEndereco();

        $enderecoDAO = new EnderecoDAO();

        $endereco = $enderecoDAO->listar($idEndereco);

        if (!$endereco) {
            Sessao::gravaMensagem("Endereço inexistente");
            $this->redirect('/fornecedor');
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

        $this->render('/fornecedor/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $enderecoController = new EnderecoController();
        $enderecoController->atualizar();

        $fornecedor = new Fornecedor();
        $fornecedor->setCnpj($this->limpaCaracteres($_POST['cnpj']));
        $fornecedor->setRazaoSocial($_POST['razaoSocial']);
        $fornecedor->setNomeFantasia($_POST['nomeFantasia']);
        $fornecedor->setNomeContato($_POST['nomeContato']);
        $fornecedor->setTelefoneFixo($this->limpaCaracteres($_POST['telefoneFixo']));
        $fornecedor->setTelefoneCelular($this->limpaCaracteres($_POST['telefoneCelular']));
        $fornecedor->setEndereco_idEndereco($_POST['idEndereco']);
        $fornecedor->setEmpresa_cnpj(13810495000166);

        Sessao::gravaFormulario($_POST);

        $fornecedorValidador = new FornecedorValidador();
        $resultadoValidacao = $fornecedorValidador->validar($fornecedor);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/fornecedor/edicao/' . $_POST['cnpj']);
        }

        $fornecedorDAO = new FornecedorDAO();

        $fornecedorDAO->atualizar($fornecedor);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/fornecedor');
    }

    public function excluir()
    {
        $fornecedorDAO = new FornecedorDAO();
        $fornecedor = $fornecedorDAO->listar($this->limpaCaracteres($_POST['cnpj']));

        if (!$fornecedorDAO->excluir($fornecedor)) {
            Sessao::gravaMensagem("Fornecedor inexistente");
            $this->redirect('/fornecedor');
        }

        $enderecoDAO = new EnderecoDAO();
        $endereco = $enderecoDAO->listar($fornecedor->getEndereco_idEndereco());

        if (!$enderecoDAO->excluir($endereco)){
            Sessao::gravaMensagem("Endereço do fornecedor inexistente");
            $this->redirect('/fornecedor');
        };

        Sessao::gravaMensagem("Fornecedor excluído com sucesso!");

        $this->redirect('/fornecedor');
    }
}
