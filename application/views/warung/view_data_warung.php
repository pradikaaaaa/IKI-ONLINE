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

                            <a class="btn btn-primary" href="<?= site_url('C_Warung/form_tambah') ?>">Tambah</a>
                            <br><br>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Nama Pemilik</th>
                                            <th>Nama Toko</th>
                                            <th>Alamat</th>
                                            <th width="120">Opsi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if (!empty($data_resto)) {
                                            foreach ($data_resto as $key => $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $value['email'] ?></td>
                                                    <td><?= $value['namapemilik'] ?></td>
                                                    <td><?= $value['namatoko'] ?></td>
                                                    <td><?= $value['alamat'] ?></td>

                                                    <td>
                                                        <a class="btn btn-warning" href="<?= site_url('C_Warung/form_edit/' . $key) ?>">Edit</a>
                                                        <a class="btn btn-danger" href="<?= site_url('C_Warung/delete_data/' . $key) ?>">Hapus</a>
                                                    </td>
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