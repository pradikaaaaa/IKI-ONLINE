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
                    <h1 class="h3 mb-4 text-gray-800">Data Sales</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Sales</h6>
                        </div>
                        <div class="card-body">

                            <?= validation_errors() ?>
                            <?= form_open_multipart('C_Sales/add_data') ?>

                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="number" name="nik" class="form-control" onKeyPress="if(this.value.length==16) return false;" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama" id="input" class="form-control" required="required">
                            </div>
                            <div class=" form-group">
                                <label for="">Jenis Kelamin</label>
                                <div class="radio">
                                    <label><input type="radio" name="jk" checked value="Laki-Laki"> Laki-Laki</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="jk" value="Perempuan"> Perempuan</label>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="input" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">No Handphone</label>
                                <input type="text" name="nohp" id="input" class="form-control" onKeyPress="if(this.value.length==12) return false;" required="required">
                            </div>
                            <div class=" form-group">
                                <label for="">Area</label>
                                <input type="text" name="area" id="input" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pribadi</label>
                                <textarea name="alamat_pribadi" class="form-control" id="alamat_pribadi" cols="30" rows="10" required></textarea>
                            </div>
                            <div>
                                <img src="../../assets/img/default.png" class="img-thumbnail img-preview" width="150px">
                            </div>
                            <div class="form-group">
                                <label for="">Upload Foto Profil</label>
                                <input type="file" name="foto_sales" id="foto" class="form-control" accept="image/png, image/jpeg" required="required" onchange="prevFoto()">
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah</button>
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

</body>

</html>