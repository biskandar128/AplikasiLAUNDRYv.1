<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.4/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('asset/Login&Register/style.css'); ?>">
</head>

<body>

<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

    <section class="section-register">
        <div class="row">
            <div class="col-xl-6">
                <img src="<?= base_url('asset/Login&Register/Background@2x.png'); ?>" class="d-none d-sm-none d-md-none d-lg-none d-xl-block" alt="">
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-mobile col-tab">
                <h4 class="text-center mt-4 d-block d-sm-block d-md-block d-xl-none text-white title-header">Laundry Amanah</h4>
                <h4 class="text-center mt-4 d-none d-sm-none d-md-none d-xl-block title-header">Laundry Amanah</h4>

                <div class="form-login text-center">
                    <div class="parent d-flex justify-content-center align-items-center" style="height: 83vh;">
                        <div class="child">
                            <form action="<?= base_url('login/register'); ?>" method="post">
                                <h4>Welcome!</h4>
                                <h5 class="mt-1">Sign up by entering the information below</h5>
                                <div class="form-group mt-3">
                                    <input type="text " class="form-control" placeholder="Name" name="name" autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="no_hp" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <textarea rows="2" class="form-control" name="alamat" placeholder="Address"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password " class="form-control" name="password" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-register ">REGISTER</button>
                                <p class="mt-2"><a href="<?= base_url('/'); ?>">Do you have an account? Sign in.</a></p>
                            </form>
                        </div>
                    </div>
                </div>

                <footer class="text-center">
                    <p class="text-black d-none d-sm-none d-md-none d-xl-block">&copy;2020 CV. Laundry Amanah</p>
                    <p class="text-white d-block d-sm-block d-md-block d-xl-none">&copy;2020 CV. Laundry Amanah</p>
                </footer>
            </div>
        </div>
    </section>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js " integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin=" anonymous "></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js " integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx " crossorigin="anonymous "></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.4/dist/sweetalert2.min.js"></script>

<script>
    const flashdata = $('.flash-data').data('flashdata');
        if (flashdata) {
            Swal.fire({
            icon: 'success',
            title: 'Data berhasil ' + flashdata,
            showConfirmButton: false,
            timer: 1500
            });
        }
</script>
</html>