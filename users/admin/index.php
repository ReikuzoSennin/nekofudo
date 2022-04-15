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
                <h2 class="page-title">Manage Users</h2>
                <?php
                    $query = 'SELECT * FROM users';
                    $result = mysqli_query($con, $query);
                
                if(mysqli_num_rows($result) > 0) { ?>
                <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                <tr>
                <th width=5%><strong>ID</strong></th>
                <th><strong>Name</strong></th>
                <th width=8%><strong>Role</strong></th>
                <th width=8%><strong>Delete</strong></th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['userID']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['userType']; ?></td>
                            <td>
                                <form action="index.php" method="post">
                                    <input type="hidden" name="delete-id" value="<?php echo $row['userID']; ?>">
                                    <input type="hidden" name="delete-type" value="<?php echo $row['userType']; ?>">
                                    <button name="delete-btn" class="btn clickable" onclick="return confirm('Are you sure?')"> DELETE</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                    </table> <?php
                    } else { ?>
                        <h3>No User Found</h3> <?php
                    }
                    ?>
                
                <br>
            </div>
        </div>

        <!-- Footer -->
        <?php include('../footer.php'); ?>
    </body>
</html>