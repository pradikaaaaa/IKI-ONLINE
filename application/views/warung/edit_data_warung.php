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
                                <label for="">Nama Warung</label>
                                <input type="text" name="namawarung" id="input" class="form-control" value="<?= $data_warung['namatoko'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">NIB</label>
                                <input type="text" name="nib" id="input" value="<?= $data_warung['nib'] ?>" class="form-control">
                                <label for="">*bisa dikosongkan</label>
                            </div>
                            <div class="form-group">
                                <label for="">No Handphone Warung</label>
                                <input type="number" name="nohpwarung" class="form-control" value="<?= $data_warung['no_hp_warung'] ?>" onKeyPress="if(this.value.length==12) return false;" required=" required">
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
                                <textarea name="alamat_warung" class="form-control" id="" cols="30" rows="10" required><?= $data_warung['alamat_warung'] ?></textarea>
                            </div>


                            <div class="form-group">
                                <label for="">Nama Pemilik</label>
                                <input type="text" name="namapemilik" id="input" class="form-control" value="<?= $data_warung['namapemilik'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="number" name="nik" class="form-control" value="<?= $data_warung['nik'] ?>" onKeyPress="if(this.value.length==16) return false;" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">No Handphone Pribadi</label>
                                <input type="number" name="nohppribadi" class="form-control" value="<?= $data_warung['no_hp_pemilik'] ?>" onKeyPress="if(this.value.length==12) return false;" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Pribadi</label>
                                <textarea name="alamat_pribadi" class="form-control" id="alamat_pribadi" cols="30" rows="10" required><?= $data_warung['alamat_warung'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="input" class="form-control" value="<?= $data_warung['email'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" id="myInput" value="<?= $data_warung['password'] ?>" required="required" disabled>
                                <input type="checkbox" onclick="myFunction()" style="margin-top: 10px;"> Show Password
                            </div>

                            <div class="form-group">
                                <a href="#" data-toggle="modal" data-target="#ModalPassword">Ubah Password</a>
                            </div>


                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="<?= $data_warung['fotoktp'] ?>" class="img-thumbnail" width="550px">
                                </div>
                                <div class="col-lg-6">
                                    <img src="<?= $data_warung['fotowarung'] ?>" class="img-thumbnail" width="550px">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-lg-6">
                                    <a href="#" data-toggle="modal" data-target="#ModalFotoKTP">Ubah Foto KTP</a>
                                </div>
                                <div class="col-lg-6">
                                    <a href="#" data-toggle="modal" data-target="#ModalFotoWarung">Ubah Foto Warung</a>
                                </div>
                            </div>

                            <br>

                            <button type="submit" class="btn btn-primary">Edit</button>
                            <a class="btn btn-info" href="#">Kembali</a>
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


    <!-- Modal Password -->
    <div class="modal fade" id="ModalPassword" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Password</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <form action="">
                        <div class="form-group">
                            <label for="">Masukkan Password Baru</label>
                            <input type="password" name="password" id="input" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Foto KTP -->
    <div class="modal fade" id="ModalFotoKTP" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Foto KTP</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <?= form_open_multipart('C_Warung/edit_foto_ktp') ?>
                    <input type="hidden" name="id" value="<?= $id ?>" id="">
                    <input type="hidden" name="nama" value="<?= $data_warung['namapemilik'] ?>" id="">

                    <div>
                        <img src="<?= base_url() ?>assets/img/default.png" class="img-thumbnail img-preview-ktp" width="150px">
                    </div>
                    <div class="form-group">
                        <label for="">Foto KTP</label>
                        <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" required="required" accept="image/png, image/jpeg" onchange="prevFotoKTP()">
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

    <!-- Modal Foto Warung -->
    <div class="modal fade" id="ModalFotoWarung" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Foto Warung</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <?= form_open_multipart('C_Warung/edit_foto_warung') ?>
                    <input type="hidden" name="id" value="<?= $id ?>" id="">
                    <input type="hidden" name="nama" value="<?= $data_warung['namatoko'] ?>" id="">
                    <div>
                        <img src="<?= base_url() ?>assets/img/default.png" class="img-thumbnail img-preview" width="150px">
                    </div>
                    <div class="form-group">
                        <label for="">Foto Depan Warung</label>
                        <input type="file" name="foto_warung" id="foto" class="form-control" required="required" accept="image/png, image/jpeg" onchange="prevFoto()">
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
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function prevFotoKTP() {
            const gambar = document.querySelector('#foto-ktp');
            // const gambarLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview-ktp');

            // gambarLabel.textContent = gambar.files[0].name;

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(foto_ktp.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>

</body>

</html>