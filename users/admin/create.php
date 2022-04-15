<?php include('../../server.php'); ?>
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

        <title>Admin Section - Add User</title>
    </head>

    <body>
        <!-- Header -->
        <?php include('header.php'); ?>

        <!-- Admin Content -->
        <div class="admin-content">
            <div class="content" id="market">
                <h2 class="page-title">Add User</h2>
                <form action="index.php" method="post">
                    <div>
                        <label>Username</label>
                        <input type="text" name="username"
                            class="text-input" value="<?php echo $username; ?>">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password_1"
                            class="text-input">
                    </div>
                    <div>
                        <label>Password Confirmation</label>
                        <input type="password" name="password_2"
                            class="text-input">
                    </div>
                    <div>
                        <label>Role</label>
                        <select name="userType" class="text-input">
                            <option value="admin">Admin</option>
                            <option value="vendor">Vendor</option>
                            <option value="user" selected>User</option>
                        </select>
                    </div>

                    <div>
                        <button class="btn btn-big clickable" name="register-btn" onclick="return confirm('Are you sure?')">Add User</button>
                    </div>
                </form>
        </div>
        <!-- // Admin Content -->

        <!-- Footer -->
    <?php include('../footer.php'); ?>
    </body>
</html>