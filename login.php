
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
				height: 200px;
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
		
		<form action="check.php" method="post">
			
			<div id="main" class="main">
				<h3 align=center>
					     welcome!
				</h3>
				<div>
					<label><div class="leftbar"></div><input type="text" id="username" class="fadeIn second" name="username" placeholder="username"></label>
					<label><div class="leftbar"></div><input type="password" id="password" class="fadeIn third" name="password" placeholder="password"></label>
				
				</div>
				<div class="bottom">
                                     <br/><div class="leftbar"></div><input type="submit" name="submit" value="login" />
                                     <span style="font-size: 12px">no account ？<a href="register.php">register now !</a><br/>
                              </form>	
	</body>
	
</html>
