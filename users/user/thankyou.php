<?php include('../../server.php') ?>
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

	<title>Order From Gerai01</title>
	
	<style>
        button{width: 160px;height: 40px;}
    </style>
</head>
<body>
    <!-- Header -->
    <?php include('header.php'); ?>

    <div class="auth-content slide-up" id="market" style="text-align:center; font-size:2rem;">
        <h2>Thank you for your order!</h2>
        <button type="button" onclick="window.open(`invoice.php?receipt=${getRandomInt(100000,999999)}`,'_blank')"><b>Generate Receipt</b></button>
        <a href="index.php"><button type="button"><b>Return to Homepage</b></button></a>
        <img src="../../images/thankyou.png" alt="thankyou.png">
    </div>

    <script>
    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    </script>

    <!-- Footer -->
    <?php include('../footer.php'); ?>
</body>
</html>