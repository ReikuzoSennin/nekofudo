<?php
	include('../../server.php');
	
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../../login/login.php');
	}

    unset($_SESSION["shop"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0c2638ec91.js" crossorigin="anonymous"></script>
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="../../css/styling.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">
    <title>UiTM Food Delivery</title>
</head>
<body>
    <!-- Header -->
    <?php include('header.php'); ?>

    <!-- Admin Content -->
    <div class="auth-content" id="market">
      <form action="account.php" method="post">
        <h2 class="form-title">Change Password</h2>
        <div>
          <label>New Password</label>
          <input type="password" name="password_1" class="text-input">
        </div>
        <div>
          <label>New Password Confirmation</label>
          <input type="password" name="password_2" class="text-input">
        </div>
        <div>
          <input type="hidden" name="user-id" value="<?php echo $_SESSION['user']['userID']; ?>">
          <button name="change-btn" class="btn btn-big clickable">Register</button>
        </div>
      </form>
    </div>

        <!-- Footer -->
    <?php include('../footer.php'); ?>
</body>
</html>