<?php
require('config/connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

   
    $errors = [];

  
    if (strlen($username) < 2) {
        $errors[] = "Username must be at least two characters.";
    }


    if (strlen($password) < 6) {
        $errors[] = "Password must be at least six characters.";
    }


    if (empty($errors)) {

        $query = "SELECT username, password FROM users WHERE username = ?";


        if ($stmt = mysqli_prepare($conn, $query)) {
            
            mysqli_stmt_bind_param($stmt, "s", $username);
            
            
            mysqli_stmt_execute($stmt);

            
            mysqli_stmt_bind_result($stmt, $db_username, $db_password);

            
            if (mysqli_stmt_fetch($stmt)) {
                
                if (password_verify($password, $db_password)) {
                    echo "Login successful!";

                    header("Location: secondpage.php" );
                    
                } else {
                    echo "<p style='color:red'>Invalid password!</p>";
                }
            } else {
                echo "Username not found!";
            }

            
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        
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
        body { color: white; }

        form { 
        	padding: 10px; 
        	padding-left: 40px;
        	 }

        .head { 
        	border-radius: 
        	10px 10px 0 0; 
        	background-color: #196774; 
        	display: flex; gap: 10vw; 
        	height: 15vh; 
        	padding: 10px; 
        	padding-top: 10px; 
        }

        input { 
        	width: 70vh; 
        	height: 7vh; 
        	border-bottom: 
        	2px solid white; 
        	border-top: none;
        	border-left: none; 
        	border-right: none; 
        	padding: 5px; 
        	margin-top: 7vh; 
        	background-color: transparent; 
        }

        a { 
        	color: white; 
        	text-decoration: none; 
        }

        #submit { 
        	background-color: #C955B6; 
        	border: none; 
        	height: 12vh; 
        	width: 45vw; 
        	color: white; 
        	border-radius: 5px; 
        	font-size: 14px; 
        }
    </style>
</head>
<body>

<div class="body">
    <div class="head">
        <div><a href="login.php">login</a></div>
        <div><a href="sign_up.php">sign up</a></div>
    </div>

    <form method="post" action="login.php" target="_parent">
        <div>
            <input type="text" name="username" placeholder="username" required>
        </div>

        <div>
            <input type="password" name="password" placeholder="password" required>
        </div>

        <div>
            <input type="submit" value="join the vibe" id="submit">
        </div>
    </form>
</div>

</body>
</html>
