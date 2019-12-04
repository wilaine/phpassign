<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>login page</title>
    <style type="text/css">
        .main{
            margin: 0 auto;
            padding: 100px;
            width: 250px;
            height:300px;
            background: cornflowerblue;
        }
        .leftbar{
            width: 15%;
            padding-bottom: 15px;
            display: inline-block;
            text-align:right;
        }
        .bottom{
            padding-bottom: 50px;
        }
    </style>
</head>
<body>
<form action="doregister.php" method="POST" >
    <div id="main" class="main">
<h3>Register now</h3>
        <hr>
    <div>
    username：
        <div class="leftbar"></div><input type="text" name="userName">
    <br>
    password：
        <div class="leftbar"></div><input type="password" name="password" >
    <br>
    confirm password：
        <div class="leftbar"></div><input type="password" name="confirmPassword">
    <br>
   Phone number：
        <div class="leftbar"></div><input type="text" name="phone" >
    <br>
    address：
        <div class="leftbar"></div><textarea name="address" cols="30" rows="4" ></textarea>
    <br>
        <div class="leftbar"><input type="submit" name="submit" value="register">
    </div>
</form>
</body>
</html>

<?php

?>