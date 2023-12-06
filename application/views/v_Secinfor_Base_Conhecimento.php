<?php include "includes/menu_manutencao.php"; ?> 


<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
    <h3 class="panel-body">Cadastro de Causas</h3>
            <div class="container-fluid" style="margin-top: 30px;">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('Secinfor-Base-Conhecimento-Cadastrar') ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="falha" class="col-xs-4 col-sm-3 control-label">Falha</label>
                        <div class="col-xs-8 col-sm-7">                           
                            <select class="form-control" id="falha" name="falha">
                                <option value="">Selecione uma falha... </option>
                                <?php if ($falha != FALSE): ?>
                                    <?php foreach ($falha->result() as $linha): ?>
                                <option value="<?= $linha->falha_id; ?>" <?= ($linha->falha_id == $this->session->flashdata('falha_id')) ? 'selected' : '' ?>><?= $linha->falha_descricao; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('falha'); ?></span>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="causa" class="col-xs-4 col-sm-3 control-label">Causa</label>
                        <div class="col-xs-8 col-sm-7">
                            <textarea class="form-control" id="causa" name="causa" placeholder="Causa do Problema"><?= $this->session->flashdata('causa'); ?></textarea>
                            <span class="text-danger"><?php echo form_error('causa'); ?></span>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="solucao" class="col-xs-4 col-sm-3 control-label">Solução</label>
                        <div class="col-xs-8 col-sm-7">
                            <textarea class="form-control" id="solucao" name="solucao" rows="8" placeholder="Solução Aplicada"><?= $this->session->flashdata('solucao'); ?></textarea>
                            <span class="text-danger"><?php echo form_error('solucao'); ?></span>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="licenca" class="col-xs-4 col-sm-3 control-label">Observações</label>
                        <div class="col-xs-8 col-sm-7">
                            <textarea class="form-control" id="observacoes" name="observacoes" placeholder="Informações Adicionais"><?= $this->session->flashdata('observacoes'); ?></textarea>
                            <span class="text-danger"><?php echo form_error('observacoes'); ?></span>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="palavras_chave" class="col-xs-4 col-sm-3 control-label">Palavras-Chave</label>
                        <div class="col-xs-8 col-sm-7">
                            <input type="text" class="form-control" id="palavras_chave" name="palavras_chave" value="<?= $this->session->flashdata('palavras_chave'); ?>"   placeholder="Palavras-Chave">                     
                            <span class="text-danger"><?php echo form_error('palavras_chave'); ?></span>
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