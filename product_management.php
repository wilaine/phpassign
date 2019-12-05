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
}
if(isset($_GET['edit_id'])) {
    $product_id = $_GET['edit_id'];
    header("Location:edit_product.php?id=$product_id");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Product management </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Product Management</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">player product</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Product title</th>
                            <th>Picture</th>
                            <th>Price</th>
                            <th>Sales</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
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
                               <td>
                               <a href=\"product_management.php?delete_id=$product_id\" class='btn btn-danger btn-icon-split btn-sm'>
                                   <span class='icon text-white-50'> <i class='fas fa-trash'></i> </span>
                                   <span class='text'>Delete</span>
                               </a>
                               </td>
                               <td/>
                               <a href=\"product_management.php?delete_id=$product_id\" class='btn btn-success btn-icon-split btn-sm'>
                                   <span class='icon text-white-50'> <i class='fas check'></i> </span>
                                   <span class='text'>Edit</span>
                               </a>
                               </td>
                           </tr>";
                            }
                            ?>
                        </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- navigate buttons -->
        <div>
            <a href="add_product.php" class='btn btn-primary btn-lg'>Add product</a>
            <a href="home.php" class='btn btn-primary btn-lg'>Go back home</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2019</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
