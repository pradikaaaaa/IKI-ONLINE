<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Warung extends CI_Controller
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

        $ref = "Pandaan/Akun_Resto";
        $data['data_resto'] = $this->coba_query();
        $this->load->view('warung/view_data_warung', $data);
    }

    public function form_tambah()
    {
        $db  = $this->firebase->getDatabase();

        $ref = "Pandaan/Akun_Sales";
        $data['data_sales'] = $db->getReference($ref)->getValue();
        $this->load->view('warung/add_data_warung', $data);
    }

    public function form_edit($id)
    {
        $db  = $this->firebase->getDatabase();

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
            $nik = $this->input->post('nik');
            $no_hp_pemilik = $this->input->post('nohppribadi');
            $alamat_pemilik = $this->input->post('alamat_pribadi');
            $email = $this->input->post('email');
            $pass = $this->input->post('password');

            $namawarung = $this->input->post('namawarung');
            $no_hp_warung = $this->input->post('nohpwarung');
            $nib = $this->input->post('nib');
            $sales = $this->input->post('sales');
            $lat = $this->input->post('lat');
            $long = $this->input->post('long');
            $alamat = $this->input->post('alamat_warung');


            $db  = $this->firebase->getDatabase();
            $auth = $this->firebase->getAuth();
            $storage = $this->firebase->getStorage();
            $bucket = $storage->getBucket();

            //buat user auth
            $auth->createUserWithEmailAndPassword($email, $pass);
            $getUser = $auth->getUserByEmail($email);
            $idUser = $getUser->uid;


            //rename foto ktp
            $foto_ktp = str_replace(" ", "-", $nama);
            $filename = $_FILES["foto_ktp"]["name"];
            $tmp = explode('.', $filename);
            $ext = end($tmp);

            $new_name_ktp = 'ktp-' . $foto_ktp . '.' . $ext;
            $bucket->upload(
                file_get_contents($_FILES['foto_ktp']['tmp_name']),
                [
                    'name' => 'Warung/' . $idUser . '/daftar/' . $new_name_ktp
                ]
            );

            $url = "https://firebasestorage.googleapis.com/v0/b/ikijekpandaan-3bb02.appspot.com/o/";

            $nama_foto_ktp = $url . 'Warung%2f' . $idUser . '%2fdaftar%2f' . $new_name_ktp . "?alt=media&token=";


            //rename foto warung
            $foto_warung = str_replace(" ", "-", $namawarung);
            $filename = $_FILES["foto_warung"]["name"];
            $tmp = explode('.', $filename);
            $ext = end($tmp);

            $new_name_warung = 'warung-' . $foto_warung . '.' . $ext;
            $bucket->upload(
                file_get_contents($_FILES['foto_warung']['tmp_name']),
                [
                    'name' => 'Warung/' . $idUser . '/daftar/' . $new_name_warung
                ]
            );

            $url = "https://firebasestorage.googleapis.com/v0/b/ikijekpandaan-3bb02.appspot.com/o/";

            $nama_foto_warung = $url . 'Warung%2f' . $idUser . '%2fdaftar%2f' . $new_name_warung . "?alt=media&token=";

            $data = [
                'alamat_warung' => $alamat,
                'alamat_pemilik' => $alamat_pemilik,
                'email' => $email,
                'kode_sales' => $sales,
                'latitude' => $lat,
                'longitude' => $long,
                'namapemilik' => $nama,
                'namatoko' => $namawarung,
                'nib' => $nib,
                'nik' => $nik,
                'no_hp_warung' => $no_hp_warung,
                'no_hp_pemilik' => $no_hp_pemilik,
                'fotoktp' => $nama_foto_ktp,
                'fotowarung' => $nama_foto_warung,
                'password' => $pass,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $l = [
                '0' => floatval($lat),
                '1' => floatval($long)
            ];

            $this->load->library('GeoFire');
            $lokasi = [
                'g' => $this->geofire->generate($lat, $long),
                'l' => $l
            ];

            $resto = [
                'gambar' => $nama_foto_warung,
                'harga' => "0",
                'id' => $idUser,
                'kode_sales' => $sales,
                'latitude' => $lat,
                'longitude' => $long,
                'nama' => "",
                'penjual' => $namawarung,
                'status' => "Tutup"
            ];

            $ref = "Pandaan/Akun_Resto/" . $idUser;
            $db->getReference($ref)->set($data);
            $db->getReference('Pandaan/LokasiToko/' . $idUser)->set($lokasi);
            $db->getReference('Pandaan/Resto/' . $idUser)->set($resto);

            //kirim ke email
            $this->send_email();
            // redirect('C_Warung', 'refresh');
        }
    }

    public function edit_data()
    {
        $nama = $this->input->post('namapemilik');
        $nik = $this->input->post('nik');
        $no_hp_pemilik = $this->input->post('nohppribadi');
        $alamat_pemilik = $this->input->post('alamat_pribadi');
        $email = $this->input->post('email');

        $namawarung = $this->input->post('namawarung');
        $nib = $this->input->post('nib');
        $no_hp_warung = $this->input->post('nohpwarung');
        $sales = $this->input->post('sales');
        $lat = $this->input->post('lat');
        $long = $this->input->post('long');
        $alamat_warung = $this->input->post('alamat_warung');
        $idUser = $this->input->post('id');

        $db  = $this->firebase->getDatabase();
        $data = [
            'alamat_pemilik' => $alamat_pemilik,
            'alamat_warung' => $alamat_warung,
            'email' => $email,
            'kode_sales' => $sales,
            'latitude' => $lat,
            'longitude' => $long,
            'namapemilik' => $nama,
            'namatoko' => $namawarung,
            'nik' => $nik,
            'no_hp_pemilik' => $no_hp_pemilik,
            'no_hp_warung' => $no_hp_warung,
            'nib' => $nib,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $l = [
            '0' => floatval($lat),
            '1' => floatval($long)
        ];

        $this->load->library('GeoFire');
        $lokasi = [
            'g' => $this->geofire->generate($lat, $long),
            'l' => $l
        ];

        $resto = [
            'id' => $idUser,
            'kode_sales' => $sales,
            'latitude' => $lat,
            'longitude' => $long,
            'penjual' => $namawarung,
            'status' => "Tutup"
        ];

        $ref = "Pandaan/Akun_Resto/" . $idUser;
        $db->getReference($ref)->update($data);
        $db->getReference('Pandaan/LokasiToko/' . $idUser)->update($lokasi);
        $db->getReference('Pandaan/Resto/' . $idUser)->set($resto);
        redirect('C_Warung', 'refresh');
    }

    public function edit_foto_ktp()
    {
        $nama = $this->input->post('nama');
        $idUser = $this->input->post('id');

        $db  = $this->firebase->getDatabase();
        $storage = $this->firebase->getStorage();
        $bucket = $storage->getBucket();

        //rename foto ktp
        $foto_ktp = str_replace(" ", "-", $nama);
        $filename = $_FILES["foto_ktp"]["name"];
        $tmp = explode('.', $filename);
        $ext = end($tmp);

        $new_name_ktp = 'ktp-' . $foto_ktp . '.' . $ext;
        $bucket->upload(
            file_get_contents($_FILES['foto_ktp']['tmp_name']),
            [
                'name' => 'Warung/' . $idUser . '/daftar/' . $new_name_ktp
            ]
        );

        $url = "https://firebasestorage.googleapis.com/v0/b/ikijekpandaan-3bb02.appspot.com/o/";

        $nama_foto_ktp = $url . 'Warung%2f' . $idUser . '%2fdaftar%2f' . $new_name_ktp . "?alt=media&token=";

        $data = [
            'fotoktp' => $nama_foto_ktp,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $ref = "Pandaan/Akun_Resto/" . $idUser;
        $db->getReference($ref)->update($data);
        redirect('C_Warung', 'refresh');
    }

    public function edit_foto_warung()
    {
        $namawarung = $this->input->post('nama');
        $idUser = $this->input->post('id');

        $db  = $this->firebase->getDatabase();
        $storage = $this->firebase->getStorage();
        $bucket = $storage->getBucket();

        //rename foto warung
        $foto_warung = str_replace(" ", "-", $namawarung);
        $filename = $_FILES["foto_warung"]["name"];
        $tmp = explode('.', $filename);
        $ext = end($tmp);

        $new_name_warung = 'warung-' . $foto_warung . '.' . $ext;
        $bucket->upload(
            file_get_contents($_FILES['foto_warung']['tmp_name']),
            [
                'name' => 'Warung/' . $idUser . '/daftar/' . $new_name_warung
            ]
        );

        $url = "https://firebasestorage.googleapis.com/v0/b/ikijekpandaan-3bb02.appspot.com/o/";

        $nama_foto_warung = $url . 'Warung%2f' . $idUser . '%2fdaftar%2f' . $new_name_warung . "?alt=media&token=";


        $data = [
            'fotowarung' => $nama_foto_warung,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $ref = "Pandaan/Akun_Resto/" . $idUser;
        $db->getReference($ref)->update($data);
        redirect('C_Warung', 'refresh');
    }

    public function edit_password()
    {
        $idUser = $this->input->post('id');
        $new_pass = $this->input->post('password');

        $db  = $this->firebase->getDatabase();
        $auth = $this->firebase->getAuth();
        $auth->changeUserPassword($idUser, $new_pass);

        $data = [
            'password' => $new_pass,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $ref = "Pandaan/Akun_Resto/" . $idUser;
        $db->getReference($ref)->update($data);
        redirect('C_Warung', 'refresh');
    }

    public function delete_data($id)
    {
        $db  = $this->firebase->getDatabase();
        $auth = $this->firebase->getAuth();

        $ref = "Pandaan/Akun_Resto/" . $id;

        $auth->deleteUser($id);
        $db->getReference($ref)->remove();
        $db->getReference('Pandaan/LokasiToko/' . $id)->remove();
        $db->getReference('Pandaan/Resto/' . $id)->remove();
        $db->getReference('Pandaan/Resto_Detail/' . $id)->remove();

        redirect('C_Warung', 'refresh');
    }

    public function send_email()
    {
        $this->load->library('Mailer');

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
        $auth = $this->firebase->getAuth();
        try {
            $cekEmail = $auth->getUserByEmail($email);
            $this->form_validation->set_message('cek_email', 'Email sudah terdaftar');
            return false;
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            return true;
        }
    }


    public function coba_query()
    {
        $db  = $this->firebase->getDatabase();
        //cek di tabel pandaan/akun_karyawan

        $resto = $db->getReference('Pandaan/Akun_Resto')->getValue();
        // print_r($get);
        // echo $get['nama'];
        $data_resto = array();
        foreach ($resto as $key => $value) {
            $data = array(
                'uid' => $key,
                'nama_pemilik' => $value['namapemilik'],
                'nama_warung' => $value['namatoko'],
                'alamat_warung' => $value['alamat_warung'],
                'foto' => $value['fotowarung'],
                'tanggal' => $value['created_at']
            );

            $get = $db->getReference('Pandaan/Akun_Sales')->getChild($value['kode_sales'])->getValue();
            $data['nama_sales'] = $get['nama'];

            array_push($data_resto, $data);
        }

        // echo "<pre>";
        // print_r($data_resto);
        // echo "</pre>";
        return $data_resto;
    }
}
        
    /* End of file  C_Warung.php */
