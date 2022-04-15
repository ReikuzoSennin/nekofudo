<?php include('../server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">

  <!-- Custom Styling -->
  <link rel="stylesheet" href="../css/styling.css">

  <title>Register</title>
</head>

<body>
  <!-- Header -->
  <?php include('header.php'); ?>

  <div class="auth-content" id="market">
    <?php
    if(count($errors) > 0){
      foreach($errors as $e){
          echo "<div class='error'>".$e . "<br /></div>";
      }
    }
    if (isset($_SESSION["success"]) && !empty($_SESSION["success"])) {
      $msg = $_SESSION["success"];
      echo "<div class='success'>" . $msg . "</div>";
      unset($_SESSION["success"]);
    }
    ?>

    <form action="register.php" method="post">
      <h2 class="form-title">Register</h2>
      <div>
        <label>Username</label>
        <input type="text" name="username" class="text-input">
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password_1" class="text-input">
      </div>
      <div>
        <label>Password Confirmation</label>
        <input type="password" name="password_2" class="text-input">
      </div>
      <div>
        <button name="register-btn" class="btn btn-big">Register</button>
      </div>
      <p>Or <a href="login.php">Sign In</a></p>
    </form>
    <br><br><br>
    <p style="text-align:center;"><strong>Want to start selling? Contact an admin.</strong></p>
  </div>

  <!-- Footer -->
  <?php include('footer.php'); ?>
</body>
</html>