<div class="container">

  <div class="row mt-1 mb-3">
    <div class="col-md-12 text-right">
      <a class="btn btn-success float-md-right" href="http://<?php echo APP_HOST; ?>/campanha/cadastro/">Criar Campanha</a>
    </div>
  </div>

  <?php
  if ($Sessao::retornaMensagem()) { ?>
    <div class="alert alert-success" role="alert">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?php echo $Sessao::retornaMensagem(); ?>
    </div>
  <?php } ?>


  <?php
  if (!count($viewVar['listaCampanhas'])) {
  ?>
    <div class="alert alert-secondary text-center mb-4" role="alert">Nenhuma campanha cadastrada.</div>
  <?php
  } else {
  ?>
    <?php
    $contador = 0;
    foreach ($viewVar['listaCampanhas'] as $campanha) {
      if ($contador % 3 == 0) {
    ?><div class="row">
        <?php } ?>

        <div class="col-md-4 mb-4">
          <div class="card" style="width: 22rem;">
            <div class="card-body mb-0">
              <h5 class="card-title"><?php echo $campanha->getDescricao(); ?></h5>
              <h6 class="card-subtitle mb-2 text-muted">De <?php echo date('d/m/Y', strtotime($campanha->getDe())); ?> a <?php echo date('d/m/Y', strtotime($campanha->getAte())); ?></h6>
              <p class="card-text mb-1">Desconto: <?php echo $campanha->getDesconto(); ?>%</p>
      <p class="card-text mb-1">Forma de pagamento: <?php if($campanha->getFormaPagamento() == "a vista"){
        ?> à vista 
        <?php } else if($campanha->getFormaPagamento() == "a vista ou a prazo"){
           ?> à vista ou a prazo 
           <?php }else{ echo $campanha->getFormaPagamento(); }?></p>
              <p class="card-text mb-1 <?php if ($campanha->getSituacao() == 1) { ?> text-success <?php } else { ?> text-danger <?php }; ?>">Situação: <?php if ($campanha->getSituacao() == 1) { ?> Ativo <?php } else { ?> Inativo <?php }; ?></p>
              <center>
                <a href="http://<?php echo APP_HOST; ?>/campanha/dispararEmails/<?php echo $campanha->getIdCampanha(); ?>" class="btn-info btn mt-2 text-white">Disparar E-mails</a>
                <a onclick="delCampanha(<?php echo $campanha->getIdCampanha(); ?>)" class="btn-danger btn mt-2 text-white">Excluir Campanha</a>
              </center>
            </div>

          </div>
        </div>


        <?php if ($contador % 3 == 2) { ?>
        </div>
  <?php
        }
        $contador++;
      }
    }
  ?>
</div>
</div>

</div>