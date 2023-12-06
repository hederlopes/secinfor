 
<?php include "includes/menu_relatorio.php"; ?> 
<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">

            <h3 class="panel-body">Conteúdo para arquivo dhcp.conf</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('#') ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="so" class="col-xs-4 col-sm-2 control-label">Código</label>
                        <div class="col-xs-8 col-sm-10">
                            <code>  
                                <textarea class="form-control" id="so" name="so" rows="50" autofocus onchange="exibe_software(this.value);" >
<?php if($codigo == FALSE): ?>
<?php echo 'Não há Máquinas Cadastradas'; ?>
<?php else: ?>
<?php foreach ($codigo->result() as $linha): ?>
host <?= $linha->maquina_hostname; ?>  {#<?= $linha->secao_nome; ?>   
    <?= ($linha->maquina_maclan != '') ?  'hardware ethernet '.  $linha->maquina_maclan  : 'hardware ethernet '.  $linha->maquina_macwan ?>

    fixed-address <?= $linha->maquina_ip; ?>;                     
    }

<?php endforeach; ?>
<?php endif; ?>
                                </textarea>
                            </code>  
                        </div> 
                    </div>              
                </form>
            </div>
        </div>              
    </div>
</div>








