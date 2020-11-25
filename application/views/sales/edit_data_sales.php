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
                            <?= form_open('C_Sales/edit_data') ?>

                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="text" name="nik" id="input" value="<?= $data_sales['nik'] ?>" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama" id="input" value="<?= $data_sales['nama'] ?>" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <div class="radio">
                                    <label><input type="radio" name="jk" value="Laki-Laki" <?php if ($data_sales['jenis_kelamin'] == 'Laki-Laki') {
                                                                                                echo "checked";
                                                                                            } ?>> Laki-Laki</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="jk" value="Perempuan" <?php if ($data_sales['jenis_kelamin'] == 'Perempuan') {
                                                                                                echo "checked";
                                                                                            } ?>> Perempuan</label>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="input" value="<?= $data_sales['email'] ?>" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">No Handphone</label>
                                <input type="text" name="nohp" id="input" value="<?= $data_sales['notlpn'] ?>" class="form-control" required="required">
                            </div>
                            <div class=" form-group">
                                <label for="">Area</label>
                                <input type="text" name="area" id="input" value="<?= $data_sales['area'] ?>" class="form-control" required="required">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a class="btn btn-info" href="<?= site_url('C_Sales/') ?>">Kembali</a>
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