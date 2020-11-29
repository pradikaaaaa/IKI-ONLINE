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
                            Terakhir diubah pada : <?= date('d-m-Y H:i', strtotime($data_sales['updated_at'])) ?>

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
                            <div class="form-group">
                                <label for="">Alamat Pribadi</label>
                                <textarea name="alamat_pribadi" class="form-control" id="alamat_pribadi" cols="30" rows="10" required><?= $data_sales['alamat'] ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="<?= $data_sales['foto'] ?>" class="img-thumbnail" width="250px">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-lg-6">
                                    <a href="#" data-toggle="modal" data-target="#ModalFoto">Ubah Foto Sales</a>
                                </div>
                            </div>

                            <br>

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

    <!-- Modal Foto KTP -->
    <div class="modal fade" id="ModalFoto" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Foto Sales</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <?= form_open_multipart('C_Sales/edit_foto_sales') ?>
                    <input type="hidden" name="id" value="<?= $id ?>" id="">
                    <input type="hidden" name="nama" value="<?= $data_sales['nama'] ?>" id="">

                    <div>
                        <img src="<?= base_url() ?>assets/img/default.png" class="img-thumbnail img-preview" width="150px">
                    </div>
                    <div class="form-group">
                        <label for="">Foto Sales</label>
                        <input type="file" name="foto_sales" id="foto" class="form-control" required="required" accept="image/png, image/jpeg" onchange="prevFoto()">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- file-js -->
    <?php $this->load->view('core/js'); ?>

</body>

</html>