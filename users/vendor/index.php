<?php
	include('../../server.php');
	
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../../login/login.php');
	}

    if (whatUser()==1 && registeredShopName()==0) {
        header("location: first_time.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous">

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
</head>
<body>
    <!-- Header -->
    <?php include('header.php'); ?>

    <!-- Admin Content -->
    <div class="admin-content" id="market">
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
        <form action="index.php" method="post">
            <h2 class="form-title">Manage Shop</h2>
            <div>
                <label>Shop Name:</label>
                <input type="text" name="shopName" value="<?php echo $row['shopName']; ?>"><br>
                <label for="shop-image">Image:</label>
                <select name="shop-image">
                <?php
                $directory = "../../images/vendors/";
                $images = glob("$directory*.{png,jpg,jpeg}", GLOB_BRACE);
                foreach($images as $image) {
                    if (basename($image)==$row["shopImg"]) {
                    ?>
                        <option value="<?php echo basename($image); ?>" selected><?php echo basename($image); ?></option><?php
                    }
                    else {
                    ?>
                        <option value="<?php echo basename($image); ?>"><?php echo basename($image); ?></option><?php
                    }
                }
                ?>
                </select><br><br>
                <input type="hidden" name="shop-id" value="<?php echo $row['shopID']; ?>">
                <button class="btn btn-big" name="update-shop" onclick="return confirm('Are you sure?')">Update</button><br><br>
            </div>
        </form> <br>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <h2 class="form-title"><i class="fas fa-file-upload"></i> Upload Photo(RENAME IMAGE FIRST)</h2>
            <input type="file" name="image" /><br>
            <label for="upload-dir">Image: </label>
            <select name="upload-dir">
                    <option value="products/" selected>Product Image</option>
                    <option value="vendors/">Vendor Image</option>
            </select><br><br>
            <button class="btn btn-big" name="upload-image" onclick="return confirm('Are you sure?')">Upload Image</button>
        </form>
        <h2 class="page-title"><i class="fas fa-utensils"></i> Products <i class="fas fa-utensils"></i></h2>
        <?php
            $query = "SELECT * FROM item WHERE shopID=$shopID";
            $result = mysqli_query($con, $query);
        ?>
        <table width="100%" border="1" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th><strong>Name</strong></th>
                <th><strong>Price</strong></th>
                <th><strong>Update</strong></th>
                <th><strong>Delete</strong></th>
            </tr>
        </thead>
        <tbody>
        <?php 
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['itemName']; ?>
                            <form action="index.php" method="post"> <br>
                                <label for="item-image">Image: </label>
                                <select name="item-image">
                                <?php
                                $directory = "../../images/products/";
                                $images = glob("$directory*.{png,jpg,jpeg}", GLOB_BRACE);
                                foreach($images as $image) {
                                    if (basename($image)==$row["itemImg"]) {
                                    ?>
                                    <option value="<?php echo basename($image); ?>" selected><?php echo basename($image); ?></option><?php
                                    }
                                    else {
                                    ?>
                                    <option value="<?php echo basename($image); ?>"><?php echo basename($image); ?></option><?php
                                    }
                                }
                                ?>
                                </select>
                        <td>
                                <input type="text" name="item-price" value="<?php echo $row['itemPrice']; ?>" size="1"></td>
                        <td>
                                <input type="hidden" name="item-id" value="<?php echo $row['itemID']; ?>">
                                <button name="update-item" class="btn btn-big">UPDATE</button>
                            </form>
                        </td>
                        <td>
                            <form action="index.php" method="post">
                                <input type="hidden" name="delete-id" value="<?php echo $row['itemID']; ?>">
                                <button name="delete-btn" class="btn btn-big" onclick="return confirm('Are you sure?')"> DELETE</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            }
            else {
                echo "No Record Found";
            }
            ?>
        </tbody>
        </table>
        <br>
        </div>
    </div>

    <!-- Footer -->
    <?php include('../footer.php'); ?>
</body>
</html>