<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Acesso extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('v_Acesso');
    }

    public function logar() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('usuario', 'Usuário', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required');
        if ($this->form_validation->run()) {
            //true
            $usuario = $this->input->post('usuario');
            $senha = md5($this->input->post('senha'));
            //model
            $this->load->model("M_Acesso");
            if ($this->M_Acesso->m_logar($usuario, $senha)) {
                $session_data = array(
                    'status' => "On-line"
                );
                $this->load->library('session');
                $this->session->set_userdata($session_data);
                redirect(base_url('Secinfor-Estatisticas'));
            } else {
                $this->session->set_flashdata('error', 'Usuário/Senha Inválida');
                redirect(base_url('Acesso'));
            }
        } else {
            //false
            $this->load->view('v_Acesso');
        }
    }

    function logout() {      
        session_destroy();
        redirect(base_url('Acesso'));
    }

//    function alterar_senha() {
//        $this->load->view('v_Alterar_Senha');
//    }
//
//    function altera_senha() {
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules('senha_antiga', 'Senha Anterior', 'required');
//        $this->form_validation->set_rules('senha', 'Nova Senha', 'required');
//        $this->form_validation->set_rules('confirma_senha', 'Confirma Senha', 'required');
//        if ($this->form_validation->run()) {
//            //true
//            $antiga_senha = md5($this->input->post('senha_antiga'));
//            $nova_senha = md5($this->input->post('senha'));
//            $confirma_senha = md5($this->input->post('confirma_senha'));
//
//            //model
//            $this->load->model("M_Acesso");
//            $senha_gravada = $this->M_Acesso->senha($this->session->userdata('usuario_id'));
//            if (($confirma_senha == $nova_senha) && ($senha_gravada == $antiga_senha)) {
//                $dados = ["usuario_primeiro_acesso" => 0,
//                    "usuario_senha" => $nova_senha
//                ];
//                $this->db->where('usuario_id', $this->session->userdata('usuario_id'));
//                $this->db->update('usuario', $dados);
//                $this->session->set_flashdata('codigo_mensagem', 2);
//                redirect(base_url('Mensagem'));
//            } else {
//                $this->session->set_flashdata('error_alterar_senha', 'Ocorreu um erro. Senha anterior ou Nova senha não conferem');
//
//                redirect(base_url('Alterar-Senha'));
//            }
//        } else {
//            //false
//
//            $this->alterar_senha();
//        }
//    }

}
