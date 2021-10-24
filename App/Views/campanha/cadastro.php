<div class="container">

    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                <?php echo $mensagem; ?> <br>
            <?php } ?>
        </div>
    <?php } ?>


    <form action="http://<?php echo APP_HOST; ?>/campanha/salvar" method="post">

        <h5>Dados Campanha</h5>
        <hr>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="de" class="text-secondary">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" maxlength="100" placeholder="Ex: Condição Especial dia Da Mulher" required>
            </div>
            <div class="form-group col-md-2">
                <label for="de" class="text-secondary">De</label>
                <input type="date" class="form-control" id="de" name="de" required>
            </div>
            <div class="form-group col-md-2">
                <label for="ate" class="text-secondary">Até</label>
                <input type="date" class="form-control" id="ate" name="ate" required>
            </div>
        </div>

        <div class="form-row">


            <div class="form-group col-md-4">
                <label for="desconto" class="text-secondary">Desconto %</label>
                <input type="number" class="form-control" id="desconto" name="desconto" placeholder="Ex: 10" required>
            </div>
            <div class="form-group col-md-4">
                <label for="formaPagamento" class="text-secondary">Forma de Pagamento</label>
                <select id="formaPagamento" name="formaPagamento" class="form-control" required>
                    <option default disabled selected>Selecione</option>
                    <option value="a vista">À vista</option>
                    <option value="a prazo">A prazo</option>
                    <option value="a vista ou a prazo">À vista ou a prazo</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="situacao" class="text-secondary">Situação</label>
                <select id="situacao" name="situacao" class="form-control" required>
                    <option default disabled selected>Selecione</option>
                    <option value=1>Ativo</option>
                    <option value=2>Inativo</option>
                </select>
            </div>
        </div>

        <br>
        <h5>Adicionar Serviços</h5>
        <hr>

        <?php
        if (!count($viewVar['listaServicos'])) {
        ?>
            <div class="alert alert-danger" role="alert">Nenhum serviço encontrado. Cadastre serviços para criar campanhas.</div>
        <?php
        } else {
        ?>


            <div class="container table-responsive">
                <table class="table table-bordered" id="tabela">
                    <tr class="bg-secondary text-white row">
                        <td class="info col-md-1 text-center"><input type="checkbox" id="selectAll" value="option1"></td>
                        <td class="info col-md-2 text-center">ID</td>
                        <td class="info col-md-7 text-center">Descrição</td>
                        <td class="info col-md-2 text-center">Preço</td>
                    </tr>

                    <script>
                        $(document).ready(function() {
                                    $('#selectAll').click(function(event) {
                                        if (this.checked) {
                                            $('.checkbox1').each(function() {
                                                this.checked = true;             
                                            });
                                        } else {
                                            $('.checkbox1').each(function() { 
                                                this.checked = false;
                                            });
                                        }
                                    });
                        });
                    </script>

                    <?php
                    foreach ($viewVar['listaServicos'] as $servico) {
                    ?>
                        <tr class="bg-light row">
                            <td class="info col-md-1 text-center"><input class="checkbox1" type="checkbox" name="servicos[]" id="servicos[]" value=<?php echo $servico->getIdServico(); ?>></td>
                            <td class="info col-md-2 text-center"><?php echo $servico->getIdServico(); ?></td>
                            <td class="info col-md-7 text-center"><?php echo $servico->getNome(); ?></td>
                            <td class="info col-md-2 text-center">R$ <?php echo $servico->getPreco(); ?>,00</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        <?php } ?>

        <br>

        <div>
            <div class="text-right">
                <button class="btn-success btn form-group" type="submit">Enviar</button>
                <button class="btn-danger btn form-group" type="reset">Limpar</button>
            </div>
        </div>
    </form>

</div>