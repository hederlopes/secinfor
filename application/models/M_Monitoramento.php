<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_Monitoramento extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function m_cadastrar_monitoramento($dados) {
        if ($this->db->insert('monitoramento', $dados)) {
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

        $query = "SELECT EXISTS (SELECT * FROM monitoramento " .
                "WHERE monitoramento.monitoramento_ip = '" . $ip . "') AS disponivel";

        $consulta = $this->db->query($query);
        return $consulta;
    }

    function m_monitoramento_por_pavilhao() {
        $pavilhao = $this->input->post('pavilhao');
        $query = "SELECT * FROM monitoramento AS m " .
                "INNER JOIN equipamento AS e " .
                "ON e.equipamento_id = m.monitoramento_equipamento_id " .
                "WHERE m.monitoramento_pavilhao_id =  " . $pavilhao . " ";

        $consulta = $this->db->query($query);
        if ($consulta != FALSE) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_editar_monitoramento($monitoramento_id) {
        
        $query = "SELECT * FROM monitoramento AS m " .
                "INNER JOIN equipamento AS e " .
                "ON e.equipamento_id = m.monitoramento_equipamento_id " .
                "WHERE m.monitoramento_id =  " . $monitoramento_id . " ";

        $consulta = $this->db->query($query);
//        if ($consulta != FALSE) {
            return $consulta;
//        } else {
//            return FALSE;
//        }
    }
    
    
        function m_alterar_monitoramento($dados, $monitoramento_id) {
        $this->db->where('monitoramento_id', $monitoramento_id);
        if ($this->db->update('monitoramento', $dados)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
