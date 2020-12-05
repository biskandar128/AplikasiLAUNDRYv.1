<?php

defined('BASEPATH') or exit('no direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('LoginModel', 'login');
        $this->load->model('CrudLaundryModel', 'laundry');
    }

    public function index()
    {
        if ($this->login->is_logged_in()) {
            $this->login->is_role() === 'Petugas' ? redirect('petugas/') : redirect('member/');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

            if ($this->form_validation->run() === true) {
                $username = $this->input->post('username', true);
                $password = $this->input->post('password', true);

                $checking = $this->login->check_login('tbl_user', ['username' => $username], ['password' => $password]);

                if ($checking !== false) {
                    foreach ($checking as $data) {
                        $session_data = [
                            'user_id' => $data->users_id,
                            'username' => $data->username,
                            'password' => $data->password,
                            'name' => $data->name,
                            'pelanggan_id' => $data->pelanggan_id,
                            'point' => $data->point,
                            'no_hp' => $data->no_hp,
                            'alamat' => $data->alamat,
                            'role' => $data->roles,
                        ];

                        $this->session->set_userdata($session_data);

                        if ($this->session->userdata('role') === 'Petugas') {
                            redirect('petugas/');
                        } elseif ($this->session->userdata('role') === 'Pelanggan') {
                            redirect('member/');
                        }
                    }
                } else {
                    $this->load->view('loginRegister/index');
                }
            } else {
                $this->load->view('loginRegister/index');
            }
        }
    }

    public function register()
    {
        $data = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'name' => $this->input->post('name'),
            'roles' => 'Pelanggan',
            'petugas_id' => null,
            'pelanggan_id' => null,
            'no_hp' => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat'),
        ];

        $this->laundry->addData('tbl_user', $data);

        $this->session->set_flashdata('flash', 'dimasukkan');

        $this->load->view('loginRegister/register');
    }
}
