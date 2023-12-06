<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_Antena extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function m_cadastrar_antena($dados) {
        if ($this->db->insert('antena', $dados)) {
//  $equipamento_id = $this->db->insert_id(); //recupera ultimo id inserido
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function m_cadastrar_marca($dados) {
        if ($this->db->insert('equipamento', $dados)) {
//  $equipamento_id = $this->db->insert_id(); //recupera ultimo id inserido
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function m_carregar_modelos() {
        $query = "SELECT * FROM equipamento " .
                "ORDER BY equipamento.equipamento_marca, equipamento.equipamento_modelo";

        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_editar_modelos($equipamento_id) {
        $query = "SELECT * FROM equipamento " .
                "WHERE equipamento.equipamento_id = " . $equipamento_id . "";

        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_alterar_dados_modelo($dados, $equipamento_id) {
        $this->db->where('equipamento_id', $equipamento_id);
        if ($this->db->update('equipamento', $dados)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function m_valida_ip($ip) {

        $query = "SELECT EXISTS (SELECT * FROM antena " .
                "WHERE antena.antena_ip = '" . $ip . "') AS disponivel";

        $consulta = $this->db->query($query);
        return $consulta;
    }

    function m_antena_por_pavilhao() {
        $pavilhao = $this->input->post('pavilhao');
        $query = "SELECT * FROM antena AS m " .
                "INNER JOIN equipamento AS e " .
                "ON e.equipamento_id = m.antena_equipamento_id " .
                "WHERE m.antena_pavilhao_id =  " . $pavilhao . " ";

        $consulta = $this->db->query($query);
        if ($consulta != FALSE) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_editar_antena($antena_id) {
        
        $query = "SELECT * FROM antena AS m " .
                "INNER JOIN equipamento AS e " .
                "ON e.equipamento_id = m.antena_equipamento_id " .
                "WHERE m.antena_id =  " . $antena_id . " ";

        $consulta = $this->db->query($query);
//        if ($consulta != FALSE) {
            return $consulta;
//        } else {
//            return FALSE;
//        }
    }
    
    
        function m_alterar_antena($dados, $antena_id) {
        $this->db->where('antena_id', $antena_id);
        if ($this->db->update('antena', $dados)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
