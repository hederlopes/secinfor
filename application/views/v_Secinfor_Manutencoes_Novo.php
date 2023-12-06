<?php include "includes/menu_manutencao.php"; ?> 

<script type="text/javascript">
    // JavaScript Document
    var base_url = '<?= base_url() ?>';


    function carrega_causas(falha) {
          $.post(base_url + "Secinfor/carrega_causas", {
            falha: falha
        }, function (data) {
            $('#causa').html(data);
        });
    }
    
    function MascaraCampoGeral(dom, tipo) {
        switch (tipo) {
            case 'number':
                var regex = /[A-za-z]/g;
                break;

            case 'text':
                var regex = /\d/g;
                break;
        }
        dom.value = dom.value.replace(regex, "");
    }



</script>

<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
            <h3 class="panel-body">Nova Manutenção</h3>
            <div class="container-fluid" style="margin-top: 30px;">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('Secinfor-Manutencoes-Cadastrar') ?>" enctype="multipart/form-data">
                    <div class="text text-info text-justify">
                        <?php if ($maquina != FALSE): ?> 
                            <?php foreach ($maquina->result() as $linha): ?> 
                                <div class="form-group">
                                    <div class="col-sm-4" >
                                        <label>Tipo:</label> <?= $linha->maquina_tipo ?> 
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Modelo:</label> <?= $linha->maquina_modelo ?> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4" >
                                        <label>Hostname:</label> <?= $linha->maquina_hostname ?> 
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>MAC: </label> <?= $linha->maquina_maclan ?> 
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>IP:</label> <?= $linha->maquina_ip ?> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" >
                                        <label>Sistema Operacional: </label> <?= $linha->maquina_so ?> <?= $linha->maquina_licenca ?>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" >
                                        <label>Processador:</label> <?= $linha->processador_modelo ?>   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4" >
                                        <label>RAM:</label> <?= $linha->maquina_ram ?>    
                                    </div>
                                    <div class="col-sm-4" >
                                        <label>Capacidade HD: </label> <?= $linha->maquina_hd ?> <br>
                                    </div>
                                    <div class="col-sm-4" >
                                        <label>Antivírus CT:</label> <?= ($linha->maquina_antivirus == 1) ? "Instalado" : "<spam style='color: red;'><b>Não Instalado</b></spam>" ?>     
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <input type="hidden" class="form-control" id="maquina_id" name="maquina_id" value="<?= $linha->maquina_id ?>">                     
                        <?php endforeach; ?> 
                    <?php endif; ?> 
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="data" class="col-xs-4 col-sm-3 control-label">Data</label>
                        <div class="col-xs-8 col-sm-5">
                            <input type="date" class="form-control" id="data" name="data" value="<?= $this->session->flashdata('data'); ?>">                     
                            <span class="text-danger"><?php echo form_error('data'); ?></span>
                        </div> 
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="lacre" class="col-xs-4 col-sm-3 control-label">Lacre</label>
                        <div class="col-xs-8 col-sm-7">
                            <input type="number" class="form-control" id="lacre" name="lacre" onkeyup="MascaraCampoGeral(this, 'number');" maxlength="6" min="000001" value="<?= $this->session->flashdata('lacre'); ?>" placeholder="Número do Lacre">  
                            <span class="text-danger"><?php echo form_error('lacre'); ?></span>
                        </div> 
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="falha" class="col-xs-4 col-sm-3 control-label">Falha</label>
                        <div class="col-xs-8 col-sm-7">                           
                            <select class="form-control" id="falha" name="falha" onchange="carrega_causas(this.value);">
                                <option value=''>Selecione...</option>
                                <?php if ($falha != false): ?>
                                    <?php foreach ($falha->result() as $linha) : ?>
                                        <option value="<?= $linha->falha_id ?>" <?= ($linha->falha_id == $this->session->flashdata('falha')) ? 'selected' : '' ?>><?= $linha->falha_descricao ?> </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select> 
                            <span class="text-danger"><?php echo form_error('falha'); ?></span>
                        </div> 
                    </div>
                            
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="causa" class="col-xs-4 col-sm-3 control-label">Causa</label>
                        <div class="col-xs-8 col-sm-7">                           
                            <select class="form-control" id="causa" name="causa">
                                <option value=''>Selecione uma falha...</option>
                  
                            </select> 
                            <span class="text-danger"><?php echo form_error('causa'); ?></span>
                        </div> 
                    </div>        

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="componetes" class="col-xs-4 col-sm-3 control-label">Componentes</label>
                        <div class="col-xs-8 col-sm-7">
                            <textarea class="form-control" id="componetes" name="componetes" placeholder="Houve troca de componentes?"><?= $this->session->flashdata('componetes'); ?></textarea>
                            <span class="text-danger"><?php echo form_error('componetes'); ?></span>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="licenca" class="col-xs-4 col-sm-3 control-label">Observações</label>
                        <div class="col-xs-8 col-sm-7">
                            <textarea class="form-control" id="observacoes" name="observacoes" placeholder="Informações Adicionais"><?= $this->session->flashdata('observacoes'); ?></textarea>
                            <span class="text-danger"><?php echo form_error('observacoes'); ?></span>
                        </div>
                    </div>


                    <div class="form-group" >
                        <div class="col-xs-12 col-sm-2 col-sm-offset-8" align="right">
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