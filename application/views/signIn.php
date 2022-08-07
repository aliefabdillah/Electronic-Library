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
        top: 50%;
        left: 50%;
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
    <h1 class="text-center mb-4">Sign In</h1>
    <?php
        // tampilkan pesan error
        if ($this->session->flashdata('message')) {
          echo "<div class=\"alert alert-success\">".$this->session->flashdata('message')."</div>";
        }
        // tampilkan pesan logout message
        if ($this->session->flashdata('error_message')) {
          echo "<div class=\"alert alert-danger\">".$this->session->flashdata('error_message')."</div>";
        }
    ?>
    <form action="<?php echo base_url().'login/signInAuth'?>" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control"
          value="" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
        <input type="checkbox" onclick="myFunction()"> Show Password
      </div>
      <div class="mb-3">
        <label>You dont Have a account? <a href="<?php echo base_url().'register/showRegister' ?>">Register Now!</a></label>
      </div>
      <input type="submit" name="submit" value="Login" class="w-100 btn btn-primary">
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