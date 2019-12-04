<?php
    if(isset($_GET['id'])){
        $product_id=$_GET['id'];
        include "database.php";
        $query = "SELECT * FROM product WHERE product_id=$product_id";
        $result = mysqli_query($connection, $query) or die(mysqli_error());
        $row = mysqli_fetch_array($result);
        $product_name = $row["product_name"];
        echo $product_name."<br>";
    }

?>
