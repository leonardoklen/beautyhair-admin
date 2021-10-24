<div class="container">
    <div class="row">

        <div class="col-md-12">

            <a href="http://<?php echo APP_HOST; ?>/fornecedor" class="btn btn-info float-md-right">Voltar</a>
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

            <form action="http://<?php echo APP_HOST; ?>/fornecedor/atualizar" method="post">

                <h5>Dados Fornecedor</h5>
        <hr>
          <div class="form-row">
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" id="cnpj" name="cnpj" maxlength="14" value="<?php echo $viewVar['fornecedor']->getCnpj(); ?>" readonly="true" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="razaoSocial" name="razaoSocial" maxlength="100" value="<?php echo $viewVar['fornecedor']->getRazaoSocial(); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="nomeFantasia" name="nomeFantasia" maxlength="100" value="<?php echo $viewVar['fornecedor']->getNomeFantasia(); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="nomeContato" name="nomeContato" maxlength="50" value="<?php echo $viewVar['fornecedor']->getNomeContato(); ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" id="telefoneFixo" name="telefoneFixo" maxlength="10" value="<?php echo $viewVar['fornecedor']->getTelefoneFixo(); ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" id="telefoneCelular" name="telefoneCelular" maxlength="11" value="<?php echo $viewVar['fornecedor']->getTelefoneCelular(); ?>" required>
                </div>
            </div>

                <br>

                <h5>Endereço</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="cep" name="cep" maxlength=8 value="<?php echo $viewVar['endereco']->getCep(); ?>" onblur="pesquisacep(this.value);" required>
                        <input type="hidden" class="form-control" name="idEndereco" id="idEndereco" value="<?php echo $viewVar['endereco']->getIdEndereco(); ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-11">
                        <input type="text" class="form-control" id="logradouro" name="logradouro" maxlength=100 value="<?php echo $viewVar['endereco']->getLogradouro(); ?>" required>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="text" class="form-control" id="numero" name="numero" maxlength=7 value="<?php echo $viewVar['endereco']->getNumero(); ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control" id="bairro" name="bairro" maxlength=100 value="<?php echo $viewVar['endereco']->getBairro(); ?>" required>
                    </div>
                    <div class="form-group col-md-7">
                        <input type="text" class="form-control" id="complemento" name="complemento" maxlength=150 placeholder="Complemento" value="<?php if(!empty($viewVar['endereco']->getComplemento())){echo $viewVar['endereco']->getComplemento();} ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-11">
                        <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $viewVar['cidade']->getNome(); ?>" readonly="true" required>
                    </div>
                    <div class="form-group col-md-1">
                        <input type="text" class="form-control" id="uf" name="uf" value="<?php echo $viewVar['estado']->getSigla(); ?>" readonly="true" required>
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