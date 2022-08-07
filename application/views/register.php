<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Login</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <style>
    .container{
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    @media screen and (max-width: 400px) {
        .container{
            margin-top: 0;
            height: 100%;
        }
    }
  </style>
</head>
<body class="bg-light">
  <div class="container shadow pt-4 pb-5 px-5 rounded bg-white" style="max-width:500px">
    <h1 class="text-center mb-4">Register</h1>
    <?php
      if (validation_errors()) {
        echo "<div class='form_error alert alert-danger'>".validation_errors()."</div>";
      }
    ?>
    <?php 
      if ($this->session->flashdata('message')) {
        echo "<div class=\"alert alert-danger\">".$this->session->flashdata('message')."</div>";
      }
    ?>
    <form action="<?php echo base_url().'register/submitRegister'?>" method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>">
      </div>
      <div class="mb-3">
        <label for="telepon" class="form-label">Nomor Telepon</label>
        <input type="text" name="telepon" class="form-control" value="<?= set_value('telepon') ?>">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" value="<?= set_value('password') ?>">
        <input type="checkbox" onclick="myFunction()"> Show Password
      </div>
      <div class="mb-3">
        <label>Back to Login Page? <a href="<?php echo base_url().'login/showSignIn' ?>">Login</a></label>
      </div>
      <input type="submit" name="submit" value="Register" class="w-100 btn btn-primary">
    </form>
  </div>
 
<script >
    // java script untuk menampilkan password
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type == "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
</body>
</html>