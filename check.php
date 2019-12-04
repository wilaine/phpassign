
<?php
            $username=$_POST['username'];
            $password=$_POST['password'];
                    $con=mysqli_connect ("localhost","root","","gg");
                    $sql="select*from user where name='$username' and password='$password' ";
                    $res=mysqli_query($con,$sql);
                    $total = mysqli_num_rows($res);

					if($total==0){
                        header('location:wrong.php');
                        }
					else{
					    header('location:main.php');
                    }

			?>