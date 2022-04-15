<?php
	include('../../server.php');
	
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../../login/login.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0c2638ec91.js" crossorigin="anonymous"></script>
    
    <!-- Custom Styles-->
    <link rel="stylesheet" href="../../css/styling.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">

    <title>Checkout</title>	
</head>
<body>
    <!-- Header -->
    <?php include('header.php'); ?>

    <div class="auth-content" id="market">
      <form action="thankyou.php" method="post">
        <h2 class="form-title">Fill in this form to complete order.</h2>
        <label for="address">Address:</label>
        <textarea rows="5" cols="50" id="add" name="address" class="text-input" placeholder="Your address here..." required></textarea><br><br>
        
        <label for="pay">Choose a payment method:</label>
        <select name="pay" id="pay" class="text-input">
          <optgroup label="Payment Method">
            <option value="COD">Cash On Delivery (COD)</option>
            <option value="Bankin">Bank in</option>
          </optgroup>
          </select>
          <br>
        <button value="Place Order" name="place-order" class="btn btn-big contact-btn clickable">Order</button>
      </form>     
    </div>

    <!-- Footer -->
    <?php include('../footer.php'); ?>
</body>
</html>