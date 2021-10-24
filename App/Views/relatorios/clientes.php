<div class="container">

    <div class="row">

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
            if (!count($viewVar['listaClientes'])) {
            ?>
                <div class="alert alert-info" role="alert">Nenhum cliente encontrado</div>
            <?php
            } else {
            ?>

                <div class="container table-responsive">
                    <table class="table table-bordered">
                        <tr class="bg-secondary text-white row">
                            <td class="info col-md-2 text-center">CPF</td>
                            <td class="info col-md-4 text-center">Nome</td>
                            <td class="info col-md-3 text-center">Telefone</td>
                            <td class="info col-md-3 text-center">E-mail</td>
                        </tr>
                        <?php
                        foreach ($viewVar['listaClientes'] as $cliente) {
                        ?>
                            <tr class="bg-light row">

                                <td class="col-md-2 text-center"><?php echo $cliente->getCpf(); ?></td>
                                <td class="col-md-4 text-center"><?php echo $cliente->getNome(); ?></td>
                                <td class="col-md-3 text-center"><?php echo $cliente->getTelefone(); ?></td>
                                <td class="col-md-3 text-center"><?php echo $cliente->getEmail(); ?></td>
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