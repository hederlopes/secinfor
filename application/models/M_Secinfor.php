<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_Secinfor extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function  m_carregar_pavilhoes() {
        $query = "SELECT p.pavilhao_id, p.pavilhao_nome, s.secao_nome, s.secao_id FROM pavilhao as p " .
                "INNER JOIN secao as s " .
                "ON s.secao_pavilhao_id = p.pavilhao_id " .
                "ORDER BY p.pavilhao_nome";

        $consulta = $this->db->query($query);

        return $consulta;
    }
    
        function m_pavilhoes() {
        $query = "SELECT * FROM pavilhao as p " .           
                "ORDER BY p.pavilhao_nome";

        $consulta = $this->db->query($query);

        return $consulta;
    }

    function m_carregar_so() {
        $query = "SELECT software.software_nome FROM software " .
                "WHERE software.software_categoria = 'Sistema Operacional' " .
                "GROUP BY software.software_nome";

        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_cadastrar_maquinas($dados) {
        if ($this->db->insert('maquina', $dados)) {
            $secao_id = $this->db->insert_id(); //recupera ultimo id inserido
            return $secao_id;
        } else {
            return FALSE;
        }
    }

    function m_cadastrar_secao($dados) {
        if ($this->db->insert('secao', $dados)) {
//   $secao_id = $this->db->insert_id(); //recupera ultimo id inserido
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function m_listar_secoes() {
        $pavilhao_id = $this->input->post('pavilhao');
        $query = "SELECT * from  secao " .
                "WHERE secao.secao_pavilhao_id = " . $pavilhao_id . "";

        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }
    
    
        function m_secoes() {
      
        $query = "SELECT * from  secao " .
                "ORDER BY secao.secao_nome";

        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_cadastrar_software($dados) {
        if ($this->db->insert('software', $dados)) {
//   $software_id = $this->db->insert_id(); //recupera ultimo id inserido
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function m_listar_software() {
        $categoria = $this->input->post('categoria');
        $query = "SELECT * from  software " .
                "WHERE software.software_categoria = '" . $categoria . "'";

        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_listar_software_proprietario() {
        $query = "SELECT * from software WHERE software.software_categoria != 'Sistema Operacional' ORDER BY software_nome";
        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_listar_maquinas() {
        $secao_id = $this->input->post('secao');

        $query = "SELECT * from  maquina " .
                "INNER JOIN secao " .
                "ON maquina.maquina_secao_id = secao.secao_id";

        if ($secao_id != NULL) {
            $query .= " WHERE secao.secao_id = " . $secao_id . "";
        } else {
            $query .= " ORDER BY maquina.maquina_seq";
        }
//secao.secao_pavilhao_id, secao.secao_nome, 

        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_cadastrar_impressora($dados) {
        if ($this->db->insert('impressora', $dados)) {
            $impressora_id = $this->db->insert_id(); //recupera ultimo id inserido
            return $impressora_id;
        } else {
            return FALSE;
        }
    }

    function m_listar_impressoras() {
        $pavilhao = $this->input->post('pavilhao');
        $secao = $this->input->post('secao');

        $query = "SELECT * FROM maquina " .
                "INNER JOIN impressora " .
                "ON impressora.impressora_ip_pc = maquina.maquina_id " .
                "INNER JOIN secao " .
                "ON secao.secao_id = maquina.maquina_secao_id " .
                "INNER JOIN pavilhao " .
                "ON pavilhao.pavilhao_id =  secao.secao_pavilhao_id " .
                "WHERE pavilhao.pavilhao_id = '" . $pavilhao . "'";

        if ($secao != "") {
            $query .= " AND secao.secao_id = '" . $secao . "'";
        }

        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_carregar_impressora($impressora_id) {
        $query = "SELECT * FROM impressora " .
                "WHERE impressora.impressora_id = '" . $impressora_id . "'";

        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_alterar_dados_impressora($dados, $impressora_id) {
        $this->db->where('impressora_id', $impressora_id);
        if ($this->db->update('impressora', $dados)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function m_listar_maquinas_consultas() {
        $pavilhao = $this->input->post('pavilhao');
        $secao = $this->input->post('secao');

        $query = "SELECT * FROM maquina " .
                "INNER JOIN secao " .
                "ON secao.secao_id = maquina.maquina_secao_id " .
                "INNER JOIN pavilhao " .
                "ON pavilhao.pavilhao_id =  secao.secao_pavilhao_id " .
                "WHERE pavilhao.pavilhao_id = '" . $pavilhao . "'";

        if ($secao != "") {
            $query .= " AND secao.secao_id = '" . $secao . "'";
        }

        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_listar_maquinas_by_name() {
        $pesquisar = $this->input->post('pesquisar');


        $query = "SELECT * FROM maquina AS m " .
                "WHERE m.maquina_hostname LIKE '%" . $pesquisar . "%' " .
                "OR m.maquina_ip LIKE '%" . $pesquisar . "%' " .
                "OR m.maquina_tipo LIKE '%" . $pesquisar . "%' " .
                "ORDER BY m.maquina_hostname";


        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_carregar_maquina($maquina_id) {


        $query = "SELECT * FROM maquina " .
                "INNER JOIN processador " .
                "ON maquina.maquina_processador_id = processador.processador_id " .
                "INNER JOIN secao " .
                "ON secao.secao_id = maquina.maquina_secao_id " .
                "INNER JOIN pavilhao " .
                "ON pavilhao.pavilhao_id = secao.secao_pavilhao_id " .
                "WHERE maquina.maquina_id = " . $maquina_id . "";

        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_exibe_maquinas_modal() {
        $maquina_id = $this->input->post('maquina_id');

        $query = "SELECT * FROM maquina " .
                "INNER JOIN processador " .
                "ON maquina.maquina_processador_id = processador.processador_id " .
                "INNER JOIN secao " .
                "ON secao.secao_id = maquina.maquina_secao_id " .
                "INNER JOIN pavilhao " .
                "ON pavilhao.pavilhao_id = secao.secao_pavilhao_id " .
                "WHERE maquina.maquina_id = " . $maquina_id . "";

        $consulta = $this->db->query($query);

//        if ($consulta->num_rows() > 0) {
            return $consulta;
//        } else {
//            return FALSE;
//        }
    }

    function m_software_by_maquina($maquina_id, $software_id) {
        $query = "SELECT EXISTS(SELECT * FROM maq_sw " .
                "WHERE maq_sw.maq_sw_maquina_id =  " . $maquina_id . " " .
                "AND maq_sw.maq_sw_software_id = " . $software_id . ") AS retorno";
        $consulta = $this->db->query($query);
        foreach ($consulta->result() as $value) {
            $valor = $value->retorno;
        }
        return $valor;
    }

    function m_licenca_by_maquina($maquina_id, $software_id) {
        $query = "SELECT maq_sw.maq_sw_licenca FROM maq_sw " .
                "WHERE maq_sw.maq_sw_maquina_id =  " . $maquina_id . " " .
                "AND maq_sw.maq_sw_software_id = " . $software_id . "";

        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result() as $value) {
                $valor = $value->maq_sw_licenca;
            }
            return $valor;
        } else {
            return FALSE;
        }
    }

    function m_alterar_dados_maquina($dados, $maquina_id) {
        $this->db->where('maquina_id', $maquina_id);
        if ($this->db->update('maquina', $dados)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function m_estatistica_so() {
        $query = "SELECT maquina.maquina_so, COUNT(maquina.maquina_id)AS quantidade FROM maquina " .
                "GROUP BY maquina.maquina_so";
        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_estatistica_sw() {
        $query = "SELECT software.software_nome, COUNT(software.software_id) AS total, SUM(maq_sw.maq_sw_licenca) AS licenca, COUNT(software.software_id)-SUM(maq_sw.maq_sw_licenca) AS sem_licenca FROM maquina " .
                "INNER JOIN maq_sw " .
                "ON maq_sw.maq_sw_maquina_id = maquina.maquina_id " .
                "INNER JOIN software " .
                "ON maq_sw.maq_sw_software_id = software.software_id " .
                "GROUP BY software.software_nome";
        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            //  return FALSE;
        }
    }

    function m_estatistica_antivirus() {
        $query = "SELECT " .
                "IF(maquina.maquina_antivirus=1,'Instalado','Não Instalado') AS antivirus, " .
                "COUNT(maquina.maquina_id) AS quantidade " .
                "FROM maquina " .
                "GROUP BY maquina.maquina_antivirus";
        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_estatistica_hd() {
        $query = "SELECT maquina.maquina_hd, COUNT(maquina.maquina_id) AS quantidade FROM maquina GROUP BY maquina.maquina_hd";
        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_estatistica_ram() {
        $query = "SELECT maquina.maquina_ram, COUNT(maquina.maquina_id) AS quantidade FROM maquina GROUP BY maquina.maquina_ram ";
        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_relatorios_listar_so_cadastrados() {
        $query = "SELECT maquina.maquina_so FROM maquina " .
                "GROUP BY maquina.maquina_so";

        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_listar_maquinas_by_so() {
        $so = $this->input->post('so');

        $query = "SELECT * FROM maquina " .
                "INNER JOIN secao " .
                "ON secao.secao_id = maquina.maquina_secao_id " .
                "INNER JOIN pavilhao " .
                "ON pavilhao.pavilhao_id = secao.secao_pavilhao_id";

        if ($so == 'todos') {
            $query .= " ORDER BY pavilhao.pavilhao_nome";
            $consulta = $this->db->query($query);
        } else {
            $query .= " WHERE maquina.maquina_so = '" . $so . "'";
            $query .= " ORDER BY pavilhao.pavilhao_nome";
            $consulta = $this->db->query($query);
        }

        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_relatorios_listar_software() {
        $query = "SELECT software.software_nome FROM software " .
                "WHERE software.software_categoria != 'Sistema Operacional' " .
                "GROUP BY software.software_nome";

        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_listar_maquinas_by_software() {
        $software = $this->input->post('software');
        $query = "SELECT * FROM maquina " .
                "INNER JOIN maq_sw " .
                "ON maq_sw.maq_sw_maquina_id = maquina.maquina_id " .
                "INNER JOIN software " .
                "ON software.software_id = maq_sw.maq_sw_software_id " .
                "INNER JOIN secao " .
                "ON secao.secao_id = maquina.maquina_secao_id " .
                "INNER JOIN pavilhao " .
                "ON pavilhao.pavilhao_id = secao.secao_pavilhao_id";

        if ($software == 'todos') {
            $query .= " ORDER BY pavilhao.pavilhao_nome";
            $consulta = $this->db->query($query);
        } else {
            $query .= " WHERE software.software_nome = '" . $software . "'";
            $query .= " ORDER BY pavilhao.pavilhao_nome";
            $consulta = $this->db->query($query);
        }

        $consulta = $this->db->query($query);

        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_cadastrar_processador($dados) {
        if ($this->db->insert('processador', $dados)) {
            $processador_id = $this->db->insert_id(); //recupera ultimo id inserido
            return $processador_id;
        } else {
            return FALSE;
        }
    }

    function m_processadores_cadastrados() {
        $query = "SELECT * FROM processador";
        "ORDER BY processador.processador_modelo ASC";
        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_processadores_by_id($processador_id) {
        $query = "SELECT * FROM processador " .
                "WHERE processador.processador_id = " . $processador_id . "";
        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_alterar_dados_processador($dados, $processador_id) {
        $this->db->where('processador_id', $processador_id);
        if ($this->db->update('processador', $dados)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function m_listar_maquina_by_ip() {
        $ip = $this->input->post('ip');
        $query = "SELECT * FROM maquina " .
                "INNER JOIN secao " .
                "ON maquina.maquina_secao_id = secao.secao_id " .
                "WHERE maquina.maquina_ip LIKE '%" . $ip . "%'";

        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_cadastrar_falha($dados) {
        if ($this->db->insert('falha', $dados)) {
            $falha_id = $this->db->insert_id(); //recupera ultimo id inserido
            return $falha_id;
        } else {
            return FALSE;
        }
    }

    function m_listar_falha() {
        $falha = $this->input->post('falha');
        $query = "SELECT * FROM falha";

        if ($falha != NULL) {
            $query .= " WHERE falha.falha_descricao LIKE '%" . $falha . "%'";
        }

        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_listar_falha_by_id($falha_id) {
        $query = "SELECT * FROM falha "
                . "WHERE falha.falha_id = " . $falha_id . "";
        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_alterar_dados_falha($dados, $falha_id) {
        $this->db->where('falha_id', $falha_id);
        if ($this->db->update('falha', $dados)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function m_cadastrar_base_conhecimento($dados) {
        if ($this->db->insert('base_conhecimento', $dados)) {
            $base_conhecimento_id = $this->db->insert_id(); //recupera ultimo id inserido
            return $base_conhecimento_id;
        } else {
            return FALSE;
        }
    }

    function m_listar_base_conhecimento() {
        $consultar = $this->input->post('consultar');

        $query = "SELECT * FROM base_conhecimento " .
                "INNER JOIN falha " .
                "ON falha.falha_id = base_conhecimento.base_conhecimento_falha_id";

        if ($consultar != NULL) {
            $query .= " WHERE falha.falha_descricao LIKE '%" . $consultar . "%'";
            $query .= " OR base_conhecimento.base_conhecimento_causa LIKE '%" . $consultar . "%'";
            $query .= " OR base_conhecimento.base_conhecimento_palavras_chave LIKE '%" . $consultar . "%'";
        }

        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_listar_base_conhecimento_by_id($base_conhecimento_id) {
        $query = "SELECT * FROM base_conhecimento " .
                "INNER JOIN falha " .
                "ON falha.falha_id = base_conhecimento.base_conhecimento_falha_id " .
                "WHERE base_conhecimento.base_conhecimento_id = " . $base_conhecimento_id . "";

        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_alterar_dados_base_conhecimento($dados, $base_conhecimento_id) {
        $this->db->where('base_conhecimento_id', $base_conhecimento_id);
        if ($this->db->update('base_conhecimento', $dados)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function m_carrega_causas() {
        $falha = $this->input->post('falha');
        $query = "SELECT * FROM base_conhecimento " .
                "WHERE base_conhecimento.base_conhecimento_falha_id = " . $falha . "";
        $this->db->query($query);
        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_cadastrar_manutencao($dados) {
        if ($this->db->insert('manutencao', $dados)) {
            $manutencao_id = $this->db->insert_id(); //recupera ultimo id inserido
            return $manutencao_id;
        } else {
            return FALSE;
        }
    }

    function m_carregar_historico_by_maquina($maquina_id) {
        $query = "SELECT * FROM manutencao " .
                "INNER JOIN base_conhecimento " .
                "ON base_conhecimento.base_conhecimento_id = manutencao.manutencao_base_conhecimento_id " .
                "INNER JOIN falha " .
                "ON falha.falha_id = manutencao.manutencao_falha_id " .
                "WHERE manutencao.manutencao_maquina_id = " . $maquina_id . "";

        $consulta = $this->db->query($query);
        if ($consulta->num_rows() > 0) {
            return $consulta;
        } else {
            return FALSE;
        }
    }

    function m_carregar_sequencia() {
        $query = "SELECT * FROM maquina";
        $consulta = $this->db->query($query);
        foreach ($consulta->result() as $linha) {
            list($um, $dois, $tres, $quatro) = explode(".", $linha->maquina_ip);

            $this->db->where('maquina_ip', $linha->maquina_ip);
            $this->db->update('maquina', $dados = ["maquina_seq" => $quatro]);
        }

        return TRUE;
    }

}
