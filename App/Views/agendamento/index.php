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

            <div class="form-row">
                <label for="de" class="text-dark col-form-label">Colaborador:</label>
                <div class="form-group col-md-2">
                    <select id="colaborador" name="colaborador" class="form-control" required>
                        <option value="">Todos</option>
                        <?php
                        if (count($viewVar['listaColaboradores'])) {
                            foreach ($viewVar['listaColaboradores'] as $colaborador) {
                        ?><option value="<?php echo $colaborador->getCpf(); ?>"><?php echo $colaborador->getNome() ?></option><?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>
                    </select>
                </div>

                <button class="btn-info btn form-group ml-3" id="pesquisar">Pesquisar</button>
            </div>

            <script>
                $("#pesquisar").on("click", function() {
                    var colaborador = $("#colaborador").val();

                    $.ajax({
                        url: 'http://<?php echo APP_HOST; ?>/agendamento/filtrarAgendamentosPorColaborador',
                        type: 'POST',
                        data: {
                            colaborador: colaborador
                        },
                        success: function(data) {
                            $("#page").html(data);

                        },
                        error: function(data) {
                            alert("Houve um erro ao carregar");
                        }
                    });
                })
            </script>

        </div>
    </div>

    <div id="page">

    </div>
</div>