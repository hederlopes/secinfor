<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permissao {

    private $CI; // Receberá a instância do Codeigniter
    private $permissaoView = 'sem-permissao'; // Recebe o nome da view correspondente à página informativa de usuário sem permissão de acesso
    private $loginView = 'acesso'; // Recebe o nome da view correspondente à tela de login

    public function __construct() {
        /*
         * Criamos uma instância do CodeIgniter na variável $CI
         */
        $this->CI = &get_instance();
    }

    function CheckPermissao($classe, $metodo, $usuario) {
        /*
         * Pesquisa usuario, classe e o método passados como parâmetro em CheckPermissao
         */
       
        $query = "SELECT * FROM usuario INNER JOIN perfil ON usuario.usuario_id = perfil.perfil_usuario_id INNER JOIN permissao ON permissao.permissao_id = perfil.perfil_permissao_id INNER JOIN sistema ON sistema.sistema_id = permissao.permissao_sistema_id" .
                " where usuario.usuario_id = " . $usuario . " AND" .
                " permissao.permissao_classe = '" . $classe . "' AND" .
                " permissao.permissao_metodo = '" . $metodo . "'";

        $consulta = $this->CI->db->query($query);

         if ($consulta->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

}
