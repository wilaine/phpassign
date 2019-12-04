<?php
$name=$_POST['userName'];
$password=$_POST['password'];
$pass=$_POST['confirmPassword'];
$phone=$_POST['phone'];
$address=$_POST['address'];

$con=mysqli_connect ("localhost","root","","gg");
$sql="select*from user";
$res=mysqli_query($con,$sql);
$total = mysqli_num_rows($res);
if ($pass!=$password)
{
    header('location:wrong.php');
}
else if ($total==1)
{
    header('location:wrong.php');
}
else if ($total==null || $password==null || $phone==null || $address==null)
{
    header('location:wrong.php');
}
else{
    $con=mysqli_connect ("localhost","root","","gg");
    $sql = "INSERT INTO user VALUES ('$name','$password','$phone','$address')";
    $gosql=mysqli_query($con, $sql);
    header('location:login.php');
}
?>
