<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gadgetguru";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Could not connect: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = json_decode(file_get_contents('php://input'), true);
    // take value
    // Retrieve form data
    $full_name = $data['full_name'];
    $user_name = $data['user_name'];
    $email = $data['email'];
    $password = $data['password'];

    // Logging form data for debugging
    // echo "Full Name: " . $full_name . "<br>";
    // echo "User Name: " . $user_name . "<br>";
    // echo "Email: " . $email . "<br>";
    // echo "Password: " . $password . "<br>";

    // Prepare the SQL statement with directly interpolated values
    $sql= "INSERT INTO user(full_name, user_name, email, password) VALUES('$full_name','$user_name','$email','$password')";

    // Logging SQL query for debugging
    // echo "SQL Query: " . $sql . "<br>";
    // $result = $conn->query($sql);
    // echo "Full Name: " . $full_name . "<br>";

    

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo json_encode("New record created successfully");
    } else {
        http_response_code(500);
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
