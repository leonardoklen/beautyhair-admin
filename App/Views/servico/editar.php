<div class="container">
    <div class="row">

        <div class="col-md-12">

            <a href="http://<?php echo APP_HOST; ?>/servico" class="btn btn-info float-md-right">Voltar</a>
        </div>

        <div class="container">
            <?php if ($Sessao::retornaErro()) { ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/servico/atualizar" method="post">

                <h5>Dados Serviço</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-1">
                        <input type="number" class="form-control" name="idServico" id="idServico" value="<?php echo $viewVar['servico']->getIdServico(); ?>" readonly="true" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <input type="text" class="form-control" id="nome" name="nome" maxlength="50" value="<?php echo $viewVar['servico']->getNome(); ?>" required>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="number" class="form-control" id="preco" name="preco" min=0 value="<?php echo $viewVar['servico']->getPreco(); ?>" required>
                    </div>
                </div>

                <br>

                <h5>Editar Produtos</h5>
                <hr>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <select id="produto" name="produto" class="form-control">
                            <option default disabled value="" selected>Selecione</option>
                            <?php
                            if (count($viewVar['listaProdutos'])) {
                                foreach ($viewVar['listaProdutos'] as $produto) {
                            ?><option value="<?php echo $produto->getIdProduto(); ?>"><?php echo $produto->getNome() ?></option><?php
                                                                                                                            }
                                                                                                                        }
                                                                                                                                ?>

                        </select>
                    </div>
                    <div class="form-group col-md-1">
                    <a class="form-control btn-secondary btn" href="http://<?php echo APP_HOST; ?>/produto/cadastro">...</a>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="number" class="form-control" id="quantidadeUtilizada" name="quantidadeUtilizada" min=1 placeholder="Quantidade Utilizada">
                    </div>

                    <div class="form-group col-md-1">
                        <button type="button" action="adicionar" class="form-control btn-success btn">Adicionar</button>
                    </div>

                    <script>
                        function getProduto() {
                            return document.getElementById('produto').value;
                        }

                        function getQuantidadeUtilizada() {
                            return document.getElementById('quantidadeUtilizada').value;
                        }

                        var botao_adicionar = $('button[action="adicionar"]');

                        botao_adicionar.on("click", function() {
                            var produto = document.getElementById('produto').value;
                            var servico = document.getElementById('idServico').value;
                            var quantidadeUtilizada = document.getElementById('quantidadeUtilizada').value;
                            
                            var url = 'http://<?php echo APP_HOST; ?>/servico/salvarProdutoHasServico/' + produto + '/' + servico + '/' + quantidadeUtilizada;

                            if(produto != ""){
                                if(quantidadeUtilizada != "" && quantidadeUtilizada>0){
                                    window.location.href = url;
                                }else{
                                    alert("Verifique a quantidade, pois deve ser maior ou igual a 1.");
                                }
                            }else{
                                alert("Selecione um produto!");
                            }
                            

                            
                        });
                    </script>
                    
                </div>

                <div class="container table-responsive">
                    <table class="table table-bordered" id="tabela">
                        <tr class="bg-secondary text-white row">
                            <td class="info col-md-1 text-center">ID</td>
                            <td class="info col-md-6 text-center">Descrição</td>
                            <td class="info col-md-3 text-center">Quantidade Utilizada</td>
                            <td class="info col-md-2 text-center">Ação</td>
                        </tr>

                        <?php

                        if (count($viewVar['produtoHasServico'])) {

                            foreach ($viewVar['produtoHasServico'] as $produtoHasServico) {

                                foreach ($viewVar['listaProdutos'] as $produto) {

                                    if ($produtoHasServico->getProduto_IdProduto() == $produto->getIdProduto()) { ?>
                                        <tr class="bg-light row">
                                            <td class="col-md-1 text-center"> <?php echo $produto->getIdProduto(); ?> </td>
                                            <td class="col-md-6 text-center"> <?php echo $produto->getNome(); ?> </td>
                                            <td class="col-md-3 text-center"> <?php echo $produtoHasServico->getQuantidadeProdutoUtilizado(); ?> </td>
                                            <td class="col-md-2 text-center">
                                                <a href="http://<?php echo APP_HOST; ?>/servico/excluirProdutoHasServico/<?php echo $produtoHasServico->getProduto_idProduto(); ?>/<?php echo $produtoHasServico->getServico_idServico(); ?>" class="btn btn-danger btn-sm">Remover</a>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                        } else { ?>
                            <tr class="bg-light row">
                                <td class="col-md-12 text-center"> Nenhum produto cadastrado neste serviço.</td>
                            </tr>
                        <?php }
                        ?>
                    </table>
                </div>

                <br>

                <div>
                    <div class="text-right">
                        <button class="btn-success btn form-group" type="submit">Enviar</button>
                    </div>
                </div>


            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>