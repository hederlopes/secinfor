<div style="margin-top: 10px;">
    <?php if ($this->router->fetch_class() == 'Antena' && $this->router->fetch_method() == 'antena') { ?>
        <ul class="nav nav-tabs">
        <?php } else { ?>
            <ul class="nav nav-tabs">
            <?php } ?>

            <li  class="<?= ($this->router->fetch_class() == 'Antena' && (
                    $this->router->fetch_method() == 'antena_consultas' 
                    || $this->router->fetch_method() == 'editar_antena'
                    )) ? 'active' : null; ?>">
                <a href="<?= base_url('Antena-Consultas') ?>">Consultas</a></li>  


            <li class="<?= ($this->router->fetch_class() == 'Antena' && (
                    $this->router->fetch_method() == 'antena' 
                    || $this->router->fetch_method() == 'antena_form_validation' 
                    || $this->router->fetch_method() == 'cadastrar_antena'
                    )) ? 'active' : null; ?>">
                <a href="<?= base_url('Antena') ?>">Cadastro</a></li>

            
                <li class="<?= ($this->router->fetch_class() == 'Antena' && (
                        $this->router->fetch_method() == 'antena_modelos' 
                        || $this->router->fetch_method() == 'antena_form_validation' 
                        || $this->router->fetch_method() == 'cadastrar_marca' 
                        || $this->router->fetch_method() ==  'editar_modelos' 
                        || $this->router->fetch_method() == 'alterar_dados_modelo'
                        )) ? 'active' : null; ?>">
                <a href="<?= base_url('Antena-Modelos') ?>">Manutenção de Cadastro</a></li>
        </ul>
</div>
