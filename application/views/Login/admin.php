<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title> <?= $title ?> </title>
    <!-- Font Style CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/font/poppins.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/font/fontstyle.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/input/input.field.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/mdb.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">


    <style>
        .gradient-custom-2 {
            background: linear-gradient(to right, #2475ee, #8f36d8, #c136dd, #9145b4);
        }

        .gradient-form {
            height: 100vh;
        }

        .input-area {
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #ced4da;
            margin-bottom: 20px;
        }

        .input-area:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        .btn-custom {
            background: linear-gradient(to right, #2475ee, #8f36d8, #c136dd, #9145b4);
            border: none;
        }

        .btn-custom:hover {
            background: linear-gradient(to right, #1b5bbc, #6e2fa8, #a129c6, #7d359a);
        }

        .card-custom {
            border-radius: 15px;
            overflow: hidden;
        }

        .card-body-custom {
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>
</head>

<body>


    <!-- Start your project here-->
    <div class="container">
        <section class="h-100 gradient-form">
            <div class="container py-5 h-100">
                <?php $this->load->view('message') ?>
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">

                                        <div class="text-center">
                                        </div>
                                        </br>
                                        <form action="<?= site_url('admin/process') ?>" method="post">
                                            <p class="text-center fontpoppins">Login to Your Account </p>
                                            <div class="input-group mt-xl-5">
                                                <input type="text" name="username" class="form-control form-control-lg input-area">
                                                <label class="label">Username</label>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control input-area">
                                                <label class="label">Password</label>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <button type="submit" name="login" id="button-login" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">Log
                                                    in</button>
                                            </div>


                                        </form>

                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                        <img src="<?= base_url('assets/'); ?>dist/img/vector.svg" style="width: 350px;">
                                        <br><br>
                                        <h4 class="mb-4 text-center fontpoppins-title">POS System Apps</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- End your project here-->

    <!-- MDB -->
    <script src="<?= base_url('assets/'); ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/dist/js/adminlte.min.js?v=3.2.0"></script>
    <script type="text/javascript" src="<?= base_url('assets/'); ?>dist/js/mdb.min.js"></script>


    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetshow.js"></script>

    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000

            });

            var flash = $('#swalFailed').data('flash');
            if (flash) {
                const swalLog = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary right-gap',
                    },
                    buttonsStyling: false
                })

                swalLog.fire({
                    icon: 'error',
                    title: 'Login Failed!',
                    text: 'Sorry, your username or password are incorrect !',
                    width: 550,
                    color: '#716add',
                    howClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                })
            };
        });
    </script>
</body>

</html>