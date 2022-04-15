<body>
    <header>
        <div class="logo">
            <a href="login.php" class="tooltip"><img src="../images/logo.png" class="logo-img"><span>Main Menu</span></a>
        </div>
        <script>
            function changeImage(x) {
                x.classList.toggle("fa-times");
            }
        </script>
        <i class="fa fa-bars menu-toggle" onclick="changeImage(this)"></i>
        <ul class="nav">
            <li><a href="register.php"><i class="far fa-clipboard"></i> Sign Up</a></li>
            <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        </ul>
    </header>
</body>