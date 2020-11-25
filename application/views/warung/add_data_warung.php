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
                                <label for="">Nama Pemilik</label>
                                <input type="text" name="namapemilik" id="input" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="input" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" id="myInput" required="required">
                                <input type="checkbox" onclick="myFunction()" style="margin-top: 10px;"> Show Password
                            </div>
                            <div class="form-group">
                                <label for="">Nama Warung</label>
                                <input type="text" name="namawarung" id="input" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">NIB</label>
                                <input type="text" name="nib" id="input" class="form-control">
                                <label for="">*bisa dikosongkan</label>
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
                                <input type="text" name="lat" id="input" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Longitude</label>
                                <input type="text" name="long" id="input" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" class="form-control" id="" cols="30" rows="10" required></textarea>
                            </div>
                            <div>
                                <img src="../../assets/img/default.png" class="img-thumbnail img-preview" width="150px">
                            </div>
                            <div class="form-group">
                                <label for="">Upload Foto Profil</label>
                                <input type="file" name="foto_warung" id="foto" class="form-control" required="required" onchange="prevFoto()">
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
    </script>

</body>

</html>