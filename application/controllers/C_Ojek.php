<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Ojek extends CI_Controller
{

    var $firebase;

    public function __construct()
    {
        parent::__construct();
        $this->firebase  = $this->firebase->init();

        $cek_session = $this->session->userdata('log_in');
        if (empty($cek_session)) {
            redirect('C_Login', 'refresh');
        }
    }

    public function index()
    {
        $db  = $this->firebase->getDatabase();

        $ref = "Pandaan/Akun_Driver";
        $data['data_ojek'] = $db->getReference($ref)->getValue();
        $this->load->view('ojek/view_data_ojek', $data);
    }

    public function form_tambah()
    {
        $this->load->view('ojek/add_data_ojek');
    }

    public function form_edit($id)
    {
        $db  = $this->firebase->getDatabase();

        $ref = "Pandaan/Akun_Driver";
        $data['id'] = $id;
        $data['data_ojek'] = $db->getReference($ref)->getChild($id)->getValue();
        $this->load->view('ojek/edit_data_ojek', $data);
    }

    public function add_data()
    {

        $this->form_validation->set_rules('email', 'Email', 'callback_cek_email');
        $this->form_validation->set_rules('password', 'Password', 'min_length[8]');
        $this->form_validation->set_rules('nohp', 'Nomor HP', 'min_length[11]|max_length[12]');


        //cek validasi
        if ($this->form_validation->run() == false) {
            # code...
            $this->form_tambah();
        } else {
            # code...
            $nik = $this->input->post('nik');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $pass = $this->input->post('password');
            $jk = $this->input->post('jk');
            $username = $this->input->post('username');

            $no_hp = $this->input->post('nohp');
            $motor = $this->input->post('motor');
            $plat = $this->input->post('platnomor');
            // $foto = $this->input->post('foto_ojek');

            $db  = $this->firebase->getDatabase();
            $auth = $this->firebase->getAuth();
            $storage = $this->firebase->getStorage();
            $bucket = $storage->getBucket();

            $auth->createUserWithEmailAndPassword($username, $pass);

            $getUser = $auth->getUserByEmail($username);
            $idUser = $getUser->uid;

            $new_name = time() . $_FILES["foto_ojek"]['name'];
            $bucket->upload(
                file_get_contents($_FILES['foto_ojek']['tmp_name']),
                [
                    'name' => 'Ojek/' . $idUser . '/profile/' . $new_name
                ]
            );


            $url = "https://firebasestorage.googleapis.com/v0/b/ikijekpandaan-3bb02.appspot.com/o/";

            $nama_foto = $url . 'Ojek%2f' . $idUser . '%2fprofile%2f' . $new_name . "?alt=media&token=";

            $data = [
                'nik' => $nik,
                'email' => $email,
                'foto' => $nama_foto,
                'hati' => 3,
                'kodeorder' => '',
                'nama' => $nama,
                'motor' => $motor,
                'jenis_kelamin' => $jk,
                'notelp' => $no_hp,
                'platnomor' => $plat,
                'username' => $username,
                'password' => $pass,
                'point' => '0.0',
                'rating' => '0.0',
                'saldo' => '0',
                'saldohariini' => '0',
                'uidtoko' => '',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $ref = "Pandaan/Akun_Driver/" . $idUser;
            $db->getReference($ref)->set($data);
            $this->send_email();

            redirect('C_Ojek', 'refresh');
        }
    }

    public function edit_data()
    {
        $nama = $this->input->post('nama');
        $nik = $this->input->post('nik');
        $jk = $this->input->post('jk');

        $no_hp = $this->input->post('nohp');
        $motor = $this->input->post('motor');
        $plat = $this->input->post('platnomor');
        $idUser = $this->input->post('id');

        $db  = $this->firebase->getDatabase();
        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'jenis_kelamin' => $jk,
            'motor' => $motor,
            'notelp' => $no_hp,
            'platnomor' => $plat,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $ref = "Pandaan/Akun_Driver/" . $idUser;
        $db->getReference($ref)->update($data);
        redirect('C_Ojek', 'refresh');
    }

    public function delete_data($id)
    {
        $db  = $this->firebase->getDatabase();
        $auth = $this->firebase->getAuth();

        $ref = "Pandaan/Akun_Driver/" . $id;
        //delete user auth
        $auth->deleteUser($id);
        //delete data firebase
        $db->getReference($ref)->remove();

        redirect('C_Ojek', 'refresh');
    }

    public function send_email()
    {
        $this->load->library('mailer');

        $email_penerima = $this->input->post('email');
        $namadriver = $this->input->post('nama');
        $username = $this->input->post('username');
        $subjek = 'Pendaftaran IKI Ojek';
        $pass = $this->input->post('password');

        $data['nama'] = $namadriver;
        $data['email'] = $username;
        $data['password'] = $pass;
        $content = $this->load->view('content/body-email-ojek', $data, true);


        $sendmail = array(
            'email_penerima' => $email_penerima,
            'subjek' => $subjek,
            'content' => $content
        );

        $this->mailer->send($sendmail);
    }

    public function cek_email()
    {
        $email = $this->input->post('email');
        $auth = $this->firebase->getAuth();
        try {
            $cekEmail = $auth->getUserByEmail($email);
            $this->form_validation->set_message('cek_email', 'Email sudah terdaftar');
            return false;
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            return true;
        }
    }
}
        
    /* End of file  C_Ojek.php */
