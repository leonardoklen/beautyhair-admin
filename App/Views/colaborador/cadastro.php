<div class="container">

    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                <?php echo $mensagem; ?> <br>
            <?php } ?>
        </div>
    <?php } ?>

    <form action="http://<?php echo APP_HOST; ?>/colaborador/salvar" method="post">
        <h5>Dados Pessoais</h5>
        <hr>
        <div class="form-row">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="cpf" name="cpf" maxlength=11 placeholder="CPF" onblur="(validaCpf(this.value));" required>
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-7">
                <input type="text" class="form-control" id="nome" name="nome" maxlength=100 placeholder="Nome completo" required>
            </div>
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="telefone" name="telefone" maxlength=11 placeholder="DDD + Telefone" required>
            </div>

            <div class="form-group col-md-2">
                <select id="sexo" name="sexo" class="form-control" required>
                    <option default disabled selected>Sexo</option>
                    <option value="1">Masculino</option>
                    <option value="2">Feminino</option>
                </select></div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <input type="text" class="form-control" id="login" name="login" maxlength=20 placeholder="Login" required>
            </div>
            <div class="form-group col-md-4">
                <input type="password" class="form-control" id="senha" name="senha" maxlength=30 placeholder="Senha" required>
            </div>
            <div class="form-group col-md-4">
                <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" maxlength=30 placeholder="Confirmar senha" required>
            </div>
        </div>

        <br>
        <h5>Endereço</h5>
        <hr>
        <div class="form-row">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="cep" name="cep" maxlength=8 placeholder="CEP" onblur="pesquisacep(this.value);" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-11">
                <input type="text" class="form-control" id="logradouro" name="logradouro" maxlength=100 placeholder="Logradouro" required>
            </div>
            <div class="form-group col-md-1">
                <input type="text" class="form-control" id="numero" name="numero" maxlength=7 placeholder="Nº" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <input type="text" class="form-control" id="bairro" name="bairro" maxlength=100 placeholder="Bairro" required>
            </div>
            <div class="form-group col-md-7">
                <input type="text" class="form-control" id="complemento" name="complemento" maxlength=150 placeholder="Complemento">
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