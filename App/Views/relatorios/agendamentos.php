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
                <label for="de" class="text-dark col-form-label">De:</label>
                <div class="form-group col-md-2">
                    <input type="date" class="form-control" id="de" name="de" required>
                </div>
                <label for="ate" class="text-dark col-form-label ml-3">Até:</label>
                <div class="form-group col-md-2">
                    <input type="date" class="form-control" id="ate" name="ate" required>
                </div>
                <button class="btn-info btn form-group ml-3" id="pesquisar">Pesquisar</button>
            </div>

            <script>
                $("#pesquisar").on("click", function() {
                    var de = $("#de").val();
                    var ate = $("#ate").val();

                    $.ajax({
                        url: 'http://<?php echo APP_HOST; ?>/relatorios/filtrarAgendamentosPorData',
                        type: 'POST',
                        data: {
                            de: de,
                            ate: ate
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

