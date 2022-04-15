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
        <link href="https://fonts.googleapis.com/css?family=Candal|Lora"
            rel="stylesheet">

        <!-- Custom Styling -->
        <link rel="stylesheet" href="../../css/styling.css">

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../../css/admin.css">

        <title>Vendor Section - Manage Orders</title>
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
                <h2 class="page-title">Manage Orders</h2>
                <?php
                    $shopID = $_SESSION['shop']['shopID']; 
                    $query = "SELECT * FROM orders where shopID=$shopID";
                    $result = mysqli_query($con, $query);
                ?>
                <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                <tr>
                <th width=5%><strong>ID</strong></th>
                <th><strong>Name</strong></th>
                <th width=15%><strong>Item</strong></th>
                <th width=10%><strong>Order Created</strong></th>
                <th width=10%><strong>Status</strong></th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $userID = $row['userID'];
                            $sql = "SELECT username FROM users WHERE userID='$userID'";
                            $results = mysqli_query($con, $sql);
                            $user = mysqli_fetch_assoc($results)
                            ?>

                            <tr>
                                <td><?php echo $row['orderID']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $row['quantity']; ?> <?php echo $row['item']; ?></td>
                                <td><?php echo $row['timestamp']; ?></td>
                                <?php
                                    if($row['status']=='Pending') { ?>
                                        <td>
                                            <form action="order.php" method="post">
                                              <input type="hidden" name="order-id" value="<?php echo $row['orderID']; ?>">
                                              <button name="complete-vendor" class="btn clickable" onclick="return confirm('Are you sure?')">COMPLETE ORDER</button>
                                            </form>
                                        </td> <?php 
                                    } else if($row['status']=='Prepared') { ?>
                                        <td><p style="color:brown;">Waiting for User</p></td> 
                                <?php
                                    } else if($row['status']=='Received') { ?>
                                        <td><p style="color:green;">Order Delivered</p></td> 
                                <?php
                                    }
                                ?>
                                
                            </tr>
                            <?php
                        }
                    } else { ?>
                        <h3>No Order Found</h3> <?php
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