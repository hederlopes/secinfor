<?php include "includes/menu_ativos_rede.php"; ?> 
<div class="row">
    <div class="col-xs-12 col-md-12">     
        <div class="panel panel-default" style="margin-top: 10px;min-height: 700px;">
           <?php include "includes/sub_menu_antena.php"; ?> 
            <h3 class="panel-body">Editar Marcas/Modelos de Equipamentos</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" action="<?= base_url('Antena-Alterar-Marcas') ?>" method="POST" enctype="multipart/form-data">                  
                    <input type="hidden" class="form-control" id="equipamento_id" value="<?= $equipamento_id ?>" name="equipamento_id">                          

                    <?php if ($modelo != FALSE): ?>
                        <?php foreach ($modelo->result() as $linha): ?>
                            <div class="form-group" style="margin-top: 10px;">
                                <label for="marca" class="col-xs-2 col-xs-offset-2 control-label">Nova Marca</label>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control" id="marca" value="<?= $linha->equipamento_marca?>" name="marca" placeholder="Nome da nova marca">                          
                                    <span class="text-danger"><?php echo form_error('marca'); ?></span>
                                </div> 
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label for="modelo" class="col-xs-2 col-xs-offset-2 control-label">Novo Modelo</label>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control" id="modelo" value="<?= $linha->equipamento_modelo?>" name="modelo" placeholder="Nome da novo modelo">                          
                                    <span class="text-danger"><?php echo form_error('modelo'); ?></span>
                                </div> 
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="form-group" >
                        <div class="col-xs-2 col-xs-offset-7" align="right">
                            <button type="submit" class="btn btn-primary" id="enviar" onclick="">
                                Alterar
                            </button>
                        </div>
                    </div>

                </form>
            </div>                              
        </div>
    </div>
</div>



