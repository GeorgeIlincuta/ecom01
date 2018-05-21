<?php

$uploads_directory = "uploads";

// helper functions

function set_message($msg) {
	if(!empty($msg)) {
		$_SESSION['message'] = $msg;
	} else {
		$msg = "";
	}
}

function display_message() {
	if(isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function redirect($location) {
	header("Location: $location");
}

function query($sql) {

	global $connection;

	return mysqli_query($connection, $sql);
}

function confirm($result) {
	global $connection;

	if(!$result) {
		die("QUERY FAILED" . mysqli_error($connection));
	}
}

function escape_string($string) {
	global $connection;

	return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result) {
	return mysqli_fetch_array($result);
}
//--------------------- FRONT END FUNCTIONS ---------------------
// get products

function get_products() {
	$query = query("SELECT * FROM products");
	confirm($query);

	while($row = fetch_array($query)) {
		$prod = substr($row['product_description'], 0,57);
		$product_image = display_image($row['product_image']);

		$product = <<<DELIMITER
		<div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
                <div class="caption">
                    <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                    <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></h4>
                    <p>{$prod}</p>
                    <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
                </div>
            </div>
        </div>
DELIMITER;
	
		echo $product;	
	}
}

function get_categories() {
	$query = query("SELECT * FROM categories");
	confirm($query);

	while($row = fetch_array($query)) {
		$category_links = <<<DELIMITER
		<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
DELIMITER;
		echo $category_links;
	}
}

function get_products_in_cat_page() {
	$query = query("SELECT * FROM products WHERE product_category_id =" . escape_string($_GET['id']) . " ");
	confirm($query);

	while($row = fetch_array($query)) {
		$prod = substr($row['product_description'], 0,57);
		$product_image = display_image($row['product_image']);
		$product = <<<DELIMITER
		<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
				<a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
                    <div class="caption">
                        <h3><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></h3>
                        <p>{$prod}</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> 
                            <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
        </div>
DELIMITER;

		echo $product;
	}
}

function get_products_in_shop_page() {
	$query = query("SELECT * FROM products");
	confirm($query);

	while($row = fetch_array($query)) {
		$prod = substr($row['product_description'], 0,57);
		$product_image = display_image($row['product_image']);
		$product = <<<DELIMITER
		<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
					<a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$prod}</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> 
                            <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
        </div>
DELIMITER;

		echo $product;
	}
}

function login_user() {
	if(isset($_POST['submit'])) {
		$username = escape_string($_POST['username']);
		$password = escape_string($_POST['password']);
		$query    = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'");
		confirm($query);

		if(mysqli_num_rows($query) == 0) {
			set_message("Your Password or Username are wrong");
			redirect("login.php");
		} else {
			$_SESSION['username'] = $username;
			redirect("admin");
		}
	}
}

function send_message() {
	if(isset($_POST['submit'])) {
		$to        = "templar4life@yahoo.com";
		$from_name = $_POST['name'];
		$subject   = $_POST['subject'];
		$email     = $_POST['email'];
		$message   = $_POST['message'];

		$headers = "From: {$from_name} {$email}";

		$result = mail($to, $subject, $message, $headers);
		if(!$result) {
			set_message("Sorry we could not send your message");
			redirect("contact.php");
		} else {
			set_message("Your message has been sent");
			redirect("contact.php");
		}
	}
}
//--------------------- BACK END FUNCTIONS ---------------------

//--------------------- ADMIN PRODUCTS FUNCTIONS ---------------------

function display_image($picture) {
	global $uploads_directory;
	return $uploads_directory . DS . $picture;
}

function get_products_in_admin() {
	$query = query("SELECT * FROM products");
	confirm($query);

	while($row = fetch_array($query)) {
		$category      = show_product_category_title($row['product_category_id']);
		$product_image = display_image($row['product_image']);

		$product = <<<DELIMITER
		<tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']}<br>
            <a href="index.php?edit_product&id={$row['product_id']}"><img width="100" src="../../resources/{$product_image}" alt=""></a>
            </td>
            <td>{$category}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMITER;

		echo $product;
	}
}

function show_product_category_title($product_category_id) {
	$category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}'");
	confirm($category_query);

	while($category_row = fetch_array($category_query)) {
		return $category_row['cat_title'];
	}
}

//--------------------- ADD PRODUCTS IN ADMIN ---------------------

function add_product() {

	if(isset($_POST['publish'])) {

		$product_title       = escape_string($_POST['product_title']);
		$product_category_id = escape_string($_POST['product_category_id']);
		$product_price       = escape_string($_POST['product_price']);
		$product_quantity    = escape_string($_POST['product_quantity']);
		$product_description = escape_string($_POST['product_description']);
		$short_desc          = escape_string($_POST['short_desc']);
		$product_image       = escape_string($_FILES['file']['name']);
		$image_temp_location = realpath(escape_string($_FILES['file']['tmp_name']));

		move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);

		$query = query("INSERT INTO products(product_title, product_category_id, product_price, product_quantity, product_description, short_desc, product_image) VALUES('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_quantity}', '{$product_description}', '{$short_desc}', '{$product_image}')");
		confirm($query);

		set_message("New Product Just Added ");
		redirect("index.php?products");

	}
}

function show_category_add_product_page() {
	$query = query("SELECT * FROM categories");
	confirm($query);

	while($row = fetch_array($query)) {
		$category_options = <<<DELIMITER
		<option value="{$row['cat_id']}">{$row['cat_title']}</option>
DELIMITER;
		echo $category_options;
	}
}