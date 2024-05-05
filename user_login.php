<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gadgetguru";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error)
{
    die("Connection Failed: " . $conn->connect_error);

}
$data = json_decode(file_get_contents('php://input'), true);
$user_name = $data['user_name'];
$password = $data['password'];

$sql = "SELECT * FROM user WHERE user_name = '$user_name'  AND password = '$password'";
$result = $conn->query($sql);

$sql_result = array();
if($result->num_rows > 0)
{
    while($row = $result -> fetch_array())
    {
        $sql_result[] = array( "user_name" => $row["user_name"],  "password" => $row["password"]);
    

    }
} else {
    http_response_code(401);
    echo json_encode("Username or password is incorrect");
    return;
}

echo json_encode($sql_result);
$conn ->close();