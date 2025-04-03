<?php
// Database credentials
$host = "localhost";
$user = "root";  // Replace with your MySQL username
$password = "wasakatonge";  // Replace with your MySQL password
$db_name = "test_db"; // Name of the database to create

// Create a connection to the MySQL server
$conn = new mysqli($host, $user, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Create a database
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// 2. Select the database
$conn->select_db($db_name);

// 3. Create a table
$table_sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    gender VARCHAR(10) NOT NULL
)";

if ($conn->query($table_sql) === TRUE) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// 4. Insert data into the table
$insert_sql = "INSERT INTO users (name, gender) VALUES ('John', 'Male'), ('Jane', 'Female')";
if ($conn->query($insert_sql) === TRUE) {
    echo "New records created successfully.<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

// 5. Retrieve and display the data
$result = $conn->query("SELECT id, name, gender FROM users");

if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Name: " . $row["name"] . " - Gender: " . $row["gender"] . "<br>";
    }
} else {
    echo "0 results found.<br>";
}

// Close the connection
$conn->close();
?>
