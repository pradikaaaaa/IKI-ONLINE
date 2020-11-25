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

                            <a class="btn btn-primary" href="<?= site_url('C_Sales/form_tambah') ?>">Tambah</a>
                            <br><br>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>No Telepon</th>
                                            <th>Area</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if (!empty($data_sales)) {
                                            foreach ($data_sales as $key => $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $value['nama'] ?></td>
                                                    <td><?= $value['notlpn'] ?></td>
                                                    <td><?= $value['area'] ?></td>

                                                    <td>
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?= $key ?>">
                                                            Detail
                                                        </button>
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


            <?php
            if (!empty($data_sales)) {
                foreach ($data_sales as $key => $value) {
            ?>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Data Sales</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-group">
                                        <div class="card">
                                            <br>
                                            <img class="card-img-top" src="<?= $value['foto'] ?>" alt="Card image cap" style="width: 150px; margin-left: auto; margin-right: auto;">
                                            <div class="card-body">
                                                <h5 class="card-title" style="text-transform: camelcase;"><?= $value['nama'] ?></h5>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <p class="card-text">Email</p>
                                                        <p class="card-text">No.Hp</p>
                                                        <p class="card-text">Area</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="card-text">: <?= $value['email'] ?></p>
                                                        <p class="card-text">: <?= $value['notlpn'] ?></p>
                                                        <p class="card-text">: <?= $value['area'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <a class="btn btn-warning" href="<?= site_url('C_Sales/form_edit/' . $key) ?>">Edit</a>
                                    <a class="btn btn-danger" href="<?= site_url('C_Sales/delete_data/' . $key) ?>">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php }
            } ?>

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