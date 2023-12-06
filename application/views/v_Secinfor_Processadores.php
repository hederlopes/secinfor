<?php include "includes/menu_ativos_rede.php"; ?> 


<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px;  min-height: 700px;">
             <?php include "includes/sub_menu_maquina.php"; ?> 
            <h3 class="panel-body">Cadastro de Processadores</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('Secinfor-Processadores-Cadastrar') ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="processador" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Processador</label>
                        <div class="col-xs-8 col-sm-6">
                            <input type="text" class="form-control" id="processador" value="<?= $this->session->flashdata('processador') ?>" name="processador" placeholder="Nome do novo processador">                          
                            <span class="text-danger"><?php echo form_error('processador'); ?></span>
                        </div> 
                    </div>

                    <div class="form-group" >
                        <div class="col-sm-2 col-sm-offset-8" align="right">
                            <button type="submit" class="btn btn-primary" id="enviar" onclick="">
                                Cadastrar
                            </button>
                        </div>
                    </div>
                    <div class="form-group" style="z-index: 1; overflow: auto;">                        
                        <div class="col-sm-8 col-sm-offset-2">
                            <table id='processador_cadastrado' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                <caption ALIGN='top' style='color: #337ab7'>Processadores Cadastrados </caption>
                                <thead>
                                    <tr>
                                        <th>Processador</th>
                                        <th style='text-align:center;'>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($processador == FALSE): ?>
                                        <tr><td colspan='2'><div class='alert alert-info' role='alert'>Nenhum processador cadastrado</div></td></tr>
                                    <?php else: ?>
                                        <?php foreach ($processador->result() as $linha): ?>
                                      <tr>  <td><?= $linha->processador_modelo ?></td>
                                      <td ALIGN='center'><a class='btn btn-link' href='<?= base_url("Secinfor-Processadores-Editar") . "/" . $linha->processador_id ?>' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>
                                      </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>         
                </form>
            </div>              
        </div>
    </div>
</div>




