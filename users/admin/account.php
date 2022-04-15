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
    <div class="admin-content">
        <div class="content" id="market">
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
            <h2 class="page-title">Manage Account</h2>
            <h4><i class="fas fa-signature"></i> Username: <?php echo $_SESSION['user']['username']; ?></h4>
            <h4><i class="fas fa-user-tag"></i> User Type: <?php echo $_SESSION['user']['userType']; ?></h4>
            <h4><i class="fas fa-key"></i> Password: <button onclick="location.href='changepass.php'"> Change Password</button></h4>
        </div>
    </div>

        <!-- Footer -->
    <?php include('../footer.php'); ?>
</body>
</html>