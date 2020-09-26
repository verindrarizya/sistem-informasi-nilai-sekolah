<!doctype html>
<html lang="en">
 
<head>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo-23.png')?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Log In</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>">
    <link href="<?php echo base_url('assets/vendor/fonts/circular-std/style.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/css/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')?>">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center">
            <img class="logo-img" src="<?php echo base_url('assets/images/logo-23.png')?>" alt="logo" width="100px">
            <span class="splash-description">SMAN 23 JAKARTA</span>
            </div>
            <div class="card-body">
              <?php
                echo form_open('login/login'); 
              ?>
              <div class="form-group">
                <input class="form-control form-control-lg" id="username" name="username" type="text" placeholder="Username" autocomplete="off">
              </div>
              <div class="form-group">
                <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-primary btn-lg btn-block">Masuk</button>
              <?php
                echo form_close();
              ?>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/vendor/jquery/jquery-3.3.1.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.js')?>"></script>
</body>
 
</html>