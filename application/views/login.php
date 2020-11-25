<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="">



    <title>IKI ONLINE - Login</title>


    <link href="<?= base_url() ?>assets/img/apple-touch-icon.png" rel="icon">

    <!-- Custom fonts for this template-->

    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">



    <!-- Custom styles for this template-->

    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">



</head>



<body class="bg-gradient-primary">



    <div class="container">



        <!-- Outer Row -->

        <div class="row justify-content-center">





            <div class="col-xl-6 col-lg-6 col-md-6">



                <?= validation_errors() ?>



                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="p-5">

                                    <div class="text-center">

                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>

                                    </div>

                                    <form class="user" action="<?= site_url('C_Login/login') ?>" method="POST">

                                        <div class="form-group">

                                            <input type="email" class="form-control form-control-user" name="email" id="InputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">

                                        </div>

                                        <div class="form-group">

                                            <input type="password" class="form-control form-control-user" name="password" id="InputPassword" placeholder="Password">

                                            <input type="checkbox" onclick="myFunction()" style="margin-top: 10px;margin-left:15px;"> Show Password

                                        </div>

                                        <!-- <div class="form-group">

                                            <div class="custom-control custom-checkbox small">

                                                <input type="checkbox" class="custom-control-input" id="customCheck">

                                                <label class="custom-control-label" for="customCheck">Remember Me</label>

                                            </div>

                                        </div> -->

                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">

                                        <!-- <hr> -->



                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



            </div>



        </div>



    </div>



    <!-- Bootstrap core JavaScript-->

    <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>

    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <!-- Core plugin JavaScript-->

    <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>



    <!-- Custom scripts for all pages-->

    <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

    <script>
        function myFunction() {

            var x = document.getElementById("InputPassword");

            if (x.type === "password") {

                x.type = "text";

            } else {

                x.type = "password";

            }

        }
    </script>



</body>



</html>