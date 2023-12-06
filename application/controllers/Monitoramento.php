<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoramento extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function monitoramento() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Monitoramento';
            $this->load->model('M_Secinfor');
            $dados['pavilhao'] = $this->M_Secinfor->m_carregar_pavilhoes();
            $this->load->model('M_Monitoramento');
            $dados['modelo'] = $this->M_Monitoramento->m_carregar_modelos();

            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function listar_secoes_select() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_secoes();

        $option = "<option value=''>Selecione uma seção...</option>";
        if ($consulta == false) {
            echo $option .= "<option value=''>Nenhuma seção cadastrada</option>";
        } else {
            foreach ($consulta->result() as $linha) {
                $option .= "<option value='$linha->secao_id;'>" . $linha->secao_nome . "</option>";
            }
            echo $option;
        }
    }

    function valida_mac() {
        $mac_address = $this->input->post('mac');
        if (preg_match('#^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$#', $mac_address) > 0) {
            echo "<span class='text-success' id='ver_mac'>Mac Adress Válido</span>";
        } else {
            echo "<span class='text-danger' id='ver_mac'>Mac Adress Inválido</span>";
        }
    }

    function valida_ip() {
        $ip = $this->input->post('ip');

        $this->load->model('M_Monitoramento');
        $validar = $this->M_Monitoramento->m_valida_ip($ip);
        // echo "<script>alert('Teste".$ip."');</script>";

        foreach ($validar->result() as $linha) {

            if ($linha->disponivel == 0) {
                // echo "<span class='text-success' id='ver_ip'>IP Disponível</span>";
                echo 1;
            } else {
                // echo "<span class='text-danger' id='ver_ip'>IP Indisponível</span>";
                echo 0;
            }
        }
    }

    function cadastrar_monitoramento() {
        $this->monitoramento_form_validation();

        if ($this->form_validation->run()) {
            $pavilhao = $this->input->post('pavilhao');
            $local = $this->input->post('local');
            $tipo = $this->input->post('tipo');
            $equipamento = $this->input->post('equipamento');
            $hostname = $this->input->post('hostname');
            $mac = $this->input->post('mac');
            $ip = $this->input->post('ip');
            $obs = $this->input->post('obs');

            $dados = [
                "monitoramento_pavilhao_id" => $pavilhao,
                "monitoramento_local" => $local,
                "monitoramento_tipo" => $tipo,
                "monitoramento_equipamento_id" => $equipamento,
                "monitoramento_hostname" => $hostname,
                "monitoramento_mac" => $mac,
                "monitoramento_ip" => $ip,
                "monitoramento_obs" => $obs,
            ];

            $this->load->model('M_Monitoramento');
            $id = $this->M_Monitoramento->m_cadastrar_monitoramento($dados);

            if ($id == TRUE) {
                $cont_msg = "<div class='alert alert-success' role='alert'>Novo dispositivo cadastrado</div>";

                $this->session->set_flashdata('msg', $cont_msg);

                // $this->monitoramento_consultas();
                redirect(base_url('Monitoramento-Consultas'));
            }
        } else {
            $this->session->set_flashdata('pavilhao', $this->input->post('pavilhao'));
            $this->session->set_flashdata('local', $this->input->post('local'));
            $this->session->set_flashdata('tipo', $this->input->post('tipo'));
            $this->session->set_flashdata('equipamento', $this->input->post('equipamento'));
            $this->session->set_flashdata('hostname', $this->input->post('hostname'));
            $this->session->set_flashdata('mac', $this->input->post('mac'));
            $this->session->set_flashdata('ip', $this->input->post('ip'));
            $this->session->set_flashdata('obs', $this->input->post('obs'));
            $this->monitoramento();
        }
    }

    function monitoramento_form_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pavilhao', 'Pavilhao', 'required');
        $this->form_validation->set_rules('local', 'Local', 'required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required');
        $this->form_validation->set_rules('equipamento', 'Modelo', 'required');
        $this->form_validation->set_rules('hostname', 'Hostname', 'required');
        $this->form_validation->set_rules('mac', 'MAC Adress', 'required');
        $this->form_validation->set_rules('ip', 'IP', 'required');
        $this->form_validation->set_rules('obs', 'Observações', 'required');
    }

    function monitoramento_consultas() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Monitoramento_Consultar';
            $this->load->model('M_Secinfor');
            $dados['pavilhao'] = $this->M_Secinfor->m_carregar_pavilhoes();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function monitoramento_por_pavilhao() {
        $this->load->model('M_Monitoramento');


        $consulta = $this->M_Monitoramento->m_monitoramento_por_pavilhao();

        $table = "";

        if ($consulta == FALSE) {
            echo $table .= "<td colspan='7'>Nenhuma equipamento cadastrado</td>";
        } else {
            foreach ($consulta->result() as $linha) {
                $table .= "<tr>";
                $table .= "<td>" . $linha->equipamento_marca . "/" . $linha->equipamento_modelo . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->monitoramento_local . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->monitoramento_tipo . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->monitoramento_hostname . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->monitoramento_ip . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->monitoramento_mac . "</td>";
                $table .= "<td ALIGN='center'><a class='btn btn-link' href='" . base_url("Monitoramento-Editar") . "/" . $linha->monitoramento_id . "' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                $table .= "</tr>";
            }
            echo $table;
        }
    }

    function editar_monitoramento() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Monitoramento_Editar';
            if ($this->uri->segment(2) == FALSE) {
                $monitoramento_id = $this->session->flashdata('monitoramento_id');
            } else {
                $monitoramento_id = $this->uri->segment(2);
            }
            $this->load->model('M_Monitoramento');
            $dados['monitoramento'] = $this->M_Monitoramento->m_editar_monitoramento($monitoramento_id);
            $dados['modelo'] = $this->M_Monitoramento->m_carregar_modelos();
            $this->load->model('M_Secinfor');
            $dados['pavilhao'] = $this->M_Secinfor->m_carregar_pavilhoes();



            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function alterar_monitoramento() {
        $this->monitoramento_form_validation();

        if ($this->form_validation->run()) {
            $monitoramento_id = $this->input->post('monitoramento_id');
            $pavilhao = $this->input->post('pavilhao');
            $local = $this->input->post('local');
            $tipo = $this->input->post('tipo');
            $equipamento = $this->input->post('equipamento');
            $hostname = $this->input->post('hostname');
            $mac = $this->input->post('mac');
            $ip = $this->input->post('ip');
            $obs = $this->input->post('obs');

            $dados = [
                "monitoramento_pavilhao_id" => $pavilhao,
                "monitoramento_local" => $local,
                "monitoramento_tipo" => $tipo,
                "monitoramento_equipamento_id" => $equipamento,
                "monitoramento_hostname" => $hostname,
                "monitoramento_mac" => $mac,
                "monitoramento_ip" => $ip,
                "monitoramento_obs" => $obs,
            ];

            $this->load->model('M_Monitoramento');
            $id = $this->M_Monitoramento->m_alterar_monitoramento($dados,$monitoramento_id );

            if ($id == TRUE) {
               // $cont_msg = "<div class='alert alert-success' role='alert'>Novo dispositivo cadastrado</div>";

          //      $this->session->set_flashdata('msg', $cont_msg);

                // $this->monitoramento_consultas();
                redirect(base_url('Monitoramento-Consultas'));
            }
        } else {
            $this->session->set_flashdata('pavilhao', $this->input->post('pavilhao'));
            $this->session->set_flashdata('local', $this->input->post('local'));
            $this->session->set_flashdata('tipo', $this->input->post('tipo'));
            $this->session->set_flashdata('equipamento', $this->input->post('equipamento'));
            $this->session->set_flashdata('hostname', $this->input->post('hostname'));
            $this->session->set_flashdata('mac', $this->input->post('mac'));
            $this->session->set_flashdata('ip', $this->input->post('ip'));
            $this->session->set_flashdata('obs', $this->input->post('obs'));
            $this->monitoramento();
        }
    }

    public function monitoramento_modelos() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Monitoramento_Modelos';
            $this->load->model('M_Monitoramento');
            $dados['modelo'] = $this->M_Monitoramento->m_carregar_modelos();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function cadastrar_marca() {
        $this->marca_form_validation();

        if ($this->form_validation->run()) {
            $marca = $this->input->post('marca');
            $modelo = $this->input->post('modelo');

            $dados = ["equipamento_marca" => $marca,
                "equipamento_modelo" => $modelo,
            ];

            $this->load->model('M_Monitoramento');
            $id = $this->M_Monitoramento->m_cadastrar_marca($dados);

            if ($id == TRUE) {
                $cont_msg = "<div class='alert alert-success' role='alert'>" . $this->input->post('marca') . "/" . $this->input->post('modelo') . " cadastrado</div>";

                $this->session->set_flashdata('msg', $cont_msg);

                $this->monitoramento_modelos();
            }
        } else {
            $this->session->set_flashdata('marca', $this->input->post('marca'));
            $this->session->set_flashdata('modelo', $this->input->post('modelo'));

            $this->monitoramento_modelos();
        }
    }

    function marca_form_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('marca', 'Marca', 'required');
        $this->form_validation->set_rules('modelo', 'Modelo', 'required');
    }

    function editar_modelos() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Monitoramento_Modelo_Editar';
            if ($this->uri->segment(2) == FALSE) {
                $equipamento_id = $this->session->flashdata('equipamento_id');
            } else {
                $equipamento_id = $this->uri->segment(2);
            }
            $this->load->model('M_Monitoramento');
            $dados['modelo'] = $this->M_Monitoramento->m_editar_modelos($equipamento_id);
            $dados['equipamento_id'] = $equipamento_id;
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    Function alterar_dados_modelo() {
        $this->marca_form_validation();

        if ($this->form_validation->run()) {

            $dados = [
                "equipamento_marca" => $this->input->post('marca'),
                "equipamento_modelo" => $this->input->post('modelo')
            ];

            $this->load->model('M_Monitoramento');
            $this->M_Monitoramento->m_alterar_dados_modelo($dados, $this->input->post('equipamento_id'));

            $this->monitoramento_modelos();
        } else {
            $this->session->set_flashdata('marca', $this->input->post('marca'));
            $this->session->set_flashdata('modelo', $this->input->post('modelo'));
            $this->session->set_flashdata('equipamento_id', $this->input->post('equipamento_id'));
            $this->editar_modelos();
        }
    }

}
