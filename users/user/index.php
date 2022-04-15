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
    
    <!-- Content -->
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

        <ul>
            <?php
             $query = "SELECT * FROM shops,users where shops.userID=users.userID";  
             $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) > 0)  {  
                while($row = mysqli_fetch_array($result))  {  
            ?>  
            <li><form action="shops.php" method="post">
                <input type="hidden" name="shop-id" value="<?php echo $row['shopID']; ?>">  
                <button name="enter-shop" class="img-text shop clickable">
                      <img src="../../images/vendors/<?php echo $row["shopImg"]; ?>" height="125px" width="125px" /><br />  
                      <h4><?php echo $row["shopName"]; ?></h4>  
                      <h4>Owner: <?php echo $row["username"]; ?></h4>
                </button>
            </form></li>
            <?php  
                }  
            }  
            ?>
        </ul>
    </div>

    <!-- Footer -->
    <?php include('../footer.php'); ?>
</body>
</html>