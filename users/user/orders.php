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

        <title>User Section - Manage Orders</title>
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
                    $username=$_SESSION['user']['username'];
                    $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
                    $result = mysqli_query($con, $query);
                    $logged_in_user = mysqli_fetch_assoc($result);
                    $userID=$logged_in_user['userID'];
                    $query = "SELECT * FROM orders WHERE userID='$userID'";
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0) { 
                ?>
                    <table width="100%" border="1" style="border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th width=15%><strong>Item</strong></th>
                            <th><strong>Vendor</strong></th>
                            <th width=10%><strong>Order Created</strong></th>
                            <th width=10%><strong>Status</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while($row = mysqli_fetch_assoc($result)) {
                            $id = $row['shopID'];
                            $sql = "SELECT shopName FROM shops WHERE shopID=$id";
                            $name_array = mysqli_query($con, $sql);
                            $name = mysqli_fetch_assoc($name_array);
                        ?>
                            <tr>
                                <td><?php echo $row['quantity']; ?> <?php echo $row['item']; ?></td>
                                <td><?php echo $name['shopName'] ?></td>
                                <td><?php echo $row['timestamp']; ?></td>
                                <?php
                                    if($row['status']=='Pending') { ?>
                                        <td><p style="color:brown;">Waiting for Vendor</p></td> 
                                <?php 
                                    } else if($row['status']=='Prepared') { ?>
                                        <td>
                                            <form action="orders.php" method="post">
                                                <input type="hidden" name="order-id" value="<?php echo $row['orderID']; ?>">
                                                <button name="complete-user" class="btn clickable" onclick="return confirm('Are you sure?')">RECEIVED ORDER</button>
                                            </form>
                                        </td>
                                <?php
                                    } else if($row['status']=='Received') { ?>
                                        <td><p style="color:green;">Order Delivered</p></td> 
                                <?php
                                    }
                                ?>
                            </tr>
                            <?php
                        } ?>
                    </tbody>
                    </table>
                <br> <?php
                    } else { ?>
                        <h3>No Order Found</h3> <?php
                    }
                ?>
            </div>
        </div>

        <!-- Footer -->
        <?php include('../footer.php'); ?>
    </body>
</html>