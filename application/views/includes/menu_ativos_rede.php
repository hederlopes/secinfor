
<?php if ($this->router->fetch_class() == 'Secinfor' && $this->router->fetch_method() == 'maquinas') { ?>
    <ul class="nav nav-pills">
    <?php } else { ?>
        <ul class="nav nav-pills">
        <?php } ?>
            
            
        <li class="<?= ($this->router->fetch_class() == 'Secinfor' && (
                   $this->router->fetch_method() == 'maquinas' 
                || $this->router->fetch_method() == 'maquinas_consultas' 
                || $this->router->fetch_method() == 'maquinas_editar' 
                || $this->router->fetch_method() == 'alterar_dados_maquina' 
                || $this->router->fetch_method() == 'cadastrar_maquinas'
                || $this->router->fetch_method() == 'processadores' 
                || $this->router->fetch_method() == 'cadastrar_processador' 
                || $this->router->fetch_method() == 'processadores_editar')) ? 'active' : null; ?>">
            <a href="<?= base_url('Secinfor-Maquinas-Consultas') ?>">Computadores</a></li>
        <li  class="<?= ($this->router->fetch_class() == 'Secinfor' && (
                   $this->router->fetch_method() == 'impressoras' 
                || $this->router->fetch_method() == 'impressoras_consultas' 
                || $this->router->fetch_method() == 'impressoras_editar' 
                || $this->router->fetch_method() == 'alterar_dados_impressora' 
                || $this->router->fetch_method() == 'cadastrar_impressoras')) ? 'active' : null; ?>">
            <a href="<?= base_url('Secinfor-Impressoras-Consultas') ?>">Impressoras</a></li>
          
        <li  class="<?= ($this->router->fetch_class() == 'Monitoramento' && (
                   $this->router->fetch_method() == 'monitoramento' 
                || $this->router->fetch_method() == 'monitoramento_consultas'
                || $this->router->fetch_method() == 'monitoramento_modelos' 
                || $this->router->fetch_method() == 'cadastrar_marca' 
                || $this->router->fetch_method() == 'editar_modelos'
                || $this->router->fetch_method() == 'alterar_dados_modelo'
                || $this->router->fetch_method() == 'cadastrar_monitoramento'
                || $this->router->fetch_method() == 'editar_monitoramento'
                )) ? 'active' : null; ?>">
            <a href="<?= base_url('Monitoramento-Consultas') ?>">Monitoramento</a></li>
       
        
           <li  class="<?= ($this->router->fetch_class() == 'Antena' && (
                   $this->router->fetch_method() == 'antena' 
                || $this->router->fetch_method() == 'antena_consultas'
                || $this->router->fetch_method() == 'antena_modelos' 
                || $this->router->fetch_method() == 'cadastrar_marca' 
                || $this->router->fetch_method() == 'editar_modelos'
                || $this->router->fetch_method() == 'alterar_dados_modelo'
                || $this->router->fetch_method() == 'cadastrar_antena'
                || $this->router->fetch_method() == 'editar_antena'
                )) ? 'active' : null; ?>">
            <a href="<?= base_url('Antena-Consultas') ?>">Antenas</a></li>
       
        
        
        
        
    

    </ul>

