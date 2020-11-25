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
                    <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Warung</h6>
                        </div>
                        <div class="card-body">

                            <?= validation_errors() ?>
                            <?= form_open('C_Warung/edit_data') ?>
                            <input type="hidden" name="id" value="<?= $id ?>" id="">

                            Terakhir diubah pada : <?= date('d-m-Y H:i', strtotime($data_warung['updated_at'])) ?>

                            <div class="form-group">
                                <label for="">Nama Pemilik</label>
                                <input type="text" name="namapemilik" id="input" class="form-control" value="<?= $data_warung['namapemilik'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="input" class="form-control" value="<?= $data_warung['email'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Warung</label>
                                <input type="text" name="namawarung" id="input" class="form-control" value="<?= $data_warung['namatoko'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">NIB</label>
                                <input type="text" name="nib" id="input" value="<?= $data_warung['nib'] ?>" class="form-control">
                                <label for="">*bisa dikosongkan</label>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Sales</label>
                                <select name="sales" class="form-control" id="">
                                    <option value="">----</option>
                                    <?php
                                    foreach ($data_sales as $key => $value) {
                                    ?>
                                        <option value="<?= $key ?>" <?php if ($key == $data_warung['kode_sales']) {
                                                                        echo "selected";
                                                                    } ?>><?= $value['nama'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Latitude</label>
                                <input type="text" name="lat" id="input" class="form-control" value="<?= $data_warung['latitude'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Longitude</label>
                                <input type="text" name="long" id="input" class="form-control" value="<?= $data_warung['longitude'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" class="form-control" id="" cols="30" rows="10" required><?= $data_warung['alamat'] ?></textarea>
                            </div>



                            <button type="submit" class="btn btn-primary">Edit</button>
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

</body>

</html>