<nav class="navbar navbar-expand-lg navbar-light bg-light font sticky-top">
    <a class="navbar-brand" href="http://<?php echo APP_HOST; ?>"><img src="<?= PATH_IMG ?>layouts/iconCabecalho.png" width="40" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cadastrar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                    <a class="dropdown-item <?php if ($viewVar['nameController'] == "ColaboradorController" && $viewVar['nameAction'] == "cadastro") { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/colaborador/cadastro">Colaborador</a>

                    <a class="dropdown-item <?php if ($viewVar['nameController'] == "FornecedorController" && $viewVar['nameAction'] == "cadastro") { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/fornecedor/cadastro">Fornecedor</a>

                    <a class="dropdown-item <?php if ($viewVar['nameController'] == "ProdutoController" && $viewVar['nameAction'] == "cadastro") { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/produto/cadastro">Produto</a>

                    <a class="dropdown-item <?php if ($viewVar['nameController'] == "ServicoController" && $viewVar['nameAction'] == "cadastro") { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/servico/cadastro">Serviço</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Consultar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item <?php if ($viewVar['nameController'] == "ColaboradorController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/colaborador">Colaboradores</a>
                    <a class="dropdown-item <?php if ($viewVar['nameController'] == "FornecedorController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/fornecedor">Fornecedores</a>
                    <a class="dropdown-item <?php if ($viewVar['nameController'] == "ProdutoController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/produto">Estoque</a>
                    <a class="dropdown-item <?php if ($viewVar['nameController'] == "ServicoController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/servico">Serviços</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($viewVar['nameController'] == "AgendamentoController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "index")) { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/agendamento/index">Agendas</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($viewVar['nameController'] == "CampanhaController" && $viewVar['nameAction'] == "index") { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/campanha/index">Campanhas</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Relatórios
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item <?php if ($viewVar['nameController'] == "RelatoriosController" && $viewVar['nameAction'] == "clientes") { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/relatorios/clientes">Clientes</a>
                    <a class="dropdown-item <?php if ($viewVar['nameController'] == "RelatoriosController" && $viewVar['nameAction'] == "agendamentos") { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/relatorios/agendamentos">Agendamentos</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($viewVar['nameController'] == "ColaboradorController" && $viewVar['nameAction'] == "folga") { ?> active <?php } ?>" href="http://<?php echo APP_HOST; ?>/colaborador/folga">Folgas</a>
            </li>

        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form action="http://<?php echo APP_HOST; ?>/login/logout" method="post" id="form_cadastro">
                    <a class="btn btn-block btn-login btn-danger" href="http://<?php echo APP_HOST; ?>/login/logout">Sair</a>
                </form>
            </li>
        </ul>
    </div>
</nav>
<br>


<?  // FIM BARRA DE NAVEGAÇÃO  
?>