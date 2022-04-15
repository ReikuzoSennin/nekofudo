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

  <title>Thank You</title>
</head>

<body>
  <!-- Header -->
  <?php include('header.php'); ?>

  <div class="auth-content slide-up" id="market" style="text-align:center; font-size:2rem;">
    <h2>THANK YOU</h2>
      for signing up with us!
    <img src="../images/thankyou.png" alt="thankyou.png">
    <div class="loader" style="margin: 0 auto;"></div>
  </div>
  <meta http-equiv="refresh" content="4; url=../users/user/index.php" />

  <!-- Footer -->
  <?php include('footer.php'); ?>
</body>
</html>