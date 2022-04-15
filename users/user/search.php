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
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Font Awesome -->
        <link rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
            crossorigin="anonymous">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Candal|Lora"
            rel="stylesheet">

        <!-- Custom Styling -->
        <link rel="stylesheet" href="../../css/styling.css">

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../../css/admin.css">

        <title>Admin Section - Manage Users</title>

        <style>
            @media only screen and (max-width: 930px) {
                #cart {
                    height:66px;
                    width:75px;
                }
            }
        </style>
    </head>

    <body>
        <!-- Header -->
        <?php include('header.php'); ?>

        <div class="admin-content">
            <div class="content" id="market">
                <?php
	            // fetch data from student table..

	            if (isset($_POST['search'])) {
	            	$search = mysqli_real_escape_string($con, $_POST['search']);
	            	$query = "SELECT * FROM item WHERE itemName LIKE '%$search%' ORDER BY itemName ASC";
	            } else {
                    $query = "SELECT * FROM item ORDER BY itemName ASC";
                }
	            $results = mysqli_query($con, $query);
	            if (mysqli_num_rows($results) > 0) { ?>
                    Found <?php echo mysqli_num_rows($results) ?> records
	            	<table class='table table-hover table-striped'>
                    <tbody>
                    <?php
	            	while ($row = mysqli_fetch_assoc($results)) { ?>
                    <?php
                        $shopID = $row['shopID'];
                        $sql = "SELECT shopName FROM shops WHERE shopID=$shopID";
                        $result = mysqli_query($con, $sql); 
                        $id = mysqli_fetch_assoc($result)
                    ?>
                        <form action="shops.php" method="post">
                        <input type="hidden" name="shop-id" value="<?php echo $row['shopID']; ?>">  
	            		<tr>
                        <td width=10%><img id="cart" src="../../images/products/<?php echo $row["itemImg"]; ?>" alt="<?php echo $row["itemImg"]; ?>" height="112px" width="150px"></td>
	            			<td><strong><?php echo $row['itemName']; ?></strong><br>
	            			RM <?php echo $row['itemPrice']; ?></td>
	            			<td><button name="enter-shop"><?php echo $id['shopName']; ?></td>
	            		</tr>
                        </form>
                    <?php
	            	} ?>
                    </tbody></table> <?php
	            }else{
	            	echo "<h5>No record found</h5>";
	            } ?>
            </div>
        </div>
        <?php
    // Footer
    include "../footer.php";
?>