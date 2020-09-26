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
                                <a class="nav-link active" href="<?php echo base_url('index.php/admin/tampil_mapel');?>"><i class="fa fa-fw fa-graduation-cap"></i>Mata Pelajaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('index.php/admin/pilih_rapor');?>"><i class="fa fa-fw fa-file"></i>Raport</a>
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
                            <h2 class="pageheader-title">Mata Pelajaran </h2>
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
                <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="card">
                                <h5 class="card-header">Data Mata Pelajaran</h5>
                                <div class="card-body">
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah_mapel">
                                <i class="fa fa-fw fa-plus"></i> TAMBAH MAPEL
                                </a><br><br>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Kode Mapel</th>
                                                <th scope="col">Nama Mapel</th>
                                                <th scope="col">KKM</th>
                                                <th scope="col">Option</th>
                                            </tr>
                                        </thead>
                                        <?php $no = $page+1;
                                        foreach($results as $d):?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $no;?></td>
                                                <td><?php echo $d->kdmapel;?></td>
                                                <td><?php echo $d->nmmapel;?></td>
                                                <td><?php echo $d->akm;?></td>
                                                <td>
                                                <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah_mapel<?php echo $d->kdmapel;?>"><i class="fa fa-fw fa-pencil-alt"></i> Ubah</a> <?php echo anchor('admin/hapus_mapel/'.$d->kdmapel, '<i class="fa fa-fw fa-trash"></i> Hapus', 'title="Hapus" class="btn btn-danger btn-sm"');?>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php $no++; endforeach;?>
                                    </table><br>
                                    <h4>Halaman : <?php echo $links;?></h4>
                                    <?php echo form_open('admin/cetak_mapel');?>
                                    <div class="form-row">
                                        <select class="form-control col-1" name="pilih">
                                        <option value="pdf">PDF</option>
                                        <option value="excel">Excel</option>
                                        </select>&nbsp;
                                        <button class="btn btn-primary btn-sm"><i class="fa fa-fw fa-print"></i> CETAK</button>
                                    </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="tambah_mapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mata Pelajaran</h5>
                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </a>
                                    </div>
                                <div class="modal-body">
                                <?php
                                    echo form_open('admin/submit_mapel'); 
                                ?>
                                <div class="form-group">
                                    <label for="kdmapel">Kode Mapel</label>
                                    <input class="form-control form-control-lg" id="kdmapel" name="var[0]" type="text" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="nmmapel">Nama Mapel</label>
                                    <input class="form-control form-control-lg" id="nmmapel" name="var[1]" type="text" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="akm">KKM</label>
                                    <input class="form-control form-control-lg" id="akm" name="var[2]" type="number" autocomplete="off">
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
            <?php foreach($results as $m):?>
            <div class="modal fade" id="ubah_mapel<?php echo $m->kdmapel;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mata Pelajaran</h5>
                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </a>
                                    </div>
                                <div class="modal-body">
                                <?php
                                    echo form_open('admin/ubah_mapel'); 
                                ?>
                                <input type="hidden" name="kdmapel" value="<?php echo $m->kdmapel;?>">
                                <div class="form-group">
                                    <label for="kdmapel">Kode Mapel</label>
                                    <input class="form-control form-control-lg" id="kdmapel" value="<?php echo $m->kdmapel;?>" name="var[0]" type="text" autocomplete="off" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nmmapel">Nama Mapel</label>
                                    <input class="form-control form-control-lg" id="nmmapel" value="<?php echo $m->nmmapel;?>" name="var[1]" type="text" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="akm">KKM</label>
                                    <input class="form-control form-control-lg" id="akm" value="<?php echo $m->akm;?>" name="var[2]" type="number" autocomplete="off">
                                </div>
                                </div>
                                <div class="modal-footer">
                                <a href="#" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <?php
                                    echo form_close();
                                ?>
                                </div>
                            </div>
                        </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <script src="<?php echo base_url('assets/vendor/jquery/jquery-3.3.1.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/slimscroll/jquery.slimscroll.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/js/main-js.js')?>"></script>
</body>
 
</html>