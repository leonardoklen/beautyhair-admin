<div class="container">
    <div class="row">
        <div class="col-md-12">

            <a href="http://<?php echo APP_HOST; ?>/fornecedor/cadastro/" class="btn btn-success float-md-right">Adicionar</a>
        </div>

        <br>
        <br>
        <div class="col-md-12">
            <?php if ($Sessao::retornaMensagem()) { ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php } ?>

            <?php
            if (!count($viewVar['listaFornecedores'])) {
            ?>
                <div class="alert alert-info" role="alert">Nenhum fornecedor encontrado</div>
            <?php
            } else {
            ?>

                <div class="container table-responsive">
                    <table class="table table-bordered">
                        <tr class="bg-secondary text-white row">
                            <td class="info col-md-2 text-center">CNPJ</td>
                            <td class="info col-md-3 text-center">Razão Social</td>
                            <td class="info col-md-1 text-center">Representante</td>
                            <td class="info col-md-2 text-center">Telefone Fixo</td>
                            <td class="info col-md-2 text-center">Telefone Celular</td>
                            <td class="info col-md-2 text-center">Ação</td>
                        </tr>
                        <?php
                        $indice = 0;
                        foreach ($viewVar['listaFornecedores'] as $fornecedor) {
                            $indice = $indice + 1;
                        ?>
                            <tr class="bg-light row">

                                <td class="col-md-2 text-center"><?php echo $fornecedor->getCnpj(); ?></td>
                                <td class="col-md-3 text-center"><?php echo $fornecedor->getRazaoSocial(); ?></td>
                                <td class="col-md-1 text-center"><?php echo $fornecedor->getNomeContato(); ?></td>
                                <td class="col-md-2 text-center"><?php echo $fornecedor->getTelefoneFixo(); ?></td>
                                <td class="col-md-2 text-center"><?php echo $fornecedor->getTelefoneCelular(); ?></td>
                                <td class="col-md-2 text-center">
                                    <form id="<?php echo $indice; ?>" action="http://<?php echo APP_HOST; ?>/fornecedor/excluir" method="post" id="form_cadastro">
                                        <input type="hidden" class="form-control" name="cnpj" id="cnpj" value="<?php echo $fornecedor->getCnpj(); ?>">
                                        <a href="http://<?php echo APP_HOST; ?>/fornecedor/edicao/<?php echo $fornecedor->getCnpj(); ?>" class="btn btn-info btn-sm">Editar</a>
                                        <a class="btn text-white btn-danger btn-sm" onclick="del('fornecedor',<?php echo $indice; ?>);">Excluir</a>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>