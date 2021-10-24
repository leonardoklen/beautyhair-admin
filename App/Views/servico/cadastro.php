    <div class="container">

        <?php if ($Sessao::retornaErro()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                    <?php echo $mensagem; ?> <br>
                <?php } ?>
            </div>
        <?php } ?>

        <form action="http://<?php echo APP_HOST; ?>/servico/salvar" method="post">
            <h5>Dados Serviço</h5>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-10">
                    <input type="text" class="form-control" id="nome" name="nome" maxlength="50" placeholder="Descrição" required>
                </div>
                <div class="form-group col-md-2">
                    <input type="number" class="form-control" id="preco" name="preco" min=0 placeholder="Preço" required>
                </div>
            </div>

            <br>

            <h5>Adicionar Produtos</h5>
            <hr>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <select id="produto" name="produto" class="form-control" required>
                        <option default disabled selected>Selecione</option>
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
                    <button type="button" class="form-control btn-success btn" id="buscar" action="adicionar">Adicionar</button>
                </div>
            </div>

            <div class="container table-responsive">
                <table class="table table-bordered" id="tabela">
                    <tr class="bg-secondary text-white row">
                        <td class="info col-md-1 text-center">ID</td>
                        <td class="info col-md-6 text-center">Descrição</td>
                        <td class="info col-md-3 text-center">Quantidade Utilizada</td>
                        <td class="info col-md-2 text-center">Ação</td>
                    </tr>
                </table>
            </div>

            <input type="hidden" class="form-control" name="listaProdutos" id="listaProdutos">

            <script>
                var lista_itens = [];
                var tabela = $("#tabela");
                var botao_adicionar = $('button[action="adicionar"]');

                botao_adicionar.on("click", function() {
                    adicionarProduto();
                });

                function adicionarProduto() {
                    var id = document.getElementById('produto');

                    var select = document.querySelector('select');
                    var option = select.children[select.selectedIndex];
                    var nome = option.textContent;

                    var quantidade = document.getElementById('quantidadeUtilizada');

                    if (id.value != "Selecione") {
                        if (quantidade.value != "" && quantidade.value>0) {

                            if (!encontraId(id.value)) {
                                let item = $('<tr class="bg-light row">' +
                                    '<td class="col-md-1 text-center">' + id.value + '</td>' +
                                    '<td class="col-md-6 text-center">' + nome + '</td>' +
                                    '<td class="col-md-3 text-center">' + quantidade.value + '</td>' +
                                    '<td class="col-md-2 text-center">' +
                                    '<button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this.parentNode.parentNode.rowIndex)">' + "Remover" + '</button>' +
                                    '</td>' +
                                    '</tr>'
                                );

                                lista_itens.push({
                                    id: id.value,
                                    quantidade: quantidade.value
                                });

                                tabela.append(item);
                            } else {
                                alert("Este produto já foi adicionado!")
                            }
                        } else {
                            alert("Verifique a quantidade utilizada, pois deve ser maior que 0.");
                        }
                    } else {
                        alert("Informe o produto!");
                    }
                }

                function encontraId(id) {
                    var flag = false;

                    for (var i = 0; i < lista_itens.length; i++) {
                        if (lista_itens[i].id === id) {
                            flag = true;
                        }
                    }
                    return flag;

                }

                function deleteRow(i){
                    document.getElementById('tabela').deleteRow(i);
                    lista_itens.splice(i-1,1);
                }

                function getLista(){
                    document.getElementById("listaProdutos").value = JSON.stringify(lista_itens);
                }

                
            </script>

            <br>

            <div>
                <div class="text-right">
                    <button class="btn-success btn form-group" type="submit" onclick="getLista()">Enviar</button>
                    <button class="btn-danger btn form-group" type="reset">Limpar</button>
                </div>
            </div>

        </form>

    </div>