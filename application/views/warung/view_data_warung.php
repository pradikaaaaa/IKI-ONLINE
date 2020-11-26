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
                                            <th>Nama Pemilik</th>
                                            <th>Nama Toko</th>
                                            <th>Sales</th>
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
                                                    <td><?= $value['nama_pemilik'] ?></td>
                                                    <td><?= $value['nama_warung'] ?></td>
                                                    <td><?= $value['nama_sales'] ?></td>
                                                    <td><?= $value['alamat_warung'] ?></td>

                                                    <td>
                                                        <a class="btn view_warung btn-info btn-sm" href="javascript:void(0);" data-nama="<?= $value['nama_warung'] ?>" data-foto="<?= $value['foto'] ?>" data-alamat="<?= $value['alamat_warung'] ?>" data-tanggal="<?= $value['tanggal'] ?>"><i class="fas fa-fw fa-eye"></i></a>
                                                        <a class="btn btn-warning btn-sm" href="<?= site_url('C_Warung/form_edit/' . $value['uid']) ?>"><i class="fas fa-fw fa-edit"></i></a>
                                                        <a class="btn btn-danger btn-sm" href="<?= site_url('C_Warung/delete_data/' . $value['uid']) ?>"><i class="fas fa-fw fa-trash"></i></a>
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


            <!-- View Modal-->
            <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Data Warung</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <img id="foto" style="max-width:100%;">
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div id="data-body">
                                <br>
                                <h5><strong> <label id="nama" for=""></label></strong></h5>
                                Terdaftar pada : <label id="tanggal" for="">26/11/2020</label>
                                <br>
                                <i class='fas fa-map-marker-alt'></i> <label id="alamat" for=""></label>
                            </div>



                            <p></p>
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
    <script>
        // get View Records
        $('#dataTable').on('click', '.view_warung', function() {
            // var tweet = $(this).data('tweet');
            var nama = $(this).data('nama');
            var foto = $(this).data('foto');
            var alamat = $(this).data('alamat');
            var tanggal = $(this).data('tanggal');

            var d = new Date(tanggal);
            var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

            $('#ModalView').modal('show');
            $('#nama').html(nama);
            $('#alamat').html(alamat);
            $('#tanggal').html(d.getDate() + " " + bulan[d.getMonth()] + " " + d.getFullYear());
            $('#foto').attr('src', foto);
        });
        // End View Records
    </script>


</body>

</html>