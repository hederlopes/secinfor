
<?php if ($this->router->fetch_class() == 'Secinfor' && $this->router->fetch_method() == 'manutencoes') { ?>
    <ul class="nav nav-pills">
    <?php } else { ?>
        <ul class="nav nav-pills">
        <?php } ?>
        <li  class="<?=
        ($this->router->fetch_class() == 'Secinfor' && (
        $this->router->fetch_method() == 'manutencoes' || $this->router->fetch_method() == 'manutencoes_novo' || $this->router->fetch_method() == 'cadastrar_manutencoes' || $this->router->fetch_method() == 'manutencoes_historico'
        )) ? 'active' : null;
        ?>">
            <a href="<?= base_url('Secinfor-Manutencoes') ?>">Manutenções</a></li>    
        <li class="<?=
             ($this->router->fetch_class() == 'Secinfor' && ($this->router->fetch_method() == 'falha' || $this->router->fetch_method() == 'cadastrar_falha' || $this->router->fetch_method() == 'falha_consultas' || $this->router->fetch_method() == 'falha_editar' || $this->router->fetch_method() == 'alterar_dados_falha'
             )) ? 'active' : null;
        ?>">
            <a href="<?= base_url('Secinfor-Falhas') ?>">Falhas</a></li>
        <li class="<?= ($this->router->fetch_class() == 'Secinfor' && ($this->router->fetch_method() == 'base_conhecimento' || $this->router->fetch_method() == 'cadastrar_base_conhecimento')) ? 'active' : null; ?>">
            <a href="<?= base_url('Secinfor-Base-Conhecimento') ?>">Causas da Falha</a></li>
        <li  class="<?= ($this->router->fetch_class() == 'Secinfor' && ($this->router->fetch_method() == 'base_conhecimento_consultas' || $this->router->fetch_method() == 'base_conhecimento_editar' || $this->router->fetch_method() == 'base_conhecimento_visualizar')) ? 'active' : null; ?>">
            <a href="<?= base_url('Secinfor-Base-Conhecimento-Consultas') ?>">Base Conhecimento</a></li>      
    </ul>

