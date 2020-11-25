<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Warung extends CI_Controller
{

    public function index()
    {
        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();

        $ref = "Pandaan/Akun_Resto";
        $data['data_resto'] = $db->getReference($ref)->getValue();
        $this->load->view('warung/view_data_warung', $data);
    }

    public function form_tambah()
    {
        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();

        $ref = "Pandaan/Akun_Sales";
        $data['data_sales'] = $db->getReference($ref)->getValue();
        $this->load->view('warung/add_data_warung', $data);
    }

    public function form_edit($id)
    {
        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();

        $ref = "Pandaan/Akun_Resto";
        $data['id'] = $id;
        $data['data_sales'] = $db->getReference('Pandaan/Akun_Sales')->getValue();
        $data['data_warung'] = $db->getReference($ref)->getChild($id)->getValue();
        $this->load->view('warung/edit_data_warung', $data);
    }

    public function add_data()
    {

        $this->form_validation->set_rules('email', 'Email', 'callback_cek_email');
        $this->form_validation->set_rules('password', 'Password', 'min_length[8]');


        //cek validasi
        if ($this->form_validation->run() == false) {
            # code...
            $this->form_tambah();
        } else {
            # code...
            $nama = $this->input->post('namapemilik');
            $email = $this->input->post('email');
            $pass = $this->input->post('password');

            $namawarung = $this->input->post('namawarung');
            $nib = $this->input->post('nib');
            $sales = $this->input->post('sales');
            $lat = $this->input->post('lat');
            $long = $this->input->post('long');
            $alamat = $this->input->post('alamat');


            $foto = $this->input->post('foto_warung');

            $firebase = $this->firebase->init();
            $db  = $firebase->getDatabase();
            $auth = $firebase->getAuth();
            $storage = $firebase->getStorage();
            $bucket = $storage->getBucket();

            $auth->createUserWithEmailAndPassword($email, $pass);
            $getUser = $auth->getUserByEmail($email);
            $idUser = $getUser->uid;

            $new_name = time() . $_FILES["foto_warung"]['name'];
            $bucket->upload(
                file_get_contents($_FILES['foto_warung']['tmp_name']),
                [
                    'name' => 'Warung/' . $idUser . '/daftar/' . $new_name
                ]
            );

            $url = "https://firebasestorage.googleapis.com/v0/b/ikijekpandaan-3bb02.appspot.com/o/";

            $nama_foto = $url . 'Warung%2f' . $idUser . '%2fdaftar%2f' . $new_name . "?alt=media&token=";

            $data = [
                'alamat' => $alamat,
                'area' => 'Pandaan',
                'email' => $email,
                'kode_sales' => $sales,
                'latitude' => $lat,
                'longitude' => $long,
                'namapemilik' => $nama,
                'namatoko' => $namawarung,
                'nib' => $nib,
                'foto' => $nama_foto,
                'password' => $pass,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $ref = "Pandaan/Akun_Resto/" . $idUser;
            $insertData = $db->getReference($ref)->set($data);

            $this->send_email();
            redirect('C_Warung', 'refresh');
        }
    }

    public function edit_data()
    {
        $nama = $this->input->post('namapemilik');
        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        $namawarung = $this->input->post('namawarung');
        $nib = $this->input->post('nib');
        $sales = $this->input->post('sales');
        $lat = $this->input->post('lat');
        $long = $this->input->post('long');
        $alamat = $this->input->post('alamat');
        $idUser = $this->input->post('id');

        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();
        $data = [
            'alamat' => $alamat,
            'area' => 'Pandaan',
            'email' => $email,
            'kode_sales' => $sales,
            'latitude' => $lat,
            'longitude' => $long,
            'namapemilik' => $nama,
            'namatoko' => $namawarung,
            'nib' => $nib,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $ref = "Pandaan/Akun_Resto/" . $idUser;
        $updateData = $db->getReference($ref)->update($data);
        redirect('C_Warung', 'refresh');
    }

    public function delete_data($id)
    {
        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();
        $auth = $firebase->getAuth();

        $ref = "Pandaan/Akun_Resto/" . $id;
        $deleteUser = $auth->deleteUser($id);
        $deleteData = $db->getReference($ref)->remove();

        redirect('C_Warung', 'refresh');
    }

    public function send_email()
    {
        $this->load->library('mailer');

        $email_penerima = $this->input->post('email');
        $namawarung = $this->input->post('namawarung');
        $subjek = 'Pendaftaran IKI Warung';
        $pass = $this->input->post('password');

        $data['nama'] = $namawarung;
        $data['email'] = $email_penerima;
        $data['password'] = $pass;
        $content = $this->load->view('content/body-email-warung', $data, true);


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
        
    /* End of file  C_Warung.php */
