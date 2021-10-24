<?php

namespace App\Controllers;

require_once PATH . '/App/PhpMailer/src/PHPMailer.php';
require_once PATH . '/App/PhpMailer/src/SMTP.php';
require_once PATH . '/App/PhpMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Lib\Sessao;
use App\Models\DAO\ServicoDAO;
use App\Models\DAO\CampanhaDAO;
use App\Models\Entidades\Campanha;
use App\Models\Validacao\CampanhaValidador;

class CampanhaController extends Controller
{

    public function index()
    {
        $campanhaDAO = new CampanhaDAO();

        self::setViewParam('listaCampanhas', $campanhaDAO->listar());

        $this->render('/campanha/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {

        $servicoDAO = new ServicoDAO();

        self::setViewParam('listaServicos', $servicoDAO->listar());

        $this->render('/campanha/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $campanha = new Campanha();
        $campanha->setDescricao($_POST['descricao']);
        $campanha->setDe($_POST['de']);
        $campanha->setAte($_POST['ate']);
        $campanha->setDesconto($_POST['desconto']);
        $campanha->setFormaPagamento($_POST['formaPagamento']);
        $campanha->setSituacao($_POST['situacao']);

        Sessao::gravaFormulario($_POST);

        $campanhaValidador = new CampanhaValidador();
        $resultadoValidacao = $campanhaValidador->validar($campanha);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/campanha/cadastro');
        }

        $campanhaDAO = new CampanhaDAO();

        $campanha->setIdCampanha($campanhaDAO->salvar($campanha));

        $servicos = $_POST['servicos'];

        foreach ($servicos as $servico) {
            $campanhaDAO->salvarServicoHasCampanha($servico, $campanha);
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/campanha');
    }

    public function excluir($params)
    {
        $campanha = new Campanha();
        $campanha->setIdCampanha($params[0]);

        $campanhaDAO = new CampanhaDAO();

        if (!$campanhaDAO->excluir($campanha)) {
            Sessao::gravaMensagem("Campanha inexistente");
            $this->redirect('/campanha');
        }

        $this->redirect('/campanha');
    }

    public function dispararEmails($params)
    {
        $campanhaDAO = new CampanhaDAO();

        $campanha = $campanhaDAO->listar($params[0]);

        $emailsEnviados = 0;
        $emailsNaoEnviados = 0;

        foreach (($campanhaDAO->listarEmails()) as $cliente) {

            $mail = new PHPMailer(true);



            try {

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'emailstccleonardoklen@gmail.com';
                $mail->Password = 'tccads2020';
                $mail->Port = 587;

                $mail->setFrom($cliente['email']);
                $mail->addAddress($cliente['email']);

                $mail->isHTML(true);

                $nomeCliente = $cliente['nome'];
                $descricaoCampanha = $campanha->getDescricao();
                $de = $campanha->getDe();
                $ate = $campanha->getAte();
                $desconto = $campanha->getDesconto();
                $formaPagamento = $campanha->getFormaPagamento();

                $mail->Subject = $nomeCliente . ', aproveite: ' . $descricaoCampanha . ' - Beauty Hair';
                $mail->Body = '<strong>' . $descricaoCampanha . '</strong>
            <p>' . $nomeCliente . ', venha para a Beauty Hair!</p>
            <p>Só aqui você encontra essa promoção imperdível com ' . $desconto . '% de desconto em nossos serviços.</p>
            <p>Promoção válida de ' . $de . ' até ' . $ate . ' na forma de pagamento ' . $formaPagamento . '.</p>';
                $mail->AltBody = 'E-mail de marketing do Beauty Hair - Salão de Beleza';

                if ($mail->send()) {
                    $emailsEnviados++;
                } else {
                    $emailsNaoEnviados++;
                }
            } catch (Exception $e) {
                echo "Erro: " . $mail->errorInfo;
            }
        };

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $totalClientes = $emailsEnviados + $emailsNaoEnviados;

        $msg = "Emails enviados com sucesso: " . $emailsEnviados . " - Emails não enviados: " . $emailsNaoEnviados . " - Total de clientes: " . $totalClientes;

        Sessao::gravaMensagem($msg);

        $this->redirect('/campanha');
    }
}
