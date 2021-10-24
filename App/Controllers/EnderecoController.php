<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EnderecoDAO;
use App\Models\Entidades\Endereco;
use App\Models\Validacao\EnderecoValidador;


class EnderecoController extends Controller
{
    public function __construct(){}

    //Dentro de um Controller, cada método público é em geral uma ação
    public function salvar()
    {
        $cidadeController = new CidadeController();

        $endereco = new Endereco();
        $endereco->setCep($this->limpaCaracteres($_POST['cep']));
        $endereco->setLogradouro($_POST['logradouro']);
        $endereco->setNumero($_POST['numero']);
        $endereco->setBairro($_POST['bairro']);
        $endereco->setComplemento($_POST['complemento']);
        
        $cidade = $cidadeController->findIdCidade($_POST['cidade']);
        
        $endereco->setCidade_idCidade($cidade->getIdCidade());

        Sessao::gravaFormulario($_POST);

        $enderecoValidador = new EnderecoValidador();
        $resultadoValidacao = $enderecoValidador->validar($endereco);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
        }

        $enderecoDAO = new EnderecoDAO();

        $endereco->setIdEndereco($enderecoDAO->salvar($endereco));

        return $endereco;

    }

    public function atualizar()
    {

        $endereco = new Endereco();
        $endereco->setIdEndereco($_POST['idEndereco']);
        $endereco->setCep($_POST['cep']);
        $endereco->setLogradouro($_POST['logradouro']);
        $endereco->setNumero($_POST['numero']);
        $endereco->setBairro($_POST['bairro']);
        $endereco->setComplemento($_POST['complemento']);

        $cidadeController = new CidadeController();

        $cidade = $cidadeController->findIdCidade($_POST['cidade']);

        $idCidade = $cidade->getIdCidade();

        $endereco->setCidade_idCidade($idCidade);

        Sessao::gravaFormulario($_POST);

        $enderecoValidador = new EnderecoValidador();
        $resultadoValidacao = $enderecoValidador->validar($endereco);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/colaborador/edicao/' . $_POST['cpf']);
        }

        $enderecoDAO = new EnderecoDAO();

        $enderecoDAO->atualizar($endereco);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

    }

    public function excluir()
    {
        $endereco = new Endereco();
        $endereco->setIdEndereco($_POST['idEndereco']);

        $enderecoDAO = new EnderecoDAO();

        if (!$enderecoDAO->excluir($endereco)) {
            Sessao::gravaMensagem("Endereco inexistente");
            $this->redirect('/home');
        }

        Sessao::gravaMensagem("Endereco excluído com sucesso!");

        $this->redirect('/home');
    }
}
