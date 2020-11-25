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
                    <h1 class="h3 mb-4 text-gray-800"></h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Data Taksi</h6>
                        </div>
                        <div class="card-body">

                            <?= validation_errors() ?>
                            <?= form_open('C_Taksi/edit_data') ?>
                            <input type="hidden" name="id" value="<?= $id ?>" id="">

                            Terakhir diubah pada : <?= date('d-m-Y H:i', strtotime($data_taksi['updated_at'])) ?>

                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="text" name="nik" id="input" class="form-control" value="<?= $data_taksi['nik'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama" id="input" class="form-control" value="<?= $data_taksi['nama'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <div class="radio">
                                    <label><input type="radio" name="jk" value="Laki-Laki" <?php if ($data_taksi['jenis_kelamin'] == 'Laki-Laki') {
                                                                                                echo "checked";
                                                                                            } ?>> Laki-Laki</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="jk" value="Perempuan" <?php if ($data_taksi['jenis_kelamin'] == 'Perempuan') {
                                                                                                echo "checked";
                                                                                            } ?>> Perempuan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="input" class="form-control" value="<?= $data_taksi['email'] ?>" required="required" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" id="myInput" value="<?= $data_taksi['password'] ?>" required="required">
                                <input type="checkbox" onclick="myFunction()" style="margin-top: 10px;"> Show Password
                            </div>
                            <div class="form-group">
                                <label for="">No Handphone</label>
                                <input type="text" name="nohp" id="input" class="form-control" value="<?= $data_taksi['notelp'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Motor</label>
                                <input type="text" name="motor" id="input" class="form-control" value="<?= $data_taksi['motor'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Plat Nomor</label>
                                <input type="text" name="platnomor" id="input" class="form-control" value="<?= $data_taksi['platnomor'] ?>" required="required">
                            </div>


                            <button type="submit" class="btn btn-primary">Edit</button>
                            <a class="btn btn-info" href="<?= site_url('C_Taksi/') ?>">Kembali</a>
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