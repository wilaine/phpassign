<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<form method="POST" enctype="multipart/form-data">
        Product name:
        <input type="text" name="product_name"><br>
    <span class="help-block"<?php echo "Please enter a value";?> ></span>
    Product description:
    <input type="text" name="product_description"><br>
    Product price:
    <input type="number" name="product_price"><br>
    Upload product cover:
    <input type="file" name="product_cover"><br>
    Upload product details in picture:
    <input type="file" name="image_detail" multiple><br>
    <input type="submit" name="submit" value="Upload product">
</form>
</body>
</html>
<?php
if(isset($_POST['submit'])) {
    $error=1;
    if(isset($_FILES['product_cover'])) {
        $file_tmp = $_FILES['product_cover']['tmp_name'];
        $file_name = $_FILES['product_cover']['name'];
        $file_size = $_FILES["product_cover"]["size"];
        $file_extension = strtolower(end(explode('.', $file_name)));
        if (getimagesize($file_tmp) == false) {
            echo "The file cannot be recognize.<br>";
        } elseif ($file_size > 50000) {
            echo "Please use a smaller picture(<50M).<br>";
        } elseif (in_array($file_extension, array("jpeg", "jpg", "png")) === false) {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.<br>";
        } else {
            $error=0;
        }
    }
    if(isset($_FILES['image_detail'])) {
        foreach($_FILES['image_detail']['tmp_name'] as $key=>$tmp_name) {
            $file_tmp = $_FILES['image_detail']['tmp_name'][$key];
            $file_name = $_FILES['image_detail']['name'][$key];
            $file_size = $_FILES["image_detail"]["size"][$key];
            $file_extension = strtolower(end(explode('.', $file_name)));
            $error = 1;
            if (getimagesize($file_tmp) == false) {
                echo "The file cannot be recognize.<br>";
            } elseif ($file_size > 50000) {
                echo "Please use a smaller picture(<50M).<br>";
            } elseif (in_array($file_extension, array("jpeg", "jpg", "png")) === false) {
                echo "Sorry, only JPG, JPEG, PNG files are allowed.<br>";
            } else {
                $error = 0;
            }
        }
    }
    if($error==0){
        include_once "database.php";
        $product_name = $_POST["product_name"];
        $product_description = $_POST["product_description"];
        $product_price = $_POST["product_price"];
        $query = "INSERT INTO product(product_name, product_description, product_price) VALUES ('$product_name', '$product_description', '$product_price')";
        if(mysqli_query($connection, $query)) {
            $last_product_id = mysqli_insert_id($connection);
            $result = mysqli_query($connection, $query) or die(mysqli_error());
            $query = "INSERT INTO product_picture(product_id) VALUES ('$last_product_id')";
            if (mysqli_query($connection, $query)) {
                $last_picture_id = mysqli_insert_id($connection);
                $file_tmp = $_FILES['product_cover']['tmp_name'];
                move_uploaded_file($file_tmp, "product_pictures/" . $last_picture_id . ".png");
            }
            foreach($_FILES['image_detail']['tmp_name'] as $key=>$tmp_name){
                $query = "INSERT INTO product_picture(product_id) VALUES ('$last_product_id')";
                if (mysqli_query($connection, $query)) {
                    $last_picture_id = mysqli_insert_id($connection);
                    $file_tmp = $_FILES['image_detail']['tmp_name'][$key];
                    move_uploaded_file($file_tmp, "product_pictures/" . $last_picture_id . ".png");
                }
            }
        }
        header("Location:add_product.php");
    }
}
?>
<button onclick="location.href='product_management.php'">Go back to product management</button>
