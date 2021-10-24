<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ServicoDAO;
use App\Models\DAO\ProdutoDAO;
use App\Models\Entidades\Servico;
use App\Models\Validacao\ServicoValidador;
use App\Models\Entidades\ProdutoHasServico;

class ServicoController extends Controller
{
    //Dentro de um Controller, cada método público é em geral uma aç

    public function index()
    {
        $servicoDAO = new ServicoDAO();

        self::setViewParam('listaServicos', $servicoDAO->listar());

        $this->render('/servico/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {

        $produtoDAO = new ProdutoDAO();

        self::setViewParam('listaProdutos', $produtoDAO->listar());

        $this->render('/servico/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        /* Cadastrar Serviço */
        $servico = new Servico();
        $servico->setNome($_POST['nome']);
        $servico->setPreco($_POST['preco']);

        Sessao::gravaFormulario($_POST);

        $servicoValidador = new ServicoValidador();
        $resultadoValidacao = $servicoValidador->validar($servico);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/servico/cadastro');
        }

        $servicoDAO = new ServicoDAO();
        $servico->setIdServico($servicoDAO->salvar($servico));
        /* Cadastrar Serviço */

        /* Cadastrar produto_has_servico */
        $listaProdutos = json_decode($_POST['listaProdutos'], true);

        if (!empty($listaProdutos)) {
            foreach ($listaProdutos as $produto) {
                $idProduto = $produto['id'];
                $quantidadeUtilizada = $produto['quantidade'];
                $servicoDAO->salvarProdutoHasServico($idProduto, $servico, $quantidadeUtilizada);
            }
        }
        /* Cadastrar produto_has_servico */

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/servico');
    }

    public function salvarProdutoHasServico($params)
    {

        $servicoDAO = new ServicoDAO();

        $idProduto = $params[0];

        $servico = new Servico();
        $servico->setIdServico($params[1]);

        $quantidadeUtilizada = $params[2];

        if ($servicoDAO->listarProdutoHasServico($servico->getIdServico(), $idProduto) == 0) {
            if (!$servicoDAO->salvarProdutoHasServico($idProduto, $servico, $quantidadeUtilizada)) {
                Sessao::gravaMensagem("ERRO: produto não foi adicionado neste serviço. Contate o administrador do sistema.");
                $this->redirect('/servico');
            }
        }else{
            Sessao::gravaMensagem("Produto já está adicionado a este serviço!");
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/servico/edicao/' . $servico->getIdServico());
    }

    public function edicao($params)
    {
        $id = $params[0];

        $servicoDAO = new ServicoDAO();

        $servico = $servicoDAO->listar($id);

        $produtoHasServico = $servicoDAO->listarProdutoHasServico($id);

        if (!$servico) {
            Sessao::gravaMensagem("Servico inexistente");
            $this->redirect('/servico');
        }

        self::setViewParam('servico', $servico);

        self::setViewParam('produtoHasServico', $produtoHasServico);

        $produtoDAO = new ProdutoDAO();

        self::setViewParam('listaProdutos', $produtoDAO->listar());

        $this->render('/servico/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $servico = new Servico();
        $servico->setIdServico($_POST['idServico']);
        $servico->setNome($_POST['nome']);
        $servico->setPreco($_POST['preco']);

        Sessao::gravaFormulario($_POST);

        $servicoValidador = new ServicoValidador();
        $resultadoValidacao = $servicoValidador->validar($servico);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/servico/edicao/' . $_POST['id']);
        }

        $servicoDAO = new ServicoDAO();

        $servicoDAO->atualizar($servico);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/servico');
    }

    public function excluir()
    {
        $servico = new Servico();
        $servico->setIdServico($_POST['idServico']);

        $servicoDAO = new ServicoDAO();

        if (!$servicoDAO->excluir($servico)) {
            Sessao::gravaMensagem("Servico inexistente");
            $this->redirect('/servico');
        }

        Sessao::gravaMensagem("Servico excluído com sucesso!");

        $this->redirect('/servico');
    }

    public function excluirProdutoHasServico($params)
    {
        $idProduto = $params[0];
        $idServico = $params[1];
        $produtoHasServico = new ProdutoHasServico();
        $produtoHasServico->setProduto_idProduto($idProduto);
        $produtoHasServico->setServico_idServico($idServico);

        $servicoDAO = new ServicoDAO();

        if (!$servicoDAO->excluirProdutoHasServico($produtoHasServico)) {
            Sessao::gravaMensagem("ERRO: produto não foi desvinculado do serviço. Contate o administrador do sistema.");
            $this->redirect('/servico');
        }

        $this->redirect('/servico/edicao/' . $produtoHasServico->getServico_idServico());
    }

    
}
