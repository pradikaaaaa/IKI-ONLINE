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
                    <h1 class="h3 mb-4 text-gray-800">Versi Aplikasi</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Versi Aplikasi</h6>
                        </div>
                        <div class="card-body">

                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#tambahModal" ?>Tambah</a>
                            <br><br>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Versi</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if (!empty($versi_aplikasi)) {
                                            foreach ($versi_aplikasi as $key => $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $value['aplikasi'] ?></td>
                                                    <td><?= $value['versi'] ?></td>
                                                    <td><?= date('d-m-Y', strtotime($value['created_at'])) ?></td>
                                                </tr>
                                        <?php }
                                        } ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Tambah Modal-->
            <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?= form_open('C_Aplikasi/add_data') ?>
                            <div class="form-group">
                                <label for="input" class="colsm-2 control-label">Aplikasi : </label>
                                <input type="text" name="aplikasi" id="input" class="form-control" value="" required="required">
                            </div>
                            <div class="form-group">
                                <label for="input" class="colsm-2 control-label">Versi : </label>
                                <input type="text" name="versi" id="input" class="form-control" value="" required="required">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


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