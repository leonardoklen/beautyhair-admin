<?php

namespace App\Models\DAO;

use App\Models\Entidades\Colaborador;

class ColaboradorDAO extends BaseDAO
{
    public function listar($cpf = null)
    {
        if ($cpf) {
            $resultado = $this->select(
                "SELECT * FROM colaborador WHERE cpf = $cpf"
            );

            return $resultado->fetchObject(Colaborador::class);
        } else {
            $resultado = $this->select(
                'SELECT * FROM colaborador ORDER BY nome ASC'
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Colaborador::class);
        }

        return false;
    }

    public function validarLogin(Colaborador $colaborador)
    {
        $login = $colaborador->getLogin();
        $senha = $colaborador->getSenha();

        $resultado = $this->select("select cpf, nome from colaborador where login = '{$login}' and senha = '{$senha}'");

        if (!empty($resultado)) {
            return $resultado->fetchObject(Colaborador::class);
        } else {
            return false;
        }
    }

    public function salvar(Colaborador $colaborador)
    {
        try {

            $cpf = $colaborador->getCpf();
            $nome = $colaborador->getNome();
            $sexo = $colaborador->getSexo();
            $telefone = $colaborador->getTelefone();
            $login = $colaborador->getLogin();
            $senha = $colaborador->getSenha();
            $Empresa_cnpj = $colaborador->getEmpresa_cnpj();
            $Endereco_idEndereco = $colaborador->getEndereco_idEndereco();

            return $this->insert(
                'colaborador',
                ":cpf, :nome, :sexo, :telefone, :login, :senha, :Empresa_cnpj, :Endereco_idEndereco",
                [
                    ':cpf' => $cpf,
                    ':nome' => $nome,
                    ':sexo' => $sexo,
                    ':telefone' => $telefone,
                    ':login' => $login,
                    ':senha' => $senha,
                    ':Empresa_cnpj' => $Empresa_cnpj,
                    ':Endereco_idEndereco' => $Endereco_idEndereco,
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function atualizar(Colaborador $colaborador)
    {
        try {

            $cpf = $colaborador->getCpf();
            $nome = $colaborador->getNome();
            $sexo = $colaborador->getSexo();
            $telefone = $colaborador->getTelefone();
            $login = $colaborador->getLogin();
            $senha = $colaborador->getSenha();
            $Empresa_cnpj = $colaborador->getEmpresa_cnpj();
            $Endereco_idEndereco = $colaborador->getEndereco_idEndereco();

            return $this->update(
                'colaborador',
                "nome = :nome, sexo = :sexo, telefone = :telefone, login = :login, senha = :senha, Empresa_cnpj = :Empresa_cnpj, Endereco_idEndereco = :Endereco_idEndereco",
                [
                    ':cpf' => $cpf,
                    ':nome' => $nome,
                    ':sexo' => $sexo,
                    ':telefone' => $telefone,
                    ':login' => $login,
                    ':senha' => $senha,
                    ':Empresa_cnpj' => $Empresa_cnpj,
                    ':Endereco_idEndereco' => $Endereco_idEndereco,
                ],
                "cpf = :cpf"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na atualização de dados.", 500);
        }
    }

    public function excluir(Colaborador $colaborador)
    {
        try {
            $cpf = $colaborador->getCpf();

            $this->delete('agendamento', 'Colaborador_cpf', $cpf);

            return $this->delete('colaborador', 'cpf', $cpf);
        } catch (\Exception $e) {
            throw new \Exception("Erro na exclusão de dados.", 500);
        }
    }

    public function quantidade()
    {
        $resultado = $this->select(
            "SELECT * FROM colaborador"
        );

        return $resultado->rowCount();
    }

    public function folgar($cpfColaborador, $data)
    {

        $arrayDeHoras = array(8, 9, 10, 11, 14, 15, 16, 17);

        try {

            foreach ($arrayDeHoras as $hora) {
                $this->insert(
                    'agendamento',
                    ":data, :hora, :Cliente_cpf, :Colaborador_cpf, :Servico_idServico",
                    [
                        ':data' => $data,
                        ':hora' => $hora,
                        ':Cliente_cpf' => 9999,
                        ':Colaborador_cpf' => $cpfColaborador,
                        ':Servico_idServico' => 9999,
                    ]
                );
            }
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function validarFolga($cpfColaborador, $data)
    {
        $resultado = $this->select("SELECT * FROM agendamento WHERE Colaborador_cpf = $cpfColaborador AND data = '$data'");

        return $resultado->rowCount();
    }

    public function listarFolgas()
    {
        $resultado = $this->select(
            "SELECT * FROM agendamento WHERE Cliente_cpf = 9999 GROUP BY data, Colaborador_cpf ORDER BY data, (select nome from colaborador where cpf = Colaborador_cpf) asc"
        );

        return $resultado;
    }

    public function excluirFolga($cpfColaborador, $data)
    {

        try {
                return $this->deleteNxN('agendamento','Colaborador_cpf',$cpfColaborador,'data', "'$data'");
        } catch (\Exception $e) {
            throw new \Exception("Erro na exclusão de dados.", 500);
        }
    }
}
