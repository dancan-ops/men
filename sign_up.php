<?php

require('config/connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $errors = [];

    // Username validation (minimum length)
    if (strlen($username) < 2) {
        $errors[] = "Username must be at least two characters.";
    }

    // Password validation (optional)
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least six characters.";
    }

    // If no errors, proceed to insert into the database
    if (empty($errors)) {
        // Use prepared statements to avoid SQL injection
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";

        // Prepare the statement
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
            
            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Success";

                header("Location: secondpage.php" );

            } else {
                echo "Error: " . mysqli_error($conn);
            }
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>dancan</title>

	<style>
		body{color: white;}

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
		<div>sign up</div>
	</div>

	<form method="post" action="" target="_parent">
		<div>
			<input type="text" name="username" placeholder="username">
		</div>

		<div>
			<input type="password" name="password" placeholder="password">
		</div>

		<div>
			<input type="submit" value="join the vibe" id="submit">
		</div>
		
	</form>
</div>

</body>
</html>
