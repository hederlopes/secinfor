<?php include "includes/menu_manutencao.php"; ?> 

<div class="row">
    <div class="col-sm-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px;min-height: 700px;">
                       <?php include "includes/sub_menu_falha.php"; ?> 
            <h3 class="panel-body">Cadastro de Falhas</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" action="<?= base_url('Secinfor-Falhas-Cadastrar') ?>" method="POST" enctype="multipart/form-data">                  
             

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="falha" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Falhas</label>
                        <div class="col-xs-8 col-sm-5">
                            <input type="text" class="form-control" id="falha" value="<?= $this->session->flashdata('falha') ?>" name="falha" placeholder="Nome da nova falha detectada">                          
                            <span class="text-danger"><?php echo form_error('falha'); ?></span>
                        </div> 
                    </div>
                
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-7" align="right">
                            <button type="submit" class="btn btn-primary" id="enviar" onclick="">
                                Cadastrar
                            </button>
                        </div>
                    </div>
            

                </form>
            </div>                              
        </div>
    </div>
</div>



