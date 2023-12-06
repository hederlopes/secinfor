
<div class="row">
    <div class="col-xs-12 col-md-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
            <h3 class="panel-body">Softwares Proprietários</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" action="<?= base_url('Secinfor-Softwares-Alterar') ?>" method="POST" enctype="multipart/form-data">                  
                    <input type="hidden" class="form-control" id="software_id" value="<?= $software_id ?>" name="software_id">                          
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="software" class="col-xs-2 col-xs-offset-2 control-label">Nova Seção</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" id="software" value="" name="software" placeholder="Nome da nova seção">                          
                            <span class="text-danger"><?php echo form_error('software'); ?></span>
                        </div> 
                    </div>
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



