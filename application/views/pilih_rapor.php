
<!doctype html>
<html lang="en">

 
<head>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo-23.png')?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>">
    <link href="<?php echo base_url('assets/vendor/fonts/circular-std/style.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/css/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')?>">
</head>

<body>
    <div class="dashboard-main-wrapper">
       <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="#"><img class="logo-img" src="<?php echo base_url('assets/images/logo-23.png')?>" alt="logo" width="50px"> SMAN 23 JAKARTA</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
      <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('index.php/login/dashboard');?>"><i class="fa fa-fw fa-home"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('index.php/admin/tampil_siswa');?>"><i class="fa fa-fw fa-user"></i>Siswa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('index.php/admin/tampil_mapel');?>"><i class="fa fa-fw fa-graduation-cap"></i>Mata Pelajaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo base_url('index.php/admin/tampil_rapor_admin');?>"><i class="fa fa-fw fa-file"></i>Raport</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('index.php/login/logout');?>"><i class="fa fa-fw fa-power-off"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Pilih Input Rapor </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">Welcome <?php echo $this->session->userdata('nama');?></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Input Rapor</h5>
                                <div class="card-body">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah_nilai">
                                        <i class="fa fa-fw fa-plus"></i> TAMBAH NILAI
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <h5 class="card-header">Pilih Berdasarkan Siswa</h5>
                                <div class="card-body">
                                    <?php echo form_open('admin/tampil_rapor_siswa');?>
                                    <div class="form-group">
                                    <select class="form-control" name="pilih">
                                    <?php
                                    foreach ($siswa as $d) {
                                        echo "<option value='$d[0]'>$d[0] - $d[1]</option>";
                                    }
                                    ?>
                                    </select>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Tampilkan">
                                    <?php echo form_close();?>
                                </div>
                            </div>
                            <div class="card">
                                <h5 class="card-header">Pilih Berdasarkan Mata Pelajaran</h5>
                                <div class="card-body">
                                    <?php echo form_open('admin/tampil_rapor_mapel');?>
                                    <div class="form-group">
                                    <select class="form-control" name="pilih">
                                    <?php
                                    foreach ($mapel as $d) {
                                        echo "<option value='$d[0]'>$d[0] - $d[1]</option>";
                                    }
                                    ?>
                                    </select>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Tampilkan">
                                    <?php echo form_close();?>
                                </div>
                            </div>
                    </div>
            </div>
            <div class="modal fade" id="tambah_nilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Nilai</h5>
                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </a>
                                    </div>
                                <div class="modal-body">
                                <?php
                                    echo form_open('admin/submit_nilai'); 
                                ?>
                                <div class="form-group">
                                    <label for="">Nama Mapel</label>
                                    <select class="form-control" name="var[0]">
                                    <?php
                                    foreach ($mapel as $d) {
                                        echo "<option value='$d[0]'>$d[0] - $d[1]</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nmmapel">Nama Siswa</label>
                                    <select class="form-control" name="var[1]">
                                    <?php
                                    foreach ($siswa as $d) {
                                        echo "<option value='$d[0]'>$d[0] - $d[1]</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="akm">Absen</label>
                                    <input class="form-control form-control-lg" id="akm" name="var[2]" type="number" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="akm">Tugas</label>
                                    <input class="form-control form-control-lg" id="akm" name="var[3]" type="number" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="akm">UTS</label>
                                    <input class="form-control form-control-lg" id="akm" name="var[4]" type="number" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="akm">UAS</label>
                                    <input class="form-control form-control-lg" id="akm" name="var[5]" type="number" autocomplete="off">
                                </div>
                                </div>
                                <div class="modal-footer">
                                <a href="#" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <?php
                                    echo form_close();
                                ?>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/vendor/jquery/jquery-3.3.1.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/slimscroll/jquery.slimscroll.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/js/main-js.js')?>"></script>
</body>
 
</html>