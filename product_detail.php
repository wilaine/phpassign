<?php
if(isset($_GET['id'])){
    $product_id=$_GET['id'];
    include "database.php";
    $query = "SELECT * FROM product WHERE product_id=$product_id";
    $result = mysqli_query($connection, $query) or die(mysqli_error());
    $row = mysqli_fetch_array($result);
    $product_name = $row["product_name"];
    $product_description = $row["product_description"];
    $product_price = $row["product_price"];
    $product_sales = $row["product_sales"];
    $product_spec = $row["product_spec"];
    $query = "SELECT product_picture_id FROM product_picture WHERE product_id=$product_id";
    $result = mysqli_query($connection, $query) or die(mysqli_error());
                       //<td><img src=\"product_pictures/$product_name.jpg\" width='50' height='50'></td>
    $product_pictures= [];
    while($row = mysqli_fetch_array($result)) {
        $product_pictures[] = "product_pictures/$row[0].png";
    }
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

    <title><?php echo $product_name; ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="text-md font-weight-bold text-primary mb-1"> <?php echo $product_name; ?></div>
                                <div class="text-center">
                                    <?php
                                    echo "<img class=\"img-fluid px-3 px-sm-4 mt-3 mb-4\" style=\"rem;\" src=$product_pictures[0] alt=\"\">";
                                    ?>
                                </div>
                            </div>
                            <div class="card-header py-3">
                            </div>
                            <div class="card-body">
                                <?php
                                echo "<div class=\"h5 font-weight-bold text-primary text-uppercase mb-1\">$product_description)</div>";
                                echo "<div class=\"h5 mb-0 font-weight-bold text-gray-800\">RM $product_price</div>";
                                ?>
                                <div class="h5 mb-0 font-weight-light text-gray-800">free delivery</div>
                                <a href="cart.php" class="d-none d-sm-inline-block btn btn-lg btn-primary shadow-sm"><i class="fas fa-lg text-white-50"></i> Add to cart</a>
                                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-sm text-white-50"></i> Like</a>
                            </div>
                            <div class="card-header py-3">
                            </div>
                            <div class="card-body">
                                <div class="h2 mb-0 font-weight-light text-gray-800">Product Spec</div>
                                <?php
                                echo "<div class=\"h5 mb-0 font-weight-light text-gray-1600\">$product_spec</div>";
                                ?>
                            </div>
                            <div class="card-header py-3">
                            </div>
                            <div class="card-body">
                                <?php
                                for($i=1; $i<count($product_pictures); $i++) {
                                    echo "<img class=\"img-fluid px-3 px-sm-4 mt-3 mb-4\" style=\"rem;\" src=$product_pictures[$i] alt=\"\">";
                                }
                                ?>
                            </div>
                    </div>

            </div>

            <!-- nevigate buttoms -->

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="product_management.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-sm text-white-50"></i> Go back to product management</a>
            </div>

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
