<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fed extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Fed_model');
    }

    public function ready()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function change_status()
    {
        $candidate_id = $this->input->post('candidate_id');
        $this->Fed_model->update_status($candidate_id);

        echo true;
        exit;
    }

    public function index($email)
    {
        $data['title'] = 'FED';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Frk_model');
        $this->db->select('*');
        $this->db->from('frk');
        $this->db->join('fed', 'frk.id=fed.frk_id', 'inner');
        $this->db->where('fed.user_email', $email);
        $query = $this->db->get();
        $data['Fed'] = $query->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/editfed', $data);
        $this->load->view('templates/footer');
    }

    public function fed_final($email)
    {
        $data['title'] = 'FED';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->model('Frk_model');
        $this->db->select('*');
        $this->db->from('frk');
        $this->db->join('fed', 'frk.id=fed.frk_id', 'inner');
        $this->db->where('fed.user_email', $email);
        $query = $this->db->get();
        $data['Fed'] = $query->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/fed_final', $data);
        $this->load->view('templates/footer');
    }

    public function ubahFed()
    {
        $data['title'] = 'Form Penilaian Realisasi FED';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $email = $this->session->userdata('email');
        $this->form_validation->set_rules('ak', 'Angka Kredit', 'required');
        $this->form_validation->set_rules('output', 'Output', 'required');
        $this->form_validation->set_rules('mutu', 'Mutu/Kualitas', 'required');
        $this->form_validation->set_rules('waktu', 'Waktu Kegiatan', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/ubahfed', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Fed_model->ubahFed();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('admin/editfed');
        }
    }
}
