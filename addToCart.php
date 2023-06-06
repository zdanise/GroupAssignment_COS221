<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'gws_group27vs4';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$wineId = $data['wine_id'];
$userId = $data['user_id'];
$amount = $data['amount'];

$query = "INSERT INTO user_cart (wine_id, user_id, quantity) VALUES ('$wineId', '$userId', '$amount') ON DUPLICATE KEY UPDATE quantity ='$amount'";

if (mysqli_query($conn, $query)) {
    $response = array('status' => 'success', 'message' => 'Wine added to cart successfully');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Failed to add wine to cart');
    echo json_encode($response);
}

mysqli_close($conn);

?>
