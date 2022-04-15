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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">

  <!-- Custom Styling -->
  <link rel="stylesheet" href="../../css/styling.css">

  <?php
    $shopID = $_SESSION['shop']['shopID'];

    $query = "SELECT * FROM shops WHERE shopID=$shopID";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
  ?>
  <title><?php echo $row["shopName"]; ?></title>
  <style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
  </style>
</head>
<body>
  <!-- Header -->
  <?php include('header.php'); ?>

  <!-- Content -->
  <div class="content">  
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
    <h2 class="page-title"><?php echo $row["shopName"]; ?></h2> 
    <ul>
    <?php
      $query = "SELECT * FROM item WHERE shopID=$shopID ORDER BY itemID ASC";  
      $result = mysqli_query($con, $query); 
      if(mysqli_num_rows($result) > 0)  {  
        while($row = mysqli_fetch_array($result))  {  
        ?>  
          <form method="post" action="shops.php">   
            <li><div class="img-text shop"> 
                  <img src="../../images/products/<?php echo $row["itemImg"]; ?>" alt='<?php echo $row["itemImg"]; ?>' height="112px" width="150"/><br />  
                  <h4><?php echo $row["itemName"]; ?></h4>  
                  <h4>RM <?php echo $row["itemPrice"]; ?></h4>  
                  <input type="number" name="quantity" value="1" min="1" max="99" style="width:1.7rem;text-align:center;" required/>  
                  <input type="hidden" name="itemID" value="<?php echo $row["itemID"]; ?>" />  
                  <input type="hidden" name="hidden_name" value="<?php echo $row["itemName"]; ?>" />  
                  <input type="hidden" name="hidden_price" value="<?php echo $row["itemPrice"]; ?>" /> 
                  <input type="hidden" name="hidden_shop" value="<?php echo $_SESSION['shop']['shopID']; ?>" /> 
                  <input type="hidden" name="hidden_image" value="<?php echo $row["itemImg"]; ?>" /> 
                  <button name="add-to-cart">Add To Cart</button>
            </div></li>
          </form>   
        <?php  
        }  
      } else { ?>
        <h3>This Shop Seems Empty...</h3> <?php
      }
      ?>
      </ul>
    </div>

    <!-- Footer -->
    <?php include('../footer.php'); ?>
</body>
</html>