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

    <title>Cart</title>	
    <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] { -moz-appearance: textfield;}

    #name {font-size:2rem;}

    @media only screen and (max-width: 930px) {
        #cart {
            height:66px;
            width:75px;
        }
        #name {font-size:1.4rem;}
    }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include('header.php'); ?>

    <div class="admin-content">
        <div class="content" id="market">
            <!-- Display Notification/Error -->
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
            <a href="https://www.vecteezy.com/free-vector/cat-doodle"><img src="../../images/cat-group.png" alt="cat-group.png" id="cat"></a>
            <?php if(!empty($_SESSION["shopping_cart"])) { ?>
            <table width="100%" style=" border-collapse: collapse;background-color:#F2F2F2;border-radius:5px;">
                <form action="cart.php" method="post">
                <?php
                        $total = 0;
                        $_SESSION["shopping_cart"]=array_filter($_SESSION["shopping_cart"]);
                        $_SESSION["shopping_cart"]=array_values($_SESSION["shopping_cart"]);
                        foreach(($_SESSION["shopping_cart"]) as $key => $value) {
                ?>
                    <tr style="border-bottom: 1px solid #000;">
                        <td width=10%><img id="cart" src="../../images/products/<?php echo $value["item_image"]; ?>" alt="<?php echo $value["item_image"]; ?>" height="112px" width="150px"></td>
                        <td><strong id="name"><?php echo $value["item_name"]; ?></strong><br><strong>
                            Quantity: 
                        <input type="number" id="textbox" name="item-quantity[]" value="<?php echo $value["item_quantity"]; ?>" min="1" max="99" style="width:1.7rem;text-align:center;" onBlur="document.getElementById('update-cart').click();" required></strong>
                        <br>
                        <strong>RM <?php echo $value["item_price"]; ?>/per unit</strong></td>
                        <?php $price = $value["item_quantity"] * $value["item_price"]; ?>
                        <td width=20% align="right">RM <?php echo number_format($price, 2); ?><br>
                        <input type="hidden" name="item-id[]" value="<?php echo $value["item_id"]; ?>">
                        <input type="hidden" name="item-name[]" value="<?php echo $value["item_name"]; ?>">
                        <input type="hidden" name="item-price[]" value="<?php echo $value["item_price"]; ?>">
                        <input type="hidden" name="shop-id[]" value="<?php echo $value["shop_id"]; ?>">
                        <input type="hidden" name="item-image[]" value="<?php echo $value["item_image"]; ?>">
                        <br><a href="cart.php?action=delete&itemID=<?php echo $value["item_id"]; ?>" style="color: red;" onclick="return confirm('Are you sure?')"><u>Remove</u></a></td>
                    </tr>
                    <?php  
                            $total += $price;
                        }
                    ?>
                    <tr>
                        <td colspan=2 align="right"><br><br><strong>Subtotal</strong></td>
                        <td align="right"><br><br>RM <?php echo number_format($total, 2); ?></td>
                        <input type="hidden" name="total-price" value="<?php echo number_format($total, 2); ?>">
                    </tr>
                    <tr>
                        <td colspan=2 align="right"><button name="update-cart" id="update-cart" style="visibility:hidden;"></button></td>
                        <td align="right">&nbsp;<br><button name="pay-now" class="btn btn-big clickable" onclick="return confirm('Are you sure?')">Pay Now</button>&nbsp;<br>&nbsp;</td>
                    </tr>
                    </form>
                    <?php
            } else {?>
                <h3>Your Shopping Cart is empty.. <br>Start Shopping with UiTM Food Delivery!</h3> <?php
            } ?>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <?php include('../footer.php'); ?>
</body>
</html>