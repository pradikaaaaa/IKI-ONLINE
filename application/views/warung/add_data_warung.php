<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('core/header'); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('core/sidebar'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('core/topbar'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Data Warung</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Warung</h6>
                        </div>
                        <div class="card-body">

                            <?= validation_errors() ?>
                            <?= form_open_multipart('C_Warung/add_data') ?>

                            <div class="form-group">
                                <label for="">Nama Warung</label>
                                <input type="text" name="namawarung" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">NIB</label>
                                <input type="text" name="nib" class="form-control">
                                <label for="">*bisa dikosongkan</label>
                            </div>
                            <div class="form-group">
                                <label for="">No Handphone Warung</label>
                                <input type="number" name="nohpwarung" class="form-control" onKeyPress="if(this.value.length==12) return false;" required=" required">
                            </div>

                            <div class="form-group">
                                <label for="">Nama Sales</label>
                                <select name="sales" class="form-control" id="">
                                    <option value="">----</option>
                                    <?php
                                    foreach ($data_sales as $key => $value) {
                                    ?>
                                        <option value="<?= $key ?>"><?= $value['nama'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Latitude</label>
                                <input type="text" name="lat" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Longitude</label>
                                <input type="text" name="long" id="long" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Warung</label>
                                <textarea name="alamat_warung" class="form-control" cols="30" rows="10" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Nama Pemilik</label>
                                <input type="text" name="namapemilik" id="nama_pemilik" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="number" name="nik" class="form-control" onKeyPress="if(this.value.length==16) return false;" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">No Handphone Pribadi</label>
                                <input type="number" name="nohppribadi" class="form-control" onKeyPress="if(this.value.length==12) return false;" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pribadi</label>
                                <textarea name="alamat_pribadi" class="form-control" id="alamat_pribadi" cols="30" rows="10" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="inputEmail" class="form-control" onchange="generatePass()" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" id="myInput" required="required">
                                <input type="checkbox" onclick="myFunction()" style="margin-top: 10px;"> Show Password
                            </div>


                            <div>
                                <img src="../../assets/img/default.png" class="img-thumbnail img-preview-ktp" width="150px">
                            </div>
                            <div class="form-group">
                                <label for="">Foto KTP</label>
                                <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" required="required" accept="image/png, image/jpeg" onchange="prevFotoKTP()">
                            </div>

                            <div>
                                <img src="../../assets/img/default.png" class="img-thumbnail img-preview" width="150px">
                            </div>
                            <div class="form-group">
                                <label for="">Foto Depan Warung</label>
                                <input type="file" name="foto_warung" id="foto" class="form-control" required="required" accept="image/png, image/jpeg" onchange="prevFoto()">
                            </div>


                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <a class="btn btn-info" href="<?= site_url('C_Warung/') ?>">Kembali</a>
                            </form>


                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('core/footer'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- file-js -->
    <?php $this->load->view('core/js'); ?>
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function generatePass() {
            var nama = document.getElementById("nama_pemilik").value;
            var long = document.getElementById("long").value;


            var _nama = nama.substring(0, 4);
            var _long = long.substring(long.length - 4, long.length);
            // var _imei = imei.substring(11, 15);

            document.getElementById("myInput").value = _long + _nama;

        }

        function prevFotoKTP() {
            const gambar = document.querySelector('#foto-ktp');
            // const gambarLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview-ktp');

            // gambarLabel.textContent = gambar.files[0].name;

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(foto_ktp.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>

</body>

</html>