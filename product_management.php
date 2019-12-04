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
            include_once "database.php";
            $query = "SELECT * FROM product";
            $result = mysqli_query($connection, $query) or die(mysqli_error());
            while($row = mysqli_fetch_array($result)){
                $product_id = $row["product_id"];
                $product_name = $row["product_name"];
                $product_description = $row["product_description"];
                $product_price = $row["product_price"];
                $product_sales = $row["product_sales"];
                echo " <tr>
                           <td><a href=\"product_detail.php?id=$product_id\">$product_description</a></td>
                           <td><img src=\"product_pictures/$product_name.jpg\" width='50' height='50'></td>
                           <td>RM $product_price</td>
                           <td>$product_sales</td>
                           <td><input type=submit name=$product_id value=Delete></td>
                       </tr>";
            }
        ?>
    </form>
</table>
<?php
    if(count($_POST)>0) {
        $query = "DELETE FROM product WHERE product_id='$product_id'";
        if(mysqli_query($connection, $query)){
            header("Location:product_management.php");
        };
    }
?>
<button onclick="location.href='add_product.php'">Add product</button>
<button onclick="location.href='home.php'">Go back home</button>
