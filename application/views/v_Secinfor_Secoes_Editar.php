
<div class="row">
    <div class="col-xs-12 col-md-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
            <h3 class="panel-body" style="font-size: 10px;">Seções</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" action="<?= base_url('Secinfor-Secoes-Alterar') ?>" method="POST" enctype="multipart/form-data">                  
                    <input type="hidden" class="form-control" id="secao_id" value="<?= $secao_id ?>" name="secao_id">                          
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="secao" class="col-xs-2 col-xs-offset-2 control-label">Nova Seção</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" id="secao" value="" name="secao" placeholder="Nome da nova seção">                          
                            <span class="text-danger"><?php echo form_error('secao'); ?></span>
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



