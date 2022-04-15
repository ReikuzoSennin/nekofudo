<body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
          <li><a href="orders.php"><i class="fas fa-shopping-bag"></i> Orders</a></li>
          <li><a href="contact.php"><i class="fas fa-address-card"></i> About</a></li>
          <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></i>
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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <form action="search.php" method="post">
          <label class="expandSearch">
            <input type="text" placeholder="Search..." name="search" id="search">
            <i class="material-icons">search</i>
          </label>
        </form>
    </header>
</body>

<!---jQuery ajax live search --->
<script type="text/javascript">
    $(document).ready(function(){
        // fetch data from table without reload/refresh page
        loadData();
        function loadData(query){
          $.ajax({
            url : "action.php",
            type: "POST",
            chache :false,
            data:{query:query},
            success:function(response){
              $(".result").html(response);
            }
          });  
        }

        // live search data from table without reload/refresh page
        $("#search").keyup(function(){
          var search = $(this).val();
          if (search !="") {
            loadData(search);
          }else{
            loadData();
          }
        });
    });
</script>