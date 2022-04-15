<body>
    <header>
        <div class="logo">
            <a href="index.php" class="tooltip"><img src="../../images/logo.png" class="logo-img"><span>Main Menu</span></a>
        </div>
        <script>
            function changeImage(x) {
                x.classList.toggle("fa-times");
            }
        </script>
        <i class="fa fa-bars menu-toggle" onclick="changeImage(this)"></i>
        <ul class="nav">
            <li><a href="order.php"><i class="fas fa-shopping-bag"></i> Orders</a></li>
            <li><a href="create.php"><i class="fas fa-plus-circle"></i> Add Product</a></li>
            <li><a href="index.php"><i class="fas fa-store"></i> Manage Shop</a></li>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <?php  if (isset($_SESSION['user'])) : ?>
                    <strong><?php echo $_SESSION['user']['username']; ?></strong>
                    <?php endif ?>
                    <i class="fa fa-chevron-down arrow-down"></i>
                </a>
                <ul>
                    <li><a href="account.php"><i class="fas fa-user-circle"></i> Account</a></li>
                    <li><a href="index.php?logout='1'" class="logout" onclick="return confirm('Are you sure?')"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>
</body>