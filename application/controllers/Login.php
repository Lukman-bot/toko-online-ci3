<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $is_login = $this->session->userdata('is_login');

        if ($is_login) {
            redirect(base_url());
            return;
        }
    }
    
    public function index()
    {
        if (!_POST) {
            $input = (object) $this->login->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->login->validate()) {        // Jika Validasi Gagal
            $data['title'] = 'Login';
            $data['input'] = $input;
            $data['page'] = 'pages/auth/login';

            $this->view($data);

            return;
        }

        if ($this->login->run($input)) {
            $this->session->set_flashdata('success', 'Berhasil melakukan login');
            redirect(base_url());
        } else {
            $this->session->set_flashdata('error', 'E-mail/Password salah atau akun anda sedang tidak aktif');
            redirect(base_url('index.php/login'));
        }
    }
}

/* End of file Login.php */
