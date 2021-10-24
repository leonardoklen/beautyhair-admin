<div class="container">
    <div class="row">

        <div class="col-md-12">

            <a href="http://<?php echo APP_HOST; ?>/colaborador" class="btn btn-info float-md-right">Voltar</a>
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

            <form action="http://<?php echo APP_HOST; ?>/colaborador/atualizar" method="post">
                <h5>Dados Pessoais</h5>

                <hr>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <input type="text" class="form-control" name="cpf" id="cpf" maxlength=11 readonly="true" value="<?php echo $viewVar['colaborador']->getCpf(); ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-7">
                        <input type="text" class="form-control" id="nome" name="nome" maxlength=100 value="<?php echo $viewVar['colaborador']->getNome(); ?>" required>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="telefone" name="telefone" maxlength=11 value="<?php echo $viewVar['colaborador']->getTelefone(); ?>" required>
                    </div>

                    <div class="form-group col-md-2">
                        <select id="sexo" name="sexo" class="form-control" required>
                            <option value="1" <?php if ($viewVar['colaborador']->getSexo() == 1) { ?> selected <?php } ?>>Masculino</option>
                            <option value="2" <?php if ($viewVar['colaborador']->getSexo() == 2) { ?> selected <?php } ?>>Feminino</option>
                        </select>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="login" name="login" maxlength=20 value="<?php echo $viewVar['colaborador']->getLogin() ?>" readonly="true" required>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="password" class="form-control" id="senha" name="senha" maxlength=30 value="<?php echo $viewVar['colaborador']->getSenha() ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" maxlength=30 value="<?php echo $viewVar['colaborador']->getSenha() ?>" required>
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
                        <input type="text" class="form-control" id="complemento" name="complemento" maxlength=150 placeholder="Complemento" value="<?php if (!empty($viewVar['endereco']->getComplemento())) {
                                                                                                                                                        echo $viewVar['endereco']->getComplemento();
                                                                                                                                                    } ?>">
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