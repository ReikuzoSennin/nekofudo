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

    <title>Contact</title>
</head>
<body>
    <!-- Header -->
    <?php include('header.php'); ?>
    
    <div class="contact">
        <div class="contact-section about">
            <p style="margin:0 5px 0 5px">
                <span>&#8220;</span>
                Nekofudo aims to bring convenience to residents by allowing them to purchase food from a click of a button.
                No more going out during the Covid-19 days by buying delicious edibles from the comfort of your own device.
                <span style="float:right">&#8221;</span>
            </p><br><br><br>
            <div class="contact">
                <span><i class="fas fa-phone"></i> &nbsp; +60 27-510-3708</span>
                <span><i class="fas fa-envelope"></i> &nbsp; support@nekofudo.com</span>
            </div>
            <div class="socials">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div><br><br><br>
            <a href="mailto:support@nekofudo.com" target="_blank"><img src="../../images/contact.png" alt="contact.png" id="contact"></a>
        </div>  
    <h2 style="text-align:center" class="tooltip">
      <a href="members.php" target="_blank">Meet The Team</a>
      <span class="tooltiptext">Click For More Info</span>
    </h2>
    <div class="team">
        <div class="flip-card">
          <div class="flip-card-inner">
            <div class="flip-card-front">
                Syamil
                <br><br><br>
                <span>Top Fragger</span>
                <br><br>
                <span id="reveal">&lt;click to reveal&gt;<span>
            </div>
            <div class="flip-card-back">
              <img src="../../images/members/Syamil.png" alt="Syamil.png">
              <a target="_blank" href="https://www.instagram.com/neko.kuns/"><i class="fab fa-instagram"></i></a>  
            </div>
          </div>
        </div>
        <div class="flip-card">
          <div class="flip-card-inner">
            <div class="flip-card-front">
                Amir
                <br><br><br>
                <span>CEO</span>
                <br><br>
                <span id="reveal">&lt;click to reveal&gt;<span>
            </div>
            <div class="flip-card-back">
              <img src="../../images/members/Amir.png" alt="Amir.png">
              <a target="_blank" href="https://www.instagram.com/amir.trifle/"><i class="fab fa-instagram"></i></a>  
            </div>
          </div>
        </div>
        <div class="flip-card">
          <div class="flip-card-inner">
            <div class="flip-card-front">
                Hariz
                <br><br><br>
                <span>Maid</span>
                <br><br>
                <span id="reveal">&lt;click to reveal&gt;<span>
            </div>
            <div class="flip-card-back">
              <img src="../../images/members/Hariz.png" alt="Hariz.png">
              <a target="_blank" href="https://www.instagram.com/_h_sugi/"><i class="fab fa-instagram"></i></a>      
            </div>
          </div>
        </div>
        <div class="flip-card">
          <div class="flip-card-inner">
            <div class="flip-card-front">
                Syazana
                <br><br><br>
                <span>Janitor</span>
                <br><br>
                <span id="reveal">&lt;click to reveal&gt;<span>
            </div>
            <div class="flip-card-back">
              <img src="../../images/members/Syazana.png" alt="Syazana.png">
              <a target="_blank" href="https://www.instagram.com/sy.zanamya/"><i class="fab fa-instagram"></i></a>  
            </div>
          </div>
        </div>
    </div>
    </div>

    <script>
        $('.flip-card').click(function(){ //hover  can be used
            $(this).closest('.flip-card').toggleClass('click');
        });
    </script>
    
    <!-- Footer -->
    <?php include('../footer.php'); ?>
</body>
</html>