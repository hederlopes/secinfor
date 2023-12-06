<div style="margin-top: 10px;">
    <?php if ($this->router->fetch_class() == 'Monitoramento' && $this->router->fetch_method() == 'monitoramento') { ?>
        <ul class="nav nav-tabs">
        <?php } else { ?>
            <ul class="nav nav-tabs">
            <?php } ?>

            <li  class="<?= ($this->router->fetch_class() == 'Monitoramento' && (
                    $this->router->fetch_method() == 'monitoramento_consultas' 
                    || $this->router->fetch_method() == 'editar_monitoramento'
                    )) ? 'active' : null; ?>">
                <a href="<?= base_url('Monitoramento-Consultas') ?>">Consultas</a></li>  


            <li class="<?= ($this->router->fetch_class() == 'Monitoramento' && (
                    $this->router->fetch_method() == 'monitoramento' 
                    || $this->router->fetch_method() == 'monitoramento_form_validation' 
                    || $this->router->fetch_method() == 'cadastrar_monitoramento'
                    )) ? 'active' : null; ?>">
                <a href="<?= base_url('Monitoramento') ?>">Cadastro</a></li>

            
                <li class="<?= ($this->router->fetch_class() == 'Monitoramento' && (
                        $this->router->fetch_method() == 'monitoramento_modelos' 
                        || $this->router->fetch_method() == 'monitoramento_form_validation' 
                        || $this->router->fetch_method() == 'cadastrar_marca' 
                        || $this->router->fetch_method() ==  'editar_modelos' 
                        || $this->router->fetch_method() == 'alterar_dados_modelo'
                        )) ? 'active' : null; ?>">
                <a href="<?= base_url('Monitoramento-Modelos') ?>">Manutenção de Cadastro</a></li>
        </ul>
</div>
