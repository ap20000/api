<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gadgetguru";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if data was sent via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Decode JSON data from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if JSON decoding was successful
    if ($data !== null) {
        // Handle POST request data if needed, e.g., inserting data into the database
        // For this example, let's assume we only want to insert data and not retrieve it
        // You can add your insertion logic here
    } else {
        echo "Error: Invalid JSON data";
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Prepare SQL query to retrieve product information
    $sql = "SELECT * FROM product";

    // Execute SQL query
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Fetch all rows from the result set
        $products = array();
        while ($row = $result->fetch_assoc()) {
            // Add each product to the products array
            $products[] = $row;
        }

        // Convert the products array to JSON format and output it
        echo json_encode($products);
    } else {
        echo "No products found.";
    }
} else {
    echo "Error: Only POST or GET requests are allowed";
}

// Close connection
$conn->close();
?>
