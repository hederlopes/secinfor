<?php include "includes/menu_ativos_rede.php"; ?> 
<div class="row">
    <div class="col-sm-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
            <?php include "includes/sub_menu_monitoramento.php"; ?> 
            <h3 class="panel-body">Marcas/Modelos de Equipamentos</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" action="<?= base_url('Monitoramento-Cadastrar-Marcas') ?>" method="POST" enctype="multipart/form-data">                  
                    <div class="form-group" style="margin-top: 10px;">
                        <div class="col-xs-8 col-sm-7 col-sm-offset-3">
                            <?php echo $this->session->flashdata('msg'); ?>                     
                        </div> 
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="marca" class="col-xs-4 col-sm-3 control-label">Marca</label>
                        <div class="col-xs-8 col-sm-7">
                            <input type="text" class="form-control" id="marca" value="<?= $this->session->flashdata('marca') ?>" name="marca" placeholder="Marca">                          
                            <span class="text-danger"><?php echo form_error('marca'); ?></span>
                        </div> 
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="modelo" class="col-xs-4 col-sm-3 control-label">Modelo</label>
                        <div class="col-xs-8 col-sm-7">
                            <input type="text" class="form-control" id="modelo" value="<?= $this->session->flashdata('modelo') ?>" name="modelo" placeholder="Descrição completa">                          
                            <span class="text-danger"><?php echo form_error('modelo'); ?></span>
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
                            <table id='secao_cadastrada' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                <caption ALIGN='top' style='color: #337ab7'>Modelos Cadastrados </caption>
                                <thead>
                                    <tr>
                                        <th style='text-align:center;'>Marca</th>
                                        <th style='text-align:center;'>Modelo</th>
                                        <th style='text-align:center;'>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($modelo == FALSE): ?>
                                        <tr><td colspan='3'><div class='alert alert-info' role='alert'>Nenhum item cadastrado</div></td></tr>
                                    <?php else : ?>                                     
                                        <?php foreach ($modelo->result() as $linha): ?>
                                            <tr>
                                                <td style='text-align:center;'><?= $linha->equipamento_marca;?></td>
                                                <td style='text-align:center;'><?= $linha->equipamento_modelo;?></td>
                                                <td style='text-align:center;'><a class='btn btn-link' href='<?= base_url("Monitoramento-Editar-Marcas") . "/" . $linha->equipamento_id ?>' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>
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



