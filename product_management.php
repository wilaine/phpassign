<?php
include_once "database.php";
$query = "SELECT * FROM product";
$result = mysqli_query($connection, $query) or die(mysqli_error());
if(isset($_GET['delete_id'])) {
    $product_id = $_GET['delete_id'];
    $query = "DELETE FROM product WHERE product_id='$product_id'";
    if(mysqli_query($connection, $query)){
        $query = "SELECT product_picture_id FROM product_picture WHERE product_id=$product_id";
        $result = mysqli_query($connection, $query) or die(mysqli_error());
        while($row = mysqli_fetch_array($result)) {
            $product_picture = "product_pictures/$row[0].png";
            unlink($product_picture) or die("Couldn't delete file");
        }
        header("Location:product_management.php");
    }
if(isset($_GET['edit_id'])) {
    $product_id = $_GET['edit_id'];
    header("Location:edit_product.php?id=$product_id");
}
}
?>
<!DOCTYPE html>
<html>
<title> Product management </title><br>
<table>
    <tr>
        <th>Link</th>
        <th>Picture</th>
        <th>Price</th>
        <th>Sales</th>
    </tr>
    <form method='POST' enctype='multipart/form-data'>
        <?php
            while($row = mysqli_fetch_array($result)){
                $product_id = $row["product_id"];
                $product_name = $row["product_name"];
                $product_description = $row["product_description"];
                $product_price = $row["product_price"];
                $product_sales = $row["product_sales"];
                $query = "SELECT product_picture_id FROM product_picture WHERE product_id=$product_id";
                $product_cover= mysqli_query($connection, $query) or die(mysqli_error());
                $row = mysqli_fetch_array($product_cover);
                $product_cover = "product_pictures/$row[0].png";
                echo " <tr>
                           <td><a href=\"product_detail.php?id=$product_id\">$product_description</a></td>
                           <td><img src=$product_cover width='50' height='50'></td>
                           <td>RM $product_price</td>
                           <td>$product_sales</td>
                           <td><a href=\"product_management.php?delete_id=$product_id\">Delete</a></td>
                           <td><a href=\"product_management.php?edit_id=$product_id\">Edit</a></td>
                       </tr>";
            }
        ?>
    </form>
</table>
<button onclick="location.href='add_product.php'">Add product</button>
<button onclick="location.href='home.php'">Go back home</button>
</html>
