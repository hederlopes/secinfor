<?php include "includes/menu_manutencao.php"; ?> 
<div class="row">
    <div class="col-xs-12 col-md-12">     
        <div class="panel panel-default" style="margin-top: 10px;height: 400px; min-height: 700px;">
             <?php include "includes/sub_menu_falha.php"; ?> 
            <h3 class="panel-body">Editar Falhas</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" action="<?= base_url('Secinfor-Falhas-Altera-Dados') ?>" method="POST" enctype="multipart/form-data">                  
                    <?php if ($falha != FALSE): ?>
                        <?php foreach ($falha->result() as $linha): ?>
                        <input type="hidden" class="form-control" id="falha_id" value="<?= $linha->falha_id ?>" name="falha_id">                          
                        <div class="form-group" style="margin-top: 10px;">
                            <label for="falha" class="col-xs-2 col-xs-offset-2 control-label">Nova Falha</label>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" id="falha" value="<?= $linha->falha_descricao ?>" name="falha" placeholder="Nome da nova seção">                          
                                <span class="text-danger"><?php echo form_error('falha'); ?></span>
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



