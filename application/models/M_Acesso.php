<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_Acesso extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function m_logar($usuario, $senha) {
        $this->db->where('acesso_usuario', $usuario);     
        $this->db->where('acesso_senha', $senha);
        $query = $this->db->get('acesso');

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

   

   
}
