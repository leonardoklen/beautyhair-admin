<div class="container">
<h4 class="text-dark font-weight-bold">Oi, <b class="text-info"><?php echo $Sessao::retornaNomeUsuario() ?>!</b> Seja bem-vindo(a).</h4>

</div>
<div class="container py-4 bg-light border rounded">

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card bg-info">
                <div class="card-body mb-0">
                    <h1 class="card-title text-center text-dark font-weight-bold">COLABORADORES</h1>
<h1 class="card-text mb-1 text-center display-2 text-dark"><?php if($viewVar['quantidadeColaboradores']>0){echo $viewVar['quantidadeColaboradores'];}else{?>0<?php }?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-info">
                <div class="card-body mb-0">
                    <h1 class="card-title text-center text-dark font-weight-bold">CLIENTES</h1>
                    <h1 class="card-text mb-1 text-center display-2 text-dark"><?php if($viewVar['quantidadeClientes']>0){echo $viewVar['quantidadeClientes'];}else{?>0<?php }?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-info">
                <div class="card-body mb-0">
                    <h1 class="card-title text-center text-dark font-weight-bold">AGENDAMENTOS</h1>
                    <h1 class="card-text mb-1 text-center display-2 text-dark"><?php if($viewVar['quantidadeAgendamentos']>0){echo $viewVar['quantidadeAgendamentos'];}else{?>0<?php }?></h1>
                </div>
            </div>
        </div>

        

    </div>

    <div class="row">

        <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-body mb-0">
                    <h2 class="card-title text-center text-dark font-weight-bold">FORNECEDORES</h2>
                    <h1 class="card-text mb-1 text-center display-2 text-dark"><?php if($viewVar['quantidadeFornecedores']>0){echo $viewVar['quantidadeFornecedores'];}else{?>0<?php }?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-body mb-0">
                    <h2 class="card-title text-center text-dark font-weight-bold">PRODUTOS</h2>
                    <h1 class="card-text mb-1 text-center display-2 text-dark"><?php if($viewVar['quantidadeProdutos']>0){echo $viewVar['quantidadeProdutos'];}else{?>0<?php }?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-body mb-0">
                    <h2 class="card-title text-center text-dark font-weight-bold">SERVIÇOS</h2>
                    <h1 class="card-text mb-1 text-center display-2 text-dark"><?php if($viewVar['quantidadeServicos']>0){echo $viewVar['quantidadeServicos'];}else{?>0<?php }?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-body mb-0">
                    <h2 class="card-title text-center text-dark font-weight-bold">CAMPANHAS</h2>
                    <h1 class="card-text mb-1 text-center display-2 text-dark"><?php if($viewVar['quantidadeCampanhas']>0){echo $viewVar['quantidadeCampanhas'];}else{?>0<?php }?></h1>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="container text-right">
    <small><a href="http://beautyhair.website/">Clique aqui para visitar o site</a></small>
    </div>