<?php 
include('../../server.php');

if (whatUser()!=1) {
	$_SESSION['msg'] = "Sorry, You Are Not Allowed to Access This Page";
	header('location: ../../login/login.php');
}

if (whatUser()==1 && registeredShopName()==1) {
	header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
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

	<title>Vendor Section - Register Shop</title>
</head>
<body>
<br><br><br><br><br>
    <div class="auth-content">
        <form action="index.php" method="post">
            <h2 class="form-title">Your Shop Requires A Name</h2>
		    <div>
		    	<label>Shop Name</label>
		    	<input type="text" name="shopName" class="text-input">
		    </div>
		    <div id="market">
		    	<button class="btn clickable" name="rename-btn">Register Shop</button>
		    </div>
	    </form>
    </div>

    <!-- Footer -->
    <?php include('../footer.php'); ?>
</body>
</html>