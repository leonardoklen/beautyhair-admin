    <div class="container">

    <?php if($Sessao::retornaErro()){ ?>
               <div class="alert alert-warning" role="alert">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                       <?php echo $mensagem; ?> <br>
                   <?php } ?>
               </div>
           <?php } ?>
        
        <form action="http://<?php echo APP_HOST; ?>/fornecedor/salvar" method="post">
           <h5>Dados Fornecedor</h5>
        <hr>
          <div class="form-row">
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" id="cnpj" name="cnpj" maxlength="14" placeholder="CNPJ" onblur="(validaCnpj(this.value));" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="razaoSocial" name="razaoSocial" maxlength="100" placeholder="Razão social" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="nomeFantasia" name="nomeFantasia" maxlength="100" placeholder="Nome fantasia" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="nomeContato" name="nomeContato" maxlength="50" placeholder="Representante" required>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" id="telefoneFixo" name="telefoneFixo" maxlength="10" placeholder="Telefone fixo" required>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" id="telefoneCelular" name="telefoneCelular" maxlength="11" placeholder="Telefone celular" required>
                </div>
            </div>

            <br>
            <h5>Endereço</h5>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" id="cep" name="cep" maxlength="8" placeholder="CEP" onblur="pesquisacep(this.value);" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-11">
                    <input type="text" class="form-control" id="logradouro" name="logradouro" maxlength="100" placeholder="Logradouro" required>
                </div>
                <div class="form-group col-md-1">
                    <input type="text" class="form-control" id="numero" name="numero" maxlength="7" placeholder="Nº" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-5">
                    <input type="text" class="form-control" id="bairro" name="bairro" maxlength="100" placeholder="Bairro" required>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control" id="complemento" name="complemento" maxlength="150" placeholder="Complemento">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-11">
                    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" readonly="true" required>
                </div>
                <div class="form-group col-md-1">
                    <input type="text" class="form-control" id="uf" name="uf" placeholder="UF" readonly="true" required>
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

