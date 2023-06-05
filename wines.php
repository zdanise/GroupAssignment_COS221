<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = '127.0.0.1';
$username = 'root';
$password = 'Tails!=Heads';
$dbname = 'gws_group27vs4';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = 'SELECT * FROM wine';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $wines = [];
    while ($row = $result->fetch_assoc()) {
        $wines[] =$row;
    }

    header('Content-Type: application/json');
    echo json_encode($wines);
} else {
    echo 'No wines found';
}

$conn->close();
?>
