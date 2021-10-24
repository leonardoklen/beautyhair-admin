<div class="container">
    <div class="row">
    <div class="col-md-12">

<a href="http://<?php echo APP_HOST; ?>/servico/cadastro/" class="btn btn-success float-md-right">Adicionar</a>
</div>

<br>
<br>
    <div class="col-md-12">
        <?php if($Sessao::retornaMensagem()){ ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $Sessao::retornaMensagem(); ?>
            </div>
        <?php } ?>

        <?php
            if(!count($viewVar['listaServicos'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhum serviço encontrado</div>
        <?php
            } else {
        ?>
            
            <div class="container table-responsive">
                <table class="table table-bordered">
                    <tr class="bg-secondary text-white row">
                    <td class="info col-md-1 text-center">ID</td>
                        <td class="info col-md-7 text-center">Descrição</td>
                        <td class="info col-md-2 text-center">Preço</td>
                        <td class="info col-md-2 text-center">Ação</td>
                    </tr>
                    <?php
                    $indice = 0;
                        foreach($viewVar['listaServicos'] as $servico) {
                            $indice = $indice + 1;
                    ?>
                        <tr class="bg-light row">

                        <td class="col-md-1 text-center"><?php echo $servico->getIdServico(); ?></td>
                            <td class="col-md-7 text-center"><?php echo $servico->getNome(); ?></td>
                            <td class="col-md-2 text-center"><?php echo $servico->getPreco(); ?></td>
                            <td class="col-md-2 text-center">
                            <form id="<?php echo $indice; ?>" action="http://<?php echo APP_HOST; ?>/servico/excluir" method="post" id="form_cadastro">
                                <input type="hidden" class="form-control" name="idServico" id="idServico" value="<?php echo $servico->getIdServico();?>">
                                <a href="http://<?php echo APP_HOST; ?>/servico/edicao/<?php echo $servico->getIdServico();?>" class="btn btn-info btn-sm">Editar</a>
                                <a class="btn text-white btn-danger btn-sm" onclick="del('serviço',<?php echo $indice; ?>);">Excluir</a>   
                            </form>  
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        <?php
            }
        ?>
    </div>
</div>
</div>