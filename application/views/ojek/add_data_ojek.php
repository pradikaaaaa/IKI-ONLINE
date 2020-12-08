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
                    <h1 class="h3 mb-4 text-gray-800">Data Ojek</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Ojek</h6>
                        </div>
                        <div class="card-body">

                            <?= validation_errors() ?>
                            <?= form_open_multipart('C_Ojek/add_data') ?>

                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="number" name="nik" id="inputNIK" onKeyPress="if(this.value.length==16) return false;" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama" id="inputNama" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <div class="radio">
                                    <label><input type="radio" name="jk" checked value="Laki-Laki"> Laki-Laki</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="jk" value="Perempuan"> Perempuan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="input" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">IMEI</label>
                                <input type="number" name="imei" id="imei" onKeyPress="if(this.value.length==15) return false;" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">No Handphone</label>
                                <input type="text" name="nohp" id="input" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Motor</label>
                                <input type="text" name="motor" id="input" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Plat Nomor</label>
                                <input type="text" name="platnomor" id="input" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="email" name="username" id="input" onchange="generatePass()" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" id="myInput" required="required">
                                <input type="checkbox" onclick="myFunction()" style="margin-top: 10px;"> Show Password
                            </div>

                            <div>
                                <img src="../../assets/img/default.png" class="img-thumbnail img-preview" width="150px">
                            </div>
                            <div class="form-group">
                                <label for="">Upload Foto Profil</label>
                                <input type="file" name="foto_ojek" id="foto" class="form-control" accept="image/png, image/jpeg" required="required" onchange="prevFoto()">
                            </div>


                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <a class="btn btn-info" href="<?= site_url('C_Ojek/') ?>">Kembali</a>
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
            var nama = document.getElementById("inputNama").value;
            var imei = document.getElementById("imei").value;


            var _nama = nama.substring(0, 4);
            var _imei = imei.substring(11, 15);

            document.getElementById("myInput").value = _imei + _nama;

        }
    </script>

</body>

</html>