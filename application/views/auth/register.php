<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Registration - Laundry</title>
</head>

<body style="background-color: #F8F8FF;">
    <div class="card shadow rounded" style="width: 700px; margin: 50px auto;  background:#E6E6FA;">
        <div class="row justify-content-center p-3 my-3">
            <div class="col-lg-10 col-md-10 col-12">
                <h2 class="text-center">Registration</h2>
                <div class="py-3">
                    <form action="<?php echo base_url('registercust') ?>" method="post">
                        <div class="mb-2">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="nama" class="form-control" name="nama" id="nama" placeholder="Nama lengkap">
                            <?= form_error('nama', '<small class="text-danger pl-2">', ' </small>'); ?>
                        </div>
                        <div class="row">
                            <div class="mb-2 col">
                                <label for="jenis_kel" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kel" id="jenis_kel" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            
                            <div class="mb-2 col">
                                <label for="tgl_lahir" class="form-label">Tanggal lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="tgl_lahir">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="alamat" class="form-control" name="alamat" id="alamat" placeholder="alamat">
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="nama@gmail.com">
                            <?= form_error('email', '<small class="text-danger pl-2">', ' </small>'); ?>
                        </div>
                        <div class="row">
                            <div class="mb-2 mt-2 col">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password1" id="password1" placeholder="password">
                                <?= form_error('password1', '<small class="text-danger pl-2">', ' </small>'); ?>
                            </div>

                            <div class="mb-2 mt-2 col">
                                <label for="password" class="form-label">Ulangi Password</label>
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Repeat">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-dark mt-2 px-5" style="display: inline !important;">Register</button>
                        <a href="<?= base_url('login') ?>" class="text-decoration-none mt-3" style="color:black;display: inline !important; float: right">Sudah punya akun? Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>