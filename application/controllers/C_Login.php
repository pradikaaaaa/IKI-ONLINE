<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Login extends CI_Controller
{

    var $hasilLogin;
    var $firebase;

    public function __construct()
    {
        parent::__construct();
        $this->firebase  = $this->firebase->init();
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function login()
    {
        //cek login
        $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_cek_email');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->index();
        } else {
            # code...

            // var_dump($this->hasilLogin);
            $this->session->set_userdata('log_in', $this->hasilLogin);
            redirect('C_Dashboard', 'refresh');
        }
    }

    public function logout()
    {

        $this->session->unset_userdata('log_in');
        redirect('C_Login', 'refresh');
    }

    public function cek_email()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $firebase = $this->firebase;

        $auth = $firebase->getAuth();
        $db  = $firebase->getDatabase();

        //cek di tabel pandaan/akun_karyawan
        $get = $db->getReference('Pandaan/Akun_Karyawan')
            ->orderByChild('email')
            ->equalTo($email)
            ->getValue();

        //jika tidak kosong
        if (!empty($get)) {
            //coba login
            try {
                //login auth
                $signInResult = $auth->signInWithEmailAndPassword($email, $pass);
                $data = $signInResult->data();


                $this->hasilLogin = $this->get_data($data['localId']);
                $this->hasilLogin['uid'] = $data['localId'];
                return true;
            } catch (\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e) {
                //jika login gagal
                $this->form_validation->set_message('cek_email', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Gagal login</div>');
                return false;
            }
        } else {
            //jika tidak ditemukan ditabel karyawan
            $this->form_validation->set_message('cek_email', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Email</strong> tidak ditemukan</div>');
            return false;
        }
    }

    public function get_data($uid)
    {
        $db  = $this->firebase->getDatabase();
        //mengambil data
        $get = $db->getReference('Pandaan/Akun_Karyawan/' . $uid)
            ->getValue();

        return $get;
    }
}
        
    /* End of file  C_Login.php */
