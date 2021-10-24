<div class="container">
        
        <?php if($Sessao::retornaErro()){ ?>
               <div class="alert alert-warning" role="alert">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                       <?php echo $mensagem; ?> <br>
                   <?php } ?>
               </div>
           <?php } ?>

       
       <form action="http://<?php echo APP_HOST; ?>/produto/salvar" method="post">
        <h5>Fornecedor</h5>
           <hr>
           <div class="form-row">
               <div class="form-group col-md-11">
                   <select id="fornecedor" name="fornecedor" class="form-control" required>
                   <option default disabled selected>Selecione</option>
                    <?php
                    if (count($viewVar['listaFornecedores'])) {
                        foreach ($viewVar['listaFornecedores'] as $fornecedor) {
                    ?><option value="<?php echo $fornecedor->getCnpj(); ?>"><?php echo $fornecedor->getRazaoSocial() ?></option><?php
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
               <div class="form-group col-md-10">
                   <input type="text" class="form-control" id="nome" name="nome" maxlength="100" placeholder="Descrição" required>
               </div>
               <div class="form-group col-md-2">
                   <input type="number" class="form-control" id="quantidadeEstoque" name="quantidadeEstoque" min=0 placeholder="Estoque" required>
               </div>
           </div>
           
           <br>
           
           <div>
               <div class="text-right">
               <button class="btn-success btn form-group" type="submit">Enviar</button>
               <button class="btn-danger btn form-group" type="reset">Limpar</button>
               </div>
           </div>

           
       </form>

   </div>
