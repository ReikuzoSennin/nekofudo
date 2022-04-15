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

  <title>Login</title>
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
    ?>
    <form action="login.php" method="post">
      <h2 class="form-title">Login</h2>
      <div>
        <label>Username</label>
        <input type="text" name="username" class="text-input">
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" class="text-input">
      </div>
      <div>
        <button name="login-btn" class="btn btn-big clickable">Login</button>
      </div>
      <p>Or <a href="register.php">Sign Up</a></p>
    </form>

  </div>

  <!-- Footer -->
  <?php include('footer.php'); ?>
</body>
</html>