<?php include "includes/menu_ativos_rede.php"; ?> 


<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px;  min-height: 700px;">
             <?php include "includes/sub_menu_maquina.php"; ?> 
            <h3 class="panel-body">Editar Dados de Processadores</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('Secinfor-Processadores-Altera-Dados') ?>" enctype="multipart/form-data">
                    <?php if ($processador != FALSE): ?>
                        <?php foreach ($processador->result() as $linha): ?>
                            <input type="hidden" class="form-control" id="processador_id" value="<?= $linha->processador_id ?>" name="processador_id">                      
                            <div class="form-group" style="margin-top: 10px;">
                                <label for="processador" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Processador</label>
                                <div class="col-xs-8 col-sm-6">
                                    <input type="text" class="form-control" id="processador" value="<?= $linha->processador_modelo ?>" name="processador">                          
                                    <span class="text-danger"><?php echo form_error('processador'); ?></span>
                                </div> 
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="form-group" >
                        <div class="col-sm-2 col-sm-offset-8" align="right">
                            <button type="submit" class="btn btn-primary" id="enviar" onclick="">
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>              
        </div>
    </div>
</div>




