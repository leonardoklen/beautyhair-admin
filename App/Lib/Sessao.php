<?php

namespace App\Lib;

class Sessao
{
    public static function gravaMensagem($mensagem)
    {
        $_SESSION['mensagem'] = $mensagem;
    }

    public static function limpaMensagem()
    {
        unset($_SESSION['mensagem']);
    }

    public static function retornaMensagem()
    {
        return ($_SESSION['mensagem']) ? $_SESSION['mensagem'] : "";
    }

    public static function gravaFormulario($form)
    {
        $_SESSION['form'] = $form;
    }

    public static function limpaFormulario()
    {
        unset($_SESSION['form']);
    }

    public static function retornaValorFormulario($key)
    {
        return (isset($_SESSION['form'][$key])) ? $_SESSION['form'][$key] : ""; //DEBUGAR ISSO AQUI
    }

    public static function existeFormulario()
    {
        return (isset($_SESSION['form'])) ? $_SESSION['form'] : "";
    }

    public static function gravaErro($erros)
    {
        $_SESSION['erro'] = $erros;
    }

    public static function retornaErro()
    {
        return (isset($_SESSION['erro'])) ? $_SESSION['erro'] : false;
    }

    public static function limpaErro()
    {
        unset($_SESSION['erro']);
    }

    public static function criarSessao($nome, $conteudo)
    {
        $_SESSION[$nome] = $conteudo;
    }

    public static function retornaNomeUsuario(){
        return $_SESSION['usuarioAdmin'];
    }

    public static function validaSessao()
    {
        if (!$_SESSION['usuarioAdmin']) {
            header('Location: http://' . APP_HOST . '/login/index');
            exit;
        }
    }
}
