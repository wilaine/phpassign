<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add product</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Add Product</h1>

        <div class="card shadow mb-4">
            <div class="card-body ">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6">
                        <form method="POST" enctype="multipart/form-data">
                            Product name:
                            <input type="text" class="form-control form-control-user" name="product_name"><br>
                            Product description:
                            <input type="text" class="form-control form-control-user" name="product_description"><br>
                            Product spec:
                            <input type="text" class="form-control form-control-user" name="product_spec"><br>
                            Product price:
                            <input type="number" class="form-control form-control-user" name="product_price"><br>
                            <div class="form-group">
                                Upload product cover:<br>
                                <input type="file" class="form-control-user" name="product_cover"><br><br>
                                Upload product details in picture:
                                <input type="file" class="form-control-user" name="image_detail[]" multiple="multiple"><br>
                            </div>
                            <input type="submit" class="form-control" name="submit" value="Upload product"><br>
                        </form>

                        <!-- navigate buttons -->
                        <div>
                            <a href="product_management.php" class='btn btn-primary btn-lg'>Go back to product management</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>

<?php
if(isset($_POST['submit'])) {
    $error=array();
    if (empty($_POST["product_name"])) {
        $error[]= "Please enter a value for the product name.<br>";
    }
    if (empty($_POST["product_price"])) {
        $error[]= "Please enter a value for the product price.<br>";
    }
    if (empty($_POST["product_description"])) {
        $error[]= "Please enter a value for the product description.<br>";
    }
    if (empty($_POST["product_spec"])) {
        $error[]= "Please enter a value for the product spec.<br>";
    }
    if(isset($_FILES['product_cover'])) {
        $file_tmp = $_FILES['product_cover']['tmp_name'];
        $file_name = $_FILES['product_cover']['name'];
        $file_size = $_FILES["product_cover"]["size"];
        $file_extension = strtolower(end(explode('.', $file_name)));
        if (getimagesize($file_tmp) == false) {
            $error[]= "The file cannot be recognize.<br>";
        } elseif ($file_size > 50000000) {
            $error[]= "Please use a smaller picture(<50M).<br>";
        } elseif (in_array($file_extension, array("jpeg", "jpg", "png")) === false) {
            $error[]= "Sorry, only JPG, JPEG, PNG files are allowed.<br>";
        }
    }
    if(isset($_FILES['image_detail'])) {
        foreach($_FILES['image_detail']['name'] as $key=>$name) {
            $file_tmp = $_FILES['image_detail']['tmp_name'][$key];
            $file_name = $_FILES['image_detail']['name'][$key];
            $file_size = $_FILES["image_detail"]["size"][$key];
            $file_extension = strtolower(end(explode('.', $file_name)));
            if (getimagesize($file_tmp) == false) {
                $error[]= "The file cannot be recognize.<br>";
            } elseif ($file_size > 50000000) {
                $error[]= "Please use a smaller picture(<50M).<br>";
            } elseif (in_array($file_extension, array("jpeg", "jpg", "png")) === false) {
                $error[]= "Sorry, only JPG, JPEG, PNG files are allowed.<br>";
            }
        }
    }
    if(count($error)==0){
        include_once "database.php";
        $product_name = $_POST["product_name"];
        $product_description = $_POST["product_description"];
        $product_spec = $_POST["product_spec"];
        $product_price = $_POST["product_price"];
        $query = "INSERT INTO product(product_name, product_description, product_price, product_spec) VALUES ('$product_name', '$product_description', '$product_price', '$product_spec')";
        if(mysqli_query($connection, $query)) {
            $last_product_id = mysqli_insert_id($connection);
            $query = "INSERT INTO product_picture(product_id) VALUES ('$last_product_id')";
            if (mysqli_query($connection, $query)) {
                $last_picture_id = mysqli_insert_id($connection);
                $file_tmp = $_FILES['product_cover']['tmp_name'];
                move_uploaded_file($file_tmp, "product_pictures/" . $last_picture_id . ".png");
            }
            foreach($_FILES['image_detail']['name'] as $key=>$name) {
                if (mysqli_query($connection, $query)) {
                    $last_picture_id = mysqli_insert_id($connection);
                    $file_tmp = $_FILES['image_detail']['tmp_name'][$key];
                    move_uploaded_file($file_tmp, "product_pictures/" . $last_picture_id . ".png");
                }
            }
        }
        header("Location:product_management.php");
    }else{
        echo "<br>";
         foreach($error as $error_output){
             echo $error_output;
         }
    }
}
?>
