<div class="container">
    <div class="row">

        <div class="col-md-12">

            <a href="http://<?php echo APP_HOST; ?>/produto" class="btn btn-info float-md-right">Voltar</a>
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

            <form action="http://<?php echo APP_HOST; ?>/produto/atualizar" method="post">

                <h5>Fornecedor</h5>
           <hr>
           <div class="form-row">
               <div class="form-group col-md-11">
                   <select id="fornecedor" name="fornecedor" class="form-control" required>
                    <?php
                    if (count($viewVar['listaFornecedores'])) {
                        foreach ($viewVar['listaFornecedores'] as $fornecedor) {
                    ?><option value="<?php echo $fornecedor->getCnpj(); ?>" <?php if ($viewVar['produto']->getFornecedor_cnpj() == $fornecedor->getCnpj()) { ?> selected <?php } ?>><?php echo $fornecedor->getRazaoSocial() ?></option><?php
                                                                                                                }
                                                                                                            }
                                                                                                                    ?>

                </select>
               </div>
               <div class="form-group col-md-1">
               <a class="form-control btn btn-secondary" href="http://<?php echo APP_HOST; ?>/fornecedor/cadastro/">...</a>
                   </div>
           </div>
           
           <br>

          <h5>Dados Produto</h5>
       <hr>
       <div class="form-row">
                    <div class="form-group col-md-1">
                        <input type="number" class="form-control" name="idProduto" id="idProduto" value="<?php echo $viewVar['produto']->getIdProduto(); ?>" readonly="true" required>
                    </div>
                </div>
           <div class="form-row">
               <div class="form-group col-md-10">
                   <input type="text" class="form-control" id="nome" name="nome" maxlength="100" value="<?php echo $viewVar['produto']->getNome(); ?>" required>
               </div>
               <div class="form-group col-md-2">
                   <input type="number" class="form-control" id="quantidadeEstoque" name="quantidadeEstoque" min=0 value="<?php echo $viewVar['produto']->getQuantidadeEstoque(); ?>" required>
               </div>
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