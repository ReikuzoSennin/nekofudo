<?php 
if(!session_id()) {
	session_start();
}

// connect to database
$con = mysqli_connect('localhost', 'root', '', 'nekofudo');
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}

// variable declaration
$username = "";
$errors   = array(); 
$shopName = "";

// call the register() function if register_btn is clicked
if (isset($_POST['register-btn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $con, $errors, $username;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// first check the database to make sure 
	// a user does not already exist with the same username
	$user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
	$result = mysqli_query($con, $user_check_query);
	$user = mysqli_fetch_assoc($result);
  
	if ($user) { // if user exists
		if ($user['username'] === $username) {
			array_push($errors, "Username already exists");
		}
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1); //encrypt the password before saving in the database
		if (isset($_POST['userType'])) {
			$user_type = e($_POST['userType']);
			$query="INSERT INTO users (username, password, userType) 
					VALUES('$username', '$password', '$user_type')";
			mysqli_query($con, $query);
			$_SESSION['success']  = "New user successfully created!!";	
			header('location: index.php');
		}else{
			$query = "INSERT INTO users (username, password, userType) 
					  VALUES('$username', '$password', 'user')";
			mysqli_query($con, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($con);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: thankyou.php');				
		}
	}
}

// return user array from their id
function getUserById($id){
	global $con;
	$query = "SELECT * FROM users WHERE userID=" . $id;
	$result = mysqli_query($con, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $con;
	return mysqli_real_escape_string($con, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn() {
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../../login/login.php");
}

// call the login() function if register_btn is clicked
if (isset($_POST['login-btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $con, $username, $errors;

	// grab form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);
		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($con, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['userType'] == 'admin') {
				
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: ../users/admin/index.php');	
				
			}else if ($logged_in_user['userType'] == 'vendor') {
				$userID=$logged_in_user['userID'];
				
				$query = "SELECT * FROM shops WHERE userID=$userID LIMIT 1";
				$results = mysqli_query($con, $query);
				$logged_in_user_shop = mysqli_fetch_assoc($results);
				
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['shop'] = $logged_in_user_shop;
				$_SESSION['success'] = "You are now logged in";
				header('location: ../users/vendor/index.php');
				
			}else{
				
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: ../users/user/index.php');
				
			}
		}else  {
			array_push($errors, "Wrong username/password");
		}
	}
}

function whatUser() {
	if (isset($_SESSION['user']) && $_SESSION['user']['userType'] == 'admin' ) {
		return 0;
	}else if (isset($_SESSION['user']) && $_SESSION['user']['userType'] == 'vendor' ) {
		return 1;
	}else {
		return 2;
	}
}

if (isset($_POST['rename-btn'])) {
	name();
}

function name() {
	global $con, $shopName, $errors;
	
	$shopName = e($_POST['shopName']);
	
	if (empty($shopName)) { 
		array_push($errors, "Shop Name is required"); 
	}
	
	//check if shop name already exist in database
	$query = "SELECT * FROM shops WHERE shopName='$shopName' LIMIT 1";
	$result = mysqli_query($con, $query);
	$shop = mysqli_fetch_assoc($result);
   
	if ($shop) { // if shop name already exists
		array_push($errors, "Shop Name already exists");
	}
	
	if (count($errors) == 0) {
		//find which shop to rename
		$username=$_SESSION['user']['username'];
		$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
		$result = mysqli_query($con, $query);
		$logged_in_user = mysqli_fetch_assoc($result);
		$userID=$logged_in_user['userID'];
		
		//checks if shop rename or create
		if(!isset($_SESSION['shop']['shopName'])) {
			//create shop in database
			$query="INSERT INTO shops (shopName,shopImg,userID) VALUES ('$shopName','vendor.png','$userID')";
			mysqli_query($con, $query);
			//rename shop in database
			$query="UPDATE shops SET shopName='$shopName' WHERE userID='$userID' LIMIT 1";
			mysqli_query($con, $query);
		}
		
		//update shop name in display profile
		$query = "SELECT * FROM shops WHERE userID=$userID LIMIT 1";
		$results = mysqli_query($con, $query);
		$update_shopName = mysqli_fetch_assoc($results);
		$_SESSION['shop'] = $update_shopName;
		$_SESSION['success']  = "Shop successfully renamed!!";
	}
}

function registeredShopName() {
	if (isset($_SESSION['user']) && isset($_SESSION['shop']['shopName'])) {
		return 1;
	}else if (isset($_SESSION['user']) && !isset($_SESSION['shop']['shopName'])){
		return 0;
	}
}

if (isset($_POST['delete-btn'])) {
	deleteData();
}

function deleteData() {
	global $con,$errors;

    $id = e($_POST['delete-id']);
	$type = e($_POST['delete-type']);

	$username=$_SESSION['user']['username'];
	$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
	$result = mysqli_query($con, $query);
	$logged_in_user = mysqli_fetch_assoc($result);
	$userID=$logged_in_user['userID'];

	if($id==$userID) {
		array_push($errors, "Cannot Delete Current User");
	}

	if(count($errors)==0) {
		//checks if admin or vendor
		if (isset($_SESSION['user']) && $_SESSION['user']['userType'] == 'admin' ) {
			if($type=='vendor') {
				$query = "SELECT shopID FROM shops WHERE userID='$id' ";
    			$result = mysqli_query($con,$query);
				while ($row = $result->fetch_assoc()) {
					$shopID = $row['shopID']."<br>";
				}
				$query = "DELETE FROM item WHERE shopID='$shopID'";
				$result = mysqli_query($con,$query);
				$query = "DELETE FROM shops WHERE userID='$id' ";
    			$result = mysqli_query($con,$query);
			}

    		$query = "DELETE FROM users WHERE userID='$id' ";
    		$result = mysqli_query($con,$query);

    		if($result) {
    		    $_SESSION['success'] = "Your Data has been deleted";
    		}
		} else if (isset($_SESSION['user']) && $_SESSION['user']['userType'] == 'vendor' ) {
			$query = "DELETE FROM item WHERE itemID='$id' ";
    		$result = mysqli_query($con,$query);

    		if($result) {
    		    $_SESSION['success'] = "Your Data has been deleted";
    		} 
		}
	}
}

if (isset($_POST['enter-shop'])) {
	enterShop();
}

function enterShop () {
	global $con;
	
	$id = e($_POST['shop-id']);

    $query = "SELECT * FROM shops WHERE shopID=$id";
    $result = mysqli_query($con, $query);

	if (mysqli_num_rows($result) == 1) { // user found
		$_SESSION['shop']['shopID'] = $id;
		header('Location: shops.php');	
	}
}

if(isset($_POST['update-item'])) {
	updateItem();
}

function updateItem() {
	global $con, $errors;

	$id = e($_POST['item-id']);
	$price = e($_POST['item-price']);
	$image = e($_POST['item-image']);

	if (empty($price)) { 
		array_push($errors, "Price is required"); 
	}
	if($price<1) {
		array_push($errors, "Price is invalid"); 
	}
	
	if (count($errors) == 0) {
		//update item price in database
		$query="UPDATE item SET itemPrice='$price' WHERE itemID='$id' LIMIT 1";
		mysqli_query($con, $query);
		//update item image in database
		$query="UPDATE item SET itemImg='$image' WHERE itemID='$id' LIMIT 1";
		mysqli_query($con, $query);
		$_SESSION['success']  = "Item Updated!!";
	}
}

if(isset($_POST['update-shop'])) {
	updateShop();
}

function updateShop() {
	global $con, $shopName, $errors;

	$id = e($_POST['shop-id']);
	$shopName = e($_POST['shopName']);
	$shopImage = e($_POST['shop-image']);

	if (empty($shopName)) { 
		array_push($errors, "Shop Name is required"); 
	}
	
	//check if shop name already exist in database
	$query = "SELECT * FROM shops WHERE shopName='$shopName' AND NOT shopID='$id' LIMIT 1";
	$result = mysqli_query($con, $query);
	$shop = mysqli_fetch_assoc($result);
   
	if ($shop) { // if shop name already exists
		array_push($errors, "Shop Name already exists");
	}
	
	if (count($errors) == 0) {
		//find which shop to rename
		$username=$_SESSION['user']['username'];
		$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
		$result = mysqli_query($con, $query);
		$logged_in_user = mysqli_fetch_assoc($result);
		$userID=$logged_in_user['userID'];
		
		$query="UPDATE shops SET shopName='$shopName' WHERE userID='$userID' LIMIT 1";
		mysqli_query($con, $query);
		$query="UPDATE shops SET shopImg='$shopImage' WHERE userID='$userID' LIMIT 1";
		mysqli_query($con, $query);
		
		//update shop name in display profile
		$query = "SELECT * FROM shops WHERE userID=$userID LIMIT 1";
		$results = mysqli_query($con, $query);
		$update_shopName = mysqli_fetch_assoc($results);
		$_SESSION['shop'] = $update_shopName;
		$_SESSION['success']  = "Shop successfully renamed!!";
	}
}

if(isset($_FILES['image'])) {
	uploadImage();
}

function uploadImage() {
	global $errors;

	$dir = e($_POST['upload-dir']);
	$file_name = $_FILES['image']['name'];
	$file_size =$_FILES['image']['size'];
	$file_tmp =$_FILES['image']['tmp_name'];
	$file_type=$_FILES['image']['type'];
	$temp = explode('.',$_FILES['image']['name']);
	$file_ext=strtolower(end($temp));

	$expensions= array("jpeg","jpg","png");
	if(file_exists($file_name)) {
		array_push($errors, "Sorry, file already exists.");
	  }
	if(in_array($file_ext,$expensions)=== false){
		array_push($errors, "extension not allowed, please choose a JPEG or PNG file.");
	}

	if($file_size > 2097152){
		array_push($errors, 'File size larger than 2 MB');
	}

	if(count($errors) == 0){
	  move_uploaded_file($file_tmp,"../../images/".$dir.$file_name);
	  $_SESSION['success']  = "Image successfully uploaded!!";
	}
}

if(isset($_POST['add-btn'])) {
	addItem();
}

function addItem() {
	global $con, $errors;

	$name = e($_POST['item-name']);
	$price = e($_POST['item-price']);
	$img = e($_POST['item-img']);
	$id = e($_POST['shop-id']);

	if (empty($name)) { 
		array_push($errors, "Name is required"); 
	}
	if (empty($price)) { 
		array_push($errors, "Price is required"); 
	}

	//check if item name already exist in database
	$query = "SELECT itemName FROM item WHERE itemName='$name' LIMIT 1";
	$result = mysqli_query($con, $query);
	$item = mysqli_fetch_assoc($result);
   
	if ($item) { // if item name already exists
		array_push($errors, "Item Name already exists");
	}
	
	if (count($errors) == 0) {
		$query="INSERT INTO item (itemName,itemPrice,shopID,itemImg) VALUES('$name','$price','$id','$img')";
		mysqli_query($con, $query);	
		$_SESSION['success']  = "Item successfully created!!";
	}
}

if(isset($_POST['update-cart']) && isset($_SESSION["shopping_cart"])) {
	updateCart();
}

function updateCart() {
	$id_array = $_POST['item-id'];
	$quantity_array = $_POST['item-quantity'];
	$name_array = $_POST['item-name'];
	$price_array = $_POST['item-price'];
	$shop_array = $_POST['shop-id'];
	$image_array = $_POST['item-image'];
	$array_of_ids = array_column($_SESSION["shopping_cart"], "item_id");

	foreach($id_array as $key => $id) {
		foreach($array_of_ids as $array_of_id) {
			if($array_of_id==$id) {
				$item_id = $key;
			}
		}
		$_SESSION["shopping_cart"][$item_id] = array();

		$item_array = array(
			"item_id"  => $id_array[$key],
			'item_name' => $name_array[$key],
			'item_price' => $price_array[$key],
			'item_quantity' => $quantity_array[$key],
			'shop_id' => $shop_array[$key],
			'item_image' => $image_array[$key]
		);
		$_SESSION["shopping_cart"][$item_id] = $item_array;
	}
	$_SESSION['success']  = "Cart Updated";
}

//add to cart
if(isset($_POST["add-to-cart"])) {
	addToCart();
} 

function addToCart() {
    if(isset($_SESSION["shopping_cart"])) {
        $item_array_ids = array_column($_SESSION["shopping_cart"], "item_id");
		//checks if item is already in cart
        if(!in_array($_POST["itemID"], $item_array_ids)) {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                "item_id"  => $_POST["itemID"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
				'shop_id' => $_POST["hidden_shop"],
				'item_image' => $_POST["hidden_image"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        } else {
            foreach($item_array_ids as $key=>$item_array_id) {
                if($item_array_id==$_POST["itemID"]) {
                    $item_id = $key;
                }
            }
            $item_array_quantities = array_column($_SESSION["shopping_cart"], "item_quantity");
            $total_quantity = $_POST["quantity"]+$item_array_quantities[$item_id];
            $_SESSION["shopping_cart"][$item_id] = array();

            $item_array = array(
                "item_id"  => $_POST["itemID"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $total_quantity,
				'shop_id' => $_POST["hidden_shop"],
				'item_image' => $_POST["hidden_image"]
            );
            $_SESSION["shopping_cart"][$item_id] = $item_array;
        }
    } else {
        $item_array = array(
            'item_id'  => $_POST["itemID"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"],
			'shop_id' => $_POST["hidden_shop"],
			'item_image' => $_POST["hidden_image"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
	$_SESSION['success']  = "Item added to cart!!";
}

//delete from cart
if(isset($_GET["action"])) {
	deleteItem();
} 

function deleteItem() {
    if($_GET["action"] == "delete") {
        foreach($_SESSION["shopping_cart"] as $key => $value) {
            if($value["item_id"] == $_GET["itemID"]) {
                unset($_SESSION["shopping_cart"][$key]);
            }
            $_SESSION["shopping_cart"]=array_values($_SESSION["shopping_cart"]);
        }
		$_SESSION['success']  = "Item Deleted";
    }
}

if(isset($_POST['pay-now'])) {
	redirectOrder();
}

function redirectOrder() {
	header('location: order.php');	
}

if(isset($_POST['place-order'])) {
	orderDetails();
}

function orderDetails() {
	global $con;

	$address = $_POST['address'];
	$_SESSION['address'] = $address;
	$_SESSION['order_details'] = $_SESSION["shopping_cart"];

	$username=$_SESSION['user']['username'];
	$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
	$result = mysqli_query($con, $query);
	$logged_in_user = mysqli_fetch_assoc($result);
	$userID=$logged_in_user['userID'];

	foreach($_SESSION["shopping_cart"] as $key => $value) {
		$shopID = $value["shop_id"];
		$name = $value["item_name"];
		$quantity = $value["item_quantity"];

		$query="INSERT INTO orders (shopID,username,item,quantity) VALUES('$shopID','$userID','$name','$quantity')";
		mysqli_query($con, $query);

		unset($_SESSION["shopping_cart"][$key]);
	}
}

if(isset($_POST['change-btn'])) {
	changePassword();
}

function changePassword() {
	global $con, $errors;

	$id = e($_POST['user-id']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	if (count($errors) == 0) {
		$query="UPDATE users SET password='$password_1' WHERE userID='$id' LIMIT 1";
		mysqli_query($con, $query);
		$_SESSION['success']  = "Password Changed!!";
	}
}

if(isset($_POST['complete-vendor'])) {
	completeOrder();
}

function completeOrder() {
	global $con;

	$id = $_POST["order-id"];
	$query="UPDATE orders SET status='Prepared' WHERE orderID='$id' LIMIT 1";
	mysqli_query($con, $query);
	$_SESSION['success']  = "Order Completed!!";
}

if(isset($_POST['complete-user'])) {
	receiveOrder();
}

function receiveOrder() {
	global $con;

	$id = $_POST["order-id"];
	$query="UPDATE orders SET status='Received' WHERE orderID='$id' LIMIT 1";
	mysqli_query($con, $query);
	$_SESSION['success']  = "Order Completed!!";
}