<div class="container">
    <div class="row">
        <div class="col-md-12">

            <a href="http://<?php echo APP_HOST; ?>/colaborador/cadastro/" class="btn btn-success float-md-right">Adicionar</a>
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
            if (!count($viewVar['listaColaboradores'])) {
            ?>
                <div class="alert alert-info" role="alert">Nenhum colaborador encontrado</div>
            <?php
            } else {
            ?>

                <div class="container table-responsive">
                    <table class="table table-bordered">
                        <tr class="bg-secondary text-white row">
                            <td class="info col-md-2 text-center">CPF</td>
                            <td class="info col-md-4 text-center">Nome</td>
                            <td class="info col-md-2 text-center">Telefone</td>
                            <td class="info col-md-2 text-center">Sexo</td>
                            <td class="info col-md-2 text-center">Ação</td>
                        </tr>
                        <?php
                        $indice = 0;
                        foreach ($viewVar['listaColaboradores'] as $colaborador) {
                            $indice = $indice + 1;
                        ?>
                            <tr class="bg-light row">

                                <td class="col-md-2 text-center"><?php echo $colaborador->getCpf(); ?></td>
                                <td class="col-md-4 text-center"><?php echo $colaborador->getNome(); ?></td>
                                <td class="col-md-2 text-center"><?php echo $colaborador->getTelefone(); ?></td>
                                <td class="col-md-2 text-center"><?php echo $colaborador->getSexo() == 1 ? "Masculino" : "Feminino"; ?></td>
                                <td class="col-md-2 text-center">
                                    <form id="<?php echo $indice; ?>" action="http://<?php echo APP_HOST; ?>/colaborador/excluir" method="post" id="form_cadastro">
                                        <input type="hidden" class="form-control" name="cpf" id="cpf" value="<?php echo $colaborador->getCpf(); ?>">
                                        <a href="http://<?php echo APP_HOST; ?>/colaborador/edicao/<?php echo $colaborador->getCpf(); ?>" class="btn btn-info btn-sm">Editar</a>
                                        <a class="btn text-white btn-danger btn-sm" onclick="del('colaborador',<?php echo $indice; ?>);">Excluir</a>
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