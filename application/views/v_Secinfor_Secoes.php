
<script>
    var base_url = '<?= base_url() ?>';

    function exibe_secao(pavilhao) {
        
         $.post(base_url + "Secinfor/listar_secoes", {
            pavilhao: pavilhao
        }, function (data) {
            $('#secao_cadastrada').html(data);
        });
    }

  

</script>
<div class="row">
    <div class="col-sm-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
            <h3 class="panel-body">Seções</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" action="<?= base_url('Secinfor-Secoes-Cadastrar') ?>" method="POST" enctype="multipart/form-data">                  
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="pavilhao" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Pavilhão</label>
                        <div class="col-xs-8 col-sm-5">
                            <select class="form-control" id="pavilhao" name="pavilhao" onchange="exibe_secao(this.value);" >
                                <option value=''>Selecione...</option>
                                <?php if ($pavilhao != false): ?>
                                    <?php foreach ($pavilhao->result() as $linha) : ?>
                                        <option value="<?= $linha->pavilhao_id ?>" <?= ($linha->pavilhao_id == $this->session->flashdata('pavilhao')) ? 'selected' : '' ?>><?= $linha->pavilhao_nome ?> </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select> 
                            <span class="text-danger"><?php echo form_error('pavilhao'); ?></span>
                        </div> 
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="secao" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Seção</label>
                        <div class="col-xs-8 col-sm-5">
                            <input type="text" class="form-control" id="secao" value="<?= $this->session->flashdata('secao') ?>" name="secao" placeholder="Nome da nova seção">                          
                            <span class="text-danger"><?php echo form_error('secao'); ?></span>
                        </div> 
                    </div>
                    <div class="form-group" >
                        <div class="col-sm-2 col-sm-offset-7" align="right">
                            <button type="submit" class="btn btn-primary" id="enviar" onclick="">
                                Cadastrar
                            </button>
                        </div>
                    </div>
                    <div class="form-group" style="z-index: 1; overflow: auto;">                        
                        <div class="col-sm-8 col-sm-offset-2">
                            <table id='secao_cadastrada' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                <caption ALIGN='top' style='color: #337ab7'>Seções Cadastradas </caption>
                                <thead>
                                    <tr>
                                        <th>Seção</th>
                                        <th style='width: 100px;text-align:center;'>Ativo/Inativo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td colspan='2'><div class='alert alert-info' role='alert'>Selecionar pavilhão na caixa de seleção</div></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </form>
            </div>                              
        </div>
    </div>
</div>



