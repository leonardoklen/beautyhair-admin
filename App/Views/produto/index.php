<div class="container">
    <div class="row">
        <div class="col-md-12">

            <a href="http://<?php echo APP_HOST; ?>/produto/cadastro/" class="btn btn-success float-md-right">Adicionar</a>
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
            if (!count($viewVar['listaProdutos'])) {
            ?>
                <div class="alert alert-info" role="alert">Nenhum produto encontrado</div>
            <?php
            } else {
            ?>

                <div class="container table-responsive">
                    <table class="table table-bordered">
                        <tr class="bg-secondary text-white row">
                            <td class="info col-md-1 text-center">ID</td>
                            <td class="info col-md-3 text-center">Descrição</td>
                            <td class="info col-md-2 text-center">Quantidade Disponível</td>
                            <td class="info col-md-4 text-center">Fornecedor</td>
                            <td class="info col-md-2 text-center">Ação</td>
                        </tr>
                        <?php
                        $indice = 0;
                        foreach ($viewVar['listaProdutos'] as $produto) {
                            $indice = $indice + 1;
                        ?>
                            <tr class="bg-light row">

                                <td class="col-md-1 text-center"><?php echo $produto->getIdProduto(); ?></td>
                                <td class="col-md-3 text-center"><?php echo $produto->getNome(); ?></td>
                                <td class="col-md-2 text-center"><?php echo $produto->getQuantidadeEstoque(); ?></td>
                                <td class="col-md-4 text-center"><?php foreach ($viewVar['listaFornecedores'] as $fornecedor) {
                                                                        if ($fornecedor->getCnpj() == $produto->getFornecedor_cnpj()) {
                                                                            echo $fornecedor->getRazaoSocial();
                                                                        }
                                                                    } ?></td>
                                <td class="col-md-2 text-center">
                                    <form id="<?php echo $indice; ?>" action="http://<?php echo APP_HOST; ?>/produto/excluir" method="post" id="form_cadastro">
                                        <input type="hidden" class="form-control" name="idProduto" id="idProduto" value="<?php echo $produto->getIdProduto(); ?>">
                                        <a href="http://<?php echo APP_HOST; ?>/produto/edicao/<?php echo $produto->getIdProduto(); ?>" class="btn btn-info btn-sm">Editar</a>
                                        <a class="btn text-white btn-danger btn-sm" onclick="del('produto', <?php echo $indice; ?>);">Excluir</a>
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