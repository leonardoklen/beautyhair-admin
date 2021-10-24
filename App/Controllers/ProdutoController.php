<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ProdutoDAO;
use App\Models\DAO\FornecedorDAO;
use App\Models\Entidades\Produto;
use App\Models\Validacao\ProdutoValidador;

class ProdutoController extends Controller
{
    //Dentro de um Controller, cada método público é em geral uma ação
    public function index()
    {
        $produtoDAO = new ProdutoDAO();

        self::setViewParam('listaProdutos', $produtoDAO->listar());

        $fornecedorDAO = new FornecedorDAO();

        $fornecedor = $fornecedorDAO->listar();

        self::setViewParam('listaFornecedores', $fornecedor);

        $this->render('/produto/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $fornecedorDAO = new FornecedorDAO();

        self::setViewParam('listaFornecedores', $fornecedorDAO->listar());

        $this->render('/produto/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $produto = new Produto();
        $produto->setNome($_POST['nome']);
        $produto->setQuantidadeEstoque($_POST['quantidadeEstoque']);
        $produto->setFornecedor_cnpj($_POST['fornecedor']);

        Sessao::gravaFormulario($_POST);

        $produtoValidador = new ProdutoValidador();
        $resultadoValidacao = $produtoValidador->validar($produto);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/produto/cadastro');
        }

        $produtoDAO = new ProdutoDAO();

        $produtoDAO->salvar($produto);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/produto');
    }

    public function edicao($params)
    {
        $idProduto = $params[0];

        $produtoDAO = new ProdutoDAO();

        $produto = $produtoDAO->listar($idProduto);

        if (!$produto) {
            Sessao::gravaMensagem("Produto inexistente");
            $this->redirect('/produto');
        }

        self::setViewParam('produto', $produto);

        $fornecedorDAO = new FornecedorDAO();

        $fornecedor = $fornecedorDAO->listar();

        self::setViewParam('listaFornecedores', $fornecedor);

        $this->render('/produto/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $produto = new Produto();
        $produto->setIdProduto($_POST['idProduto']);
        $produto->setNome($_POST['nome']);
        $produto->setQuantidadeEstoque($_POST['quantidadeEstoque']);
        $produto->setFornecedor_cnpj($_POST['fornecedor']);

        Sessao::gravaFormulario($_POST);

        $produtoValidador = new ProdutoValidador();
        $resultadoValidacao = $produtoValidador->validar($produto);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/produto/edicao/' . $_POST['id']);
        }

        $produtoDAO = new ProdutoDAO();

        $produtoDAO->atualizar($produto);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/produto');
    }

    public function excluir()
    {
        $produto = new Produto();
        $produto->setIdProduto($_POST['idProduto']);

        $produtoDAO = new ProdutoDAO();

        if (!$produtoDAO->excluir($produto)) {
            Sessao::gravaMensagem("Produto inexistente");
            $this->redirect('/produto');
        }

        Sessao::gravaMensagem("Produto excluído com sucesso!");

        $this->redirect('/produto');
    }
}
