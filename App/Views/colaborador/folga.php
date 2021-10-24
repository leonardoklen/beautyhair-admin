<div class="container">

    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                <?php echo $mensagem; ?> <br>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if ($Sessao::retornaMensagem()) { ?>
        <div class="alert alert-success" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $Sessao::retornaMensagem(); ?>
        </div>
    <?php } ?>

    <form action="http://<?php echo APP_HOST; ?>/colaborador/folgar" method="post">
        <h5>Agendamento de Folga</h5>
        <hr>
        <div class="form-row">

            <div class="form-group col-md-6">
                <select id="colaborador" name="colaborador" class="form-control" required>
                    <option default disabled selected>Selecione</option>
                    <?php
                    if (count($viewVar['listaColaboradores'])) {
                        foreach ($viewVar['listaColaboradores'] as $colaborador) {
                    ?><option value="<?php echo $colaborador->getCpf(); ?>"><?php echo $colaborador->getNome() ?></option><?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>
                </select>
            </div>


            <div class="form-group col-md-6">
                <input type="date" class="form-control" id="data" name="data" required>
            </div>
        </div>

        <div class="text-right">
            <button class="btn-success btn form-group" type="submit">Enviar</button>
        </div>
    </form>

    <h5>Relação de Folgas</h5>
    <hr>



    <div class="container table-responsive">
        <table class="table table-bordered">
            <tr class="bg-secondary text-white row">
                <td class="info col-md-3 text-center">CPF</td>
                <td class="info col-md-5 text-center">Colaborador</td>
                <td class="info col-md-3 text-center">Data</td>
                <td class="info col-md-1 text-center">Ação</td>
            </tr>
            <?php
            if (!$viewVar['listaFolgas']->rowCount() > 0) {
            ?>
                <tr class="row">
                    <td class="info col-md-12 text-center alert-secondary alert" role="alert">Nenhuma folga agendada.</td>
                </tr>
            <?php
            } else {
            ?>
                <?php
                foreach ($viewVar['listaFolgas'] as $folga) {
                ?>
                    <tr class="bg-light row">

                        <td class="col-md-3 text-center"><?php echo $folga['Colaborador_cpf']; ?></td>
                        <td class="col-md-5 text-center"><?php
                                                            foreach ($viewVar['listaColaboradores'] as $colaborador) {
                                                                if ($folga['Colaborador_cpf'] == $colaborador->getCpf()) {
                                                                    echo $colaborador->getNome();
                                                                }
                                                            } ?></td>
                        <td class="col-md-3 text-center"><?php echo date('d/m/Y', strtotime($folga['data'])); ?></td>
                        <td class="col-md-1 text-center">
                            <a onclick=delFolga(<?php echo $folga['Colaborador_cpf']; ?>,'<?php echo $folga['data'] ?>') class="btn btn-danger text-white btn-sm">Excluir</a>
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