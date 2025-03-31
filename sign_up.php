
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>dancan</title>

	<style>
		form{
			padding: 10px;
			padding-left: 40px;

		}


		.head{
			border-radius: 10px 10px 0 0;
			background-color: #196774;
			display:flex;
			gap: 10vw;
			height: 15vh;
			padding: 10px;
			padding-top: 10px;

		}


		input{
			width: 70vh;
			height: 7vh;
 			height: 20px;
			border-bottom:2px solid white;
			border-top:none;
			border-left: none;
			border-right: none;
			padding: 5px;
			margin-top: 7vh;
			background-color: transparent;
		}

		a{
			color: white;
			text-decoration: none;
		}

		#submit{
			background-color: #C955B6;
			border:none;
			border-bottom: none;
			height: 12vh;
			width: 45vw;
			color:white;
			border-radius: 5px;
			font-size: 14px;
		}
	</style>
</head>
<body>

<div class="body">
	<div class="head">
		<div><a href="login.php">login</a></div>
		<div><a href="sign_up.php" target="_parent">sign up</a></div>
	</div>

	<form method="post" action="login.php" target="_parent">
		<div>
			<input type="text" name="username" placeholder="username">
		</div>

		<div>
			<input type="password" name="password" placeholder="password">
		</div>

		<div>
			<input type="submit" name="submit" value="join the vibe" id="submit">
		</div>
		
	</form>
</div>


</body>
</html>