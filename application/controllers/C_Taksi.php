<?php

use Google\Cloud\Storage\StorageClient;

defined('BASEPATH') or exit('No direct script access allowed');

class C_Taksi extends CI_Controller
{

    public function index()
    {
        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();

        $ref = "Pandaan/Akun_Mobil";
        $data['data_taksi'] = $db->getReference($ref)->getValue();
        $this->load->view('taksi/view_data_taksi', $data);
    }

    public function form_tambah()
    {
        $this->load->view('taksi/add_data_taksi');
    }

    public function form_edit($id)
    {
        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();

        $ref = "Pandaan/Akun_Mobil";
        $data['id'] = $id;
        $data['data_taksi'] = $db->getReference($ref)->getChild($id)->getValue();
        $this->load->view('taksi/edit_data_taksi', $data);
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

            $no_hp = $this->input->post('nohp');
            $motor = $this->input->post('mobil');
            $plat = $this->input->post('platnomor');
            $foto = $this->input->post('foto_mobil');

            $firebase = $this->firebase->init();
            $db  = $firebase->getDatabase();
            $auth = $firebase->getAuth();
            $storage = $firebase->getStorage();
            $bucket = $storage->getBucket();

            $auth->createUserWithEmailAndPassword($email, $pass);

            $getUser = $auth->getUserByEmail($email);
            $idUser = $getUser->uid;

            $new_name = time() . $_FILES["foto_mobil"]['name'];
            $bucket->upload(
                file_get_contents($_FILES['foto_mobil']['tmp_name']),
                [
                    'name' => 'Taksi/' . $idUser . '/profile/' . $new_name
                ]
            );


            $url = "https://firebasestorage.googleapis.com/v0/b/ikijekpandaan-3bb02.appspot.com/o/";

            $nama_foto = $url . 'Taksi%2f' . $idUser . '%2fprofile%2f' . $new_name . "?alt=media&token=";

            $data = [
                'nik' => $nik,
                'email' => $email,
                'foto' => $nama_foto,
                'hati' => 3,
                'kodeorder' => '',
                'nama' => $nama,
                'jenis_kelamin' => $jk,
                'motor' => $motor,
                'notelp' => $no_hp,
                'platnomor' => $plat,
                'password' => $pass,
                'point' => '0.0',
                'rating' => '0.0',
                'saldo' => '0',
                'saldohariini' => '0',
                'uidtoko' => '',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $ref = "Pandaan/Akun_Mobil/" . $idUser;
            $db->getReference($ref)->set($data);
            $this->send_email();

            redirect('C_Taksi', 'refresh');
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

        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();
        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'jenis_kelamin' => $jk,
            'motor' => $motor,
            'notelp' => $no_hp,
            'platnomor' => $plat,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $ref = "Pandaan/Akun_Mobil/" . $idUser;
        $updateData = $db->getReference($ref)->update($data);
        redirect('C_Taksi', 'refresh');
    }

    public function delete_data($id)
    {
        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();
        $auth = $firebase->getAuth();

        $ref = "Pandaan/Akun_Mobil/" . $id;
        $deleteUser = $auth->deleteUser($id);
        $deleteData = $db->getReference($ref)->remove();

        redirect('C_Taksi', 'refresh');
    }

    public function send_email()
    {
        $this->load->library('mailer');

        $email_penerima = $this->input->post('email');
        $namadriver = $this->input->post('nama');
        $subjek = 'Pendaftaran IKI Taksi';
        $pass = $this->input->post('password');

        $data['nama'] = $namadriver;
        $data['email'] = $email_penerima;
        $data['password'] = $pass;
        $content = $this->load->view('content/body-email-taksi', $data, true);


        $sendmail = array(
            'email_penerima' => $email_penerima,
            'subjek' => $subjek,
            'content' => $content
        );

        $send = $this->mailer->send($sendmail);
    }

    public function cek_email()
    {
        $email = $this->input->post('email');
        $firebase = $this->firebase->init();
        $auth = $firebase->getAuth();
        try {
            $cekEmail = $auth->getUserByEmail($email);
            $this->form_validation->set_message('cek_email', 'Email sudah terdaftar');
            return false;
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            return true;
        }
    }
}
        
    /* End of file  C_Taksi.php */
